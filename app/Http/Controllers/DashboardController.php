<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function index(): View
    {
        /** @var User $member */
        $member = Auth::user();

        $profileCompletion = $this->profileCompletion($member);

        $recommendedProfiles = User::query()
            ->where('id', '!=', $member->id, 'and')
            ->when($member->city, function ($query) use ($member) {
                $query->orderByRaw('city = ? desc', [$member->city]);
            })
            ->latest('created_at')
            ->take(6)
            ->get();

        return view('pages.dashboard', [
            'member' => $member,
            'profileCompletion' => $profileCompletion,
            'recommendedProfiles' => $recommendedProfiles,
            'totalProfiles' => User::count('*'),
        ]);
    }

    private function profileCompletion(User $member): int
    {
        $fields = [
            'photo',
            'profession',
            'education',
            'dob',
            'gender',
            'address',
            'city',
            'father_name',
            'mother_name',
            'marital_status',
            'height',
            'weight',
            'about',
        ];

        $filled = collect($fields)->filter(function (string $field) use ($member): bool {
            $value = $member->{$field};

            if (is_string($value)) {
                return trim($value) !== '';
            }

            return ! is_null($value);
        })->count();

        return (int) round(($filled / count($fields)) * 100);
    }
}
