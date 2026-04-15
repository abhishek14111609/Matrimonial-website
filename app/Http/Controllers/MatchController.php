<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class MatchController extends Controller
{
    public function index(Request $request): View
    {
        if (! Schema::hasTable('users')) {
            $matches = new LengthAwarePaginator([], 0, 9);
            $matches->withPath($request->url());

            return view('pages.matches', [
                'matches' => $matches,
                'cityOptions' => [],
                'educationOptions' => [],
                'selectedSort' => 'newest',
                'selectedCity' => '',
                'selectedEducation' => '',
                'minAge' => null,
                'maxAge' => null,
                'totalMatches' => 0,
                'hasPages' => false,
                'onFirstPage' => true,
                'hasMorePages' => false,
                'previousPageUrl' => null,
                'nextPageUrl' => null,
            ]);
        }

        $query = User::query();

        $minAge = $request->integer('min_age');
        $maxAge = $request->integer('max_age');
        $city = trim((string) $request->query('city', ''));
        $education = trim((string) $request->query('education', ''));
        $sort = (string) $request->query('sort', 'newest');

        if ($minAge > 0) {
            $query->whereDate('dob', '<=', now()->subYears($minAge)->toDateString(), 'and');
        }

        if ($maxAge > 0) {
            $query->whereDate('dob', '>=', now()->subYears($maxAge)->toDateString(), 'and');
        }

        if ($city !== '') {
            $query->where('city', '=', $city, 'and');
        }

        if ($education !== '') {
            $query->where('education', '=', $education, 'and');
        }

        if ($sort === 'oldest') {
            $query->oldest('created_at');
        } elseif ($sort === 'age_asc') {
            $query->orderBy('dob', 'desc');
        } elseif ($sort === 'age_desc') {
            $query->orderBy('dob', 'asc');
        } else {
            $query->latest('created_at');
        }

        $matches = $query->paginate(9, ['*'], 'page', null)->withQueryString();

        $wishedIds = [];

        if (Auth::check()) {
            /** @var User $member */
            $member = Auth::user();
            $wishedIds = $member->wishlistProfiles()->pluck('users.id')->all();
        }

        $matches->setCollection(
            $matches->getCollection()->map(function (User $user) use ($wishedIds): object {
                return (object) [
                    'id' => $user->id,
                    'name' => $user->name,
                    'age' => $user->dob?->age,
                    'height' => $user->height,
                    'education' => $user->education,
                    'city' => $user->city,
                    'photo_url' => $this->publicPhotoUrl($user->photo),
                    'is_wishlisted' => in_array($user->id, $wishedIds, true),
                ];
            })
        );

        return view('pages.matches', [
            'matches' => $matches,
            'cityOptions' => $this->cityOptions(),
            'educationOptions' => $this->educationOptions(),
            'selectedSort' => $sort,
            'selectedCity' => $city,
            'selectedEducation' => $education,
            'minAge' => $minAge > 0 ? $minAge : null,
            'maxAge' => $maxAge > 0 ? $maxAge : null,
            'totalMatches' => $matches->total(),
            'hasPages' => $matches->hasPages(),
            'onFirstPage' => $matches->onFirstPage(),
            'hasMorePages' => $matches->hasMorePages(),
            'previousPageUrl' => $matches->previousPageUrl(),
            'nextPageUrl' => $matches->nextPageUrl(),
        ]);
    }

    private function cityOptions(): array
    {
        return User::query()
            ->whereNotNull('city', 'and')
            ->where('city', '!=', '', 'and')
            ->distinct()
            ->orderBy('city', 'asc')
            ->pluck('city')
            ->values()
            ->all();
    }

    private function educationOptions(): array
    {
        return User::query()
            ->whereNotNull('education', 'and')
            ->where('education', '!=', '', 'and')
            ->distinct()
            ->orderBy('education', 'asc')
            ->pluck('education')
            ->values()
            ->all();
    }

    private function publicPhotoUrl(?string $photo): ?string
    {
        if (! is_string($photo) || trim($photo) === '') {
            return null;
        }

        $path = null;

        if (filter_var($photo, FILTER_VALIDATE_URL)) {
            $urlHost = parse_url($photo, PHP_URL_HOST);
            $appHost = parse_url((string) config('app.url'), PHP_URL_HOST);

            if ($urlHost && $appHost && strcasecmp((string) $urlHost, (string) $appHost) === 0) {
                $path = ltrim((string) parse_url($photo, PHP_URL_PATH), '/');
            } else {
                return $photo;
            }
        } else {
            $path = ltrim($photo, '/');
        }

        if (str_starts_with($path, 'storage/')) {
            $path = substr($path, 8);
        }

        if (! Storage::disk('public')->exists($path)) {
            return null;
        }

        return asset('storage/' . $path);
    }
}
