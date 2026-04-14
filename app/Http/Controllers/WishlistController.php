<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class WishlistController extends Controller
{
    public function index(): View
    {
        /** @var User $member */
        $member = Auth::user();

        $profiles = $member->wishlistProfiles()->latest('wishlists.created_at')->get();

        return view('pages.wishlist', [
            'profiles' => $profiles,
        ]);
    }

    public function store(Request $request, int $profileId): RedirectResponse
    {
        /** @var User $member */
        $member = Auth::user();

        if ($member->id === $profileId) {
            return back()->with('status', 'You cannot add your own profile to wishlist.');
        }

        $profile = User::findOrFail($profileId);

        $member->wishlistProfiles()->syncWithoutDetaching([$profile->id]);

        return back()->with('status', 'Profile added to your wishlist.');
    }

    public function destroy(Request $request, int $profileId): RedirectResponse
    {
        /** @var User $member */
        $member = Auth::user();

        $member->wishlistProfiles()->detach($profileId);

        return back()->with('status', 'Profile removed from wishlist.');
    }
}
