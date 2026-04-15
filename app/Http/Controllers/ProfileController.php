<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class ProfileController extends Controller
{
    public function show(int $id): View
    {
        $user = User::findOrFail($id);
        $siblings = [];

        /** @var User|null $member */
        $member = Auth::user();
        $isOwnProfile = $member ? $member->id === $user->id : false;
        $isWishlisted = false;

        if ($member && ! $isOwnProfile) {
            $isWishlisted = $member->wishlistProfiles()->where('profile_id', $user->id)->exists();
        }

        if (is_string($user->siblings) && $user->siblings !== '') {
            $decodedSiblings = json_decode($user->siblings, true);
            $siblings = is_array($decodedSiblings) ? $decodedSiblings : [$user->siblings];
        }

        return view('pages.profile', [
            'id' => $user->id,
            'profile' => [
                'name' => $user->name,
                'photo' => $this->publicPhotoUrl($user->photo),
                'age' => $user->dob?->age,
                'location' => $user->city,
                'profession' => $user->profession,
                'about' => $user->about,
                'height' => $user->height ? $user->height . ' cm' : null,
                'education' => $user->education,
                'contact_no' => $user->contact_no,
                'dob' => $user->dob ? Carbon::parse($user->dob)->format('d M, Y') : null,
                'time_of_dob' => $user->time_of_dob,
                'gender' => ucfirst((string) $user->gender),
                'address' => $user->address,
                'marital_status' => ucfirst((string) $user->marital_status),
                'father_name' => $user->father_name,
                'father_occupation' => $user->father_occupation,
                'mother_name' => $user->mother_name,
                'mother_occupation' => $user->mother_occupation,
                'siblings' => $siblings,
                'maternal_relatives' => $user->maternal_relatives,
                'weight' => $user->weight ? $user->weight . ' kg' : null,
            ],
            'isWishlisted' => $isWishlisted,
            'isOwnProfile' => $isOwnProfile,
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
