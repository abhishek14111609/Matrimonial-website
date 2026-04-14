<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class RegistrationController extends Controller
{
    public function show(Request $request): View|RedirectResponse
    {
        $requestedStep = (int) $request->query('step', 0);
        $step = $requestedStep >= 1 && $requestedStep <= 3 ? $requestedStep : $this->currentStepFromSession();

        if ($step === 2 && ! session()->has('registration.step1')) {
            return redirect()->route('register');
        }

        if ($step === 3 && ! session()->has('registration.step2')) {
            return redirect()->route('register', ['step' => 2]);
        }

        return view('pages.register', [
            'currentStep' => $step,
            'registration' => [
                'step1' => session('registration.step1', []),
                'step2' => session('registration.step2', []),
                'step3' => session('registration.step3', []),
            ],
        ]);
    }

    public function storeStepOne(Request $request): RedirectResponse
    {
        $existingPhoto = session('registration.step1.photo');

        $validated = $request->validate([
            'photo' => [$existingPhoto ? 'nullable' : 'required', 'image', 'mimes:jpg,jpeg,png,webp', 'max:2048'],
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', 'unique:users,email'],
            'contact_no' => ['required', 'string', 'max:20', 'regex:/^[0-9+\-\s()]+$/'],
            'profession' => ['required', 'string', 'max:255'],
        ]);

        if ($request->hasFile('photo')) {
            if ($existingPhoto) {
                Storage::disk('public')->delete($existingPhoto);
            }

            $validated['photo'] = $request->file('photo')->store('registration-photos', 'public');
        } else {
            $validated['photo'] = $existingPhoto;
        }

        session()->put('registration.step1', $validated);

        return redirect()->route('register', ['step' => 2]);
    }

    public function storeStepTwo(Request $request): RedirectResponse
    {
        if (! session()->has('registration.step1')) {
            return redirect()->route('register');
        }

        $validated = $request->validate([
            'education' => ['required', 'string', 'max:255'],
            'dob' => ['required', 'date'],
            'gender' => ['required', 'in:male,female,other'],
            'address' => ['required', 'string'],
            'city' => ['required', 'string', 'max:255'],
            'time_of_dob' => ['required', 'date_format:H:i'],
        ]);

        session()->put('registration.step2', $validated);

        return redirect()->route('register', ['step' => 3]);
    }

    public function complete(Request $request): RedirectResponse
    {
        $step1 = session('registration.step1');
        $step2 = session('registration.step2');

        if (! $step1 || ! $step2) {
            return redirect()->route('register');
        }

        $validated = $request->validate([
            'father_name' => ['required', 'string', 'max:255'],
            'father_occupation' => ['required', 'string', 'max:255'],
            'mother_name' => ['required', 'string', 'max:255'],
            'mother_occupation' => ['required', 'string', 'max:255'],
            'has_siblings' => ['required', 'in:yes,no'],
            'siblings' => ['required_if:has_siblings,yes', 'array', 'min:1'],
            'siblings.*.name' => ['required_with:siblings', 'string', 'max:255'],
            'siblings.*.occupation' => ['required_with:siblings', 'string', 'max:255'],
            'maternal_relatives' => ['required', 'string'],
            'marital_status' => ['required', 'in:single,married,divorced,widowed,separated'],
            'height' => ['required', 'numeric', 'min:0.5', 'max:300'],
            'weight' => ['required', 'numeric', 'min:1', 'max:500'],
            'about' => ['required', 'string', 'max:2000'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        $profileData = array_merge($step1, $step2, $validated);
        $siblings = $profileData['has_siblings'] === 'yes' ? array_values($profileData['siblings'] ?? []) : [];

        $user = User::create([
            'photo' => $profileData['photo'],
            'name' => $profileData['name'],
            'email' => $profileData['email'],
            'contact_no' => $profileData['contact_no'],
            'profession' => $profileData['profession'],
            'education' => $profileData['education'],
            'dob' => $profileData['dob'],
            'time_of_dob' => $profileData['time_of_dob'],
            'gender' => $profileData['gender'],
            'address' => $profileData['address'],
            'city' => $profileData['city'],
            'father_name' => $profileData['father_name'],
            'father_occupation' => $profileData['father_occupation'],
            'mother_name' => $profileData['mother_name'],
            'mother_occupation' => $profileData['mother_occupation'],
            'siblings' => json_encode($siblings),
            'maternal_relatives' => $profileData['maternal_relatives'],
            'marital_status' => $profileData['marital_status'],
            'height' => $profileData['height'],
            'weight' => $profileData['weight'],
            'about' => $profileData['about'],
            'password' => $profileData['password'],
        ]);

        session()->forget('registration');

        Auth::login($user);
        $request->session()->regenerate();

        return redirect()->route('profile', ['id' => $user->id])->with('status', 'Your profile has been created successfully.');
    }

    private function currentStepFromSession(): int
    {
        if (session()->has('registration.step2')) {
            return 3;
        }

        if (session()->has('registration.step1')) {
            return 2;
        }

        return 1;
    }
}
