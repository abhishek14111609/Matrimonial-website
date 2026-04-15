<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class HomeController extends Controller
{
    public function index(): View
    {
        if (! Schema::hasTable('users')) {
            return view('pages.home', [
                'activeMembers' => 0,
                'successStories' => 0,
                'cityCoverage' => 0,
                'featuredProfiles' => [],
                'cityOptions' => [],
                'educationOptions' => [],
            ]);
        }

        $activeMembers = User::count('*');
        $cityCoverage = User::whereNotNull('city', 'and')->where('city', '!=', '', 'and')->distinct()->count('city');
        $featuredUsers = User::query()->latest('created_at')->take(8)->get();

        $featuredProfiles = $featuredUsers->map(function (User $user): array {
            return [
                'id' => $user->id,
                'name' => $user->name,
                'age' => $user->dob?->age,
                'city' => $user->city,
                'profession' => $user->profession,
                'photo' => $this->publicPhotoUrl($user->photo),
            ];
        })->all();

        $cityOptions = User::query()
            ->whereNotNull('city', 'and')
            ->where('city', '!=', '', 'and')
            ->distinct()
            ->orderBy('city', 'asc')
            ->pluck('city')
            ->values()
            ->all();

        $educationOptions = User::query()
            ->whereNotNull('education', 'and')
            ->where('education', '!=', '', 'and')
            ->distinct()
            ->orderBy('education', 'asc')
            ->pluck('education')
            ->values()
            ->all();

        return view('pages.home', [
            'activeMembers' => $activeMembers,
            'successStories' => max(1, (int) floor($activeMembers / 6)),
            'cityCoverage' => $cityCoverage,
            'featuredProfiles' => $featuredProfiles,
            'cityOptions' => $cityOptions,
            'educationOptions' => $educationOptions,
        ]);
    }

    private function publicPhotoUrl(?string $photo): ?string
    {
        if (! is_string($photo) || trim($photo) === '') {
            return null;
        }

        if (filter_var($photo, FILTER_VALIDATE_URL)) {
            return $photo;
        }

        $path = ltrim($photo, '/');

        if (str_starts_with($path, 'storage/')) {
            $path = substr($path, 8);
        }

        if (! Storage::disk('public')->exists($path)) {
            return null;
        }

        return asset('storage/' . $path);
    }
}
