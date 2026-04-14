@extends('layouts.app')

@section('title', 'Create Profile | SoulMatch')

@section('content')
    <section class="auth-wrap">
        @php
            $currentStep = $currentStep ?? 1;
            $registration = $registration ?? ['step1' => [], 'step2' => [], 'step3' => []];
        @endphp

        <div class="auth-panel wide reveal">
            <p class="eyebrow">Create Profile</p>
            <h1>Create Your Matrimony Profile</h1>
            <p>Join for free and complete your profile in 3 guided steps.</p>

            <div class="wizard-steps" aria-label="Registration progress">
                <div class="wizard-step {{ $currentStep === 1 ? 'active' : ($currentStep > 1 ? 'done' : '') }}">
                    <span>1</span>
                    <strong>Basic details</strong>
                    <small>Photo, name, contact</small>
                </div>
                <div class="wizard-step {{ $currentStep === 2 ? 'active' : ($currentStep > 2 ? 'done' : '') }}">
                    <span>2</span>
                    <strong>Personal details</strong>
                    <small>Education and birth data</small>
                </div>
                <div class="wizard-step {{ $currentStep === 3 ? 'active' : '' }}">
                    <span>3</span>
                    <strong>Family details</strong>
                    <small>Family and profile summary</small>
                </div>
            </div>

            @if ($currentStep === 1)
                <form class="auth-form grid-2" action="{{ route('register.step1') }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="span-2 field-block">
                        <label for="photo">Photo</label>
                        <input id="photo" type="file" name="photo" accept="image/*"
                            {{ empty($registration['step1']['photo'] ?? null) ? 'required' : '' }}>
                        @if (!empty($registration['step1']['photo'] ?? null))
                            <p class="field-note">Photo already uploaded. Leave it empty to keep the current image.</p>
                        @endif
                        @error('photo')
                            <p class="field-error">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="name">Name</label>
                        <input id="name" type="text" name="name"
                            value="{{ old('name', $registration['step1']['name'] ?? '') }}" required>
                        @error('name')
                            <p class="field-error">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="email">Email</label>
                        <input id="email" type="email" name="email"
                            value="{{ old('email', $registration['step1']['email'] ?? '') }}" required>
                        @error('email')
                            <p class="field-error">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="contact_no">Contact no</label>
                        <input id="contact_no" type="text" name="contact_no" inputmode="tel"
                            value="{{ old('contact_no', $registration['step1']['contact_no'] ?? '') }}" required>
                        @error('contact_no')
                            <p class="field-error">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="profession">Profession</label>
                        <input id="profession" type="text" name="profession"
                            value="{{ old('profession', $registration['step1']['profession'] ?? '') }}" required>
                        @error('profession')
                            <p class="field-error">{{ $message }}</p>
                        @enderror
                    </div>

                    <button type="submit" class="btn btn-primary full span-2">Save and next</button>
                </form>
            @elseif ($currentStep === 2)
                <form class="auth-form grid-2" action="{{ route('register.step2') }}" method="POST">
                    @csrf
                    <div>
                        <label for="education">Education</label>
                        <input id="education" type="text" name="education"
                            value="{{ old('education', $registration['step2']['education'] ?? '') }}" required>
                        @error('education')
                            <p class="field-error">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="dob">Date of birth</label>
                        <input id="dob" type="date" name="dob"
                            value="{{ old('dob', $registration['step2']['dob'] ?? '') }}" required>
                        @error('dob')
                            <p class="field-error">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="time_of_dob">Time of birth</label>
                        <input id="time_of_dob" type="time" name="time_of_dob"
                            value="{{ old('time_of_dob', $registration['step2']['time_of_dob'] ?? '') }}" required>
                        @error('time_of_dob')
                            <p class="field-error">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="gender">Gender</label>
                        <select id="gender" name="gender" required>
                            <option value="">Select gender</option>
                            <option value="female" @selected(old('gender', $registration['step2']['gender'] ?? '') === 'female')>Female</option>
                            <option value="male" @selected(old('gender', $registration['step2']['gender'] ?? '') === 'male')>Male</option>
                            <option value="other" @selected(old('gender', $registration['step2']['gender'] ?? '') === 'other')>Other</option>
                        </select>
                        @error('gender')
                            <p class="field-error">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="span-2">
                        <label for="address">Address</label>
                        <textarea id="address" name="address" required>{{ old('address', $registration['step2']['address'] ?? '') }}</textarea>
                        @error('address')
                            <p class="field-error">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="city">City</label>
                        <input id="city" type="text" name="city"
                            value="{{ old('city', $registration['step2']['city'] ?? '') }}" required>
                        @error('city')
                            <p class="field-error">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="wizard-actions span-2">
                        <a href="{{ route('register', ['step' => 1]) }}" class="btn btn-outline">Back</a>
                        <button type="submit" class="btn btn-primary">Save and next</button>
                    </div>
                </form>
            @else
                <form class="auth-form grid-2" action="{{ route('register.complete') }}" method="POST">
                    @csrf
                    <div>
                        <label for="father_name">Father name</label>
                        <input id="father_name" type="text" name="father_name"
                            value="{{ old('father_name', $registration['step3']['father_name'] ?? '') }}" required>
                        @error('father_name')
                            <p class="field-error">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="father_occupation">Father occupation</label>
                        <input id="father_occupation" type="text" name="father_occupation"
                            value="{{ old('father_occupation', $registration['step3']['father_occupation'] ?? '') }}"
                            required>
                        @error('father_occupation')
                            <p class="field-error">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="mother_name">Mother name</label>
                        <input id="mother_name" type="text" name="mother_name"
                            value="{{ old('mother_name', $registration['step3']['mother_name'] ?? '') }}" required>
                        @error('mother_name')
                            <p class="field-error">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="mother_occupation">Mother occupation</label>
                        <input id="mother_occupation" type="text" name="mother_occupation"
                            value="{{ old('mother_occupation', $registration['step3']['mother_occupation'] ?? '') }}"
                            required>
                        @error('mother_occupation')
                            <p class="field-error">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="span-2 field-block">
                        <div class="field-head-row">
                            <label>If siblings any</label>
                            <button type="button" class="btn btn-outline btn-sm" id="addSiblingBtn">+ Add
                                sibling</button>
                        </div>

                        @php
                            $hasSiblings = old('has_siblings', 'yes');
                        @endphp

                        <div>
                            <label for="has_siblings">Do you have siblings?</label>
                            <select id="has_siblings" name="has_siblings" required>
                                <option value="yes" @selected($hasSiblings === 'yes')>Yes</option>
                                <option value="no" @selected($hasSiblings === 'no')>No</option>
                            </select>
                            @error('has_siblings')
                                <p class="field-error">{{ $message }}</p>
                            @enderror
                        </div>

                        @php
                            $siblingRows = old('siblings', [['name' => '', 'occupation' => '']]);
                        @endphp

                        <div id="siblingsRepeater" class="repeater-list">
                            @foreach ($siblingRows as $index => $sibling)
                                <div class="repeater-item" data-repeater-item>
                                    <div>
                                        <label for="siblings_{{ $index }}_name">Sibling name</label>
                                        <input id="siblings_{{ $index }}_name" type="text"
                                            name="siblings[{{ $index }}][name]"
                                            value="{{ $sibling['name'] ?? '' }}" required>
                                        @error('siblings.' . $index . '.name')
                                            <p class="field-error">{{ $message }}</p>
                                        @enderror
                                    </div>
                                    <div>
                                        <label for="siblings_{{ $index }}_occupation">Sibling occupation</label>
                                        <input id="siblings_{{ $index }}_occupation" type="text"
                                            name="siblings[{{ $index }}][occupation]"
                                            value="{{ $sibling['occupation'] ?? '' }}" required>
                                        @error('siblings.' . $index . '.occupation')
                                            <p class="field-error">{{ $message }}</p>
                                        @enderror
                                    </div>
                                    <button type="button" class="btn btn-ghost repeater-remove" data-remove-sibling
                                        aria-label="Remove sibling">Remove</button>
                                </div>
                            @endforeach
                        </div>

                        @error('siblings')
                            <p class="field-error">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="maternal_relatives">Mother side relative</label>
                        <input id="maternal_relatives" type="text" name="maternal_relatives"
                            value="{{ old('maternal_relatives', $registration['step3']['maternal_relatives'] ?? '') }}"
                            required>
                        @error('maternal_relatives')
                            <p class="field-error">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="marital_status">Marital status</label>
                        <select id="marital_status" name="marital_status" required>
                            <option value="">Select status</option>
                            <option value="single" @selected(old('marital_status', $registration['step3']['marital_status'] ?? '') === 'single')>Single</option>
                            <option value="married" @selected(old('marital_status', $registration['step3']['marital_status'] ?? '') === 'married')>Married</option>
                            <option value="divorced" @selected(old('marital_status', $registration['step3']['marital_status'] ?? '') === 'divorced')>Divorced</option>
                            <option value="widowed" @selected(old('marital_status', $registration['step3']['marital_status'] ?? '') === 'widowed')>Widowed</option>
                            <option value="separated" @selected(old('marital_status', $registration['step3']['marital_status'] ?? '') === 'separated')>Separated</option>
                        </select>
                        @error('marital_status')
                            <p class="field-error">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="height">Height (cm)</label>
                        <input id="height" type="number" name="height" min="0.5" max="300"
                            step="0.01" value="{{ old('height', $registration['step3']['height'] ?? '') }}" required>
                        @error('height')
                            <p class="field-error">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="weight">Weight (kg)</label>
                        <input id="weight" type="number" name="weight" min="1" max="500"
                            step="0.01" value="{{ old('weight', $registration['step3']['weight'] ?? '') }}" required>
                        @error('weight')
                            <p class="field-error">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="span-2">
                        <label for="about">About</label>
                        <textarea id="about" name="about" required>{{ old('about', $registration['step3']['about'] ?? '') }}</textarea>
                        @error('about')
                            <p class="field-error">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="password">Password</label>
                        <input id="password" type="password" name="password" required>
                        @error('password')
                            <p class="field-error">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="password_confirmation">Confirm password</label>
                        <input id="password_confirmation" type="password" name="password_confirmation" required>
                    </div>

                    <div class="wizard-actions span-2">
                        <a href="{{ route('register', ['step' => 2]) }}" class="btn btn-outline">Back</a>
                        <button type="submit" class="btn btn-primary">Create profile</button>
                    </div>
                </form>
            @endif
        </div>
    </section>
@endsection

@push('scripts')
    <script>
        (() => {
            const repeater = document.getElementById('siblingsRepeater');
            const addButton = document.getElementById('addSiblingBtn');
            const hasSiblings = document.getElementById('has_siblings');

            if (!repeater || !addButton || !hasSiblings) {
                return;
            }

            const createRow = (index) => `
                <div class="repeater-item" data-repeater-item>
                    <div>
                        <label for="siblings_${index}_name">Sibling name</label>
                        <input id="siblings_${index}_name" type="text" name="siblings[${index}][name]" required>
                    </div>
                    <div>
                        <label for="siblings_${index}_occupation">Sibling occupation</label>
                        <input id="siblings_${index}_occupation" type="text" name="siblings[${index}][occupation]" required>
                    </div>
                    <button type="button" class="btn btn-ghost repeater-remove" data-remove-sibling aria-label="Remove sibling">Remove</button>
                </div>
            `;

            const renumberRows = () => {
                [...repeater.querySelectorAll('[data-repeater-item]')].forEach((row, index) => {
                    row.querySelectorAll('label').forEach((label) => {
                        const input = row.querySelector(
                            `input[id$="_name"], input[id$="_occupation"]`);
                        if (input) {
                            const suffix = input.id.endsWith('_name') ? 'name' : 'occupation';
                            label.setAttribute('for', `siblings_${index}_${suffix}`);
                        }
                    });

                    const nameInput = row.querySelector('input[name*="[name]"]');
                    const occupationInput = row.querySelector('input[name*="[occupation]"]');

                    if (nameInput) {
                        nameInput.id = `siblings_${index}_name`;
                        nameInput.name = `siblings[${index}][name]`;
                    }

                    if (occupationInput) {
                        occupationInput.id = `siblings_${index}_occupation`;
                        occupationInput.name = `siblings[${index}][occupation]`;
                    }
                });
            };

            const createFallbackRowIfNeeded = () => {
                if (hasSiblings.value === 'yes' && repeater.querySelectorAll('[data-repeater-item]').length === 0) {
                    repeater.insertAdjacentHTML('beforeend', createRow(0));
                    renumberRows();
                }
            };

            const syncSiblingMode = () => {
                const active = hasSiblings.value === 'yes';
                addButton.disabled = !active;
                repeater.classList.toggle('is-hidden', !active);

                repeater.querySelectorAll('input').forEach((input) => {
                    input.disabled = !active;
                    input.required = active;
                });

                if (active) {
                    createFallbackRowIfNeeded();
                }
            };

            addButton.addEventListener('click', () => {
                const index = repeater.querySelectorAll('[data-repeater-item]').length;
                repeater.insertAdjacentHTML('beforeend', createRow(index));
                renumberRows();
            });

            repeater.addEventListener('click', (event) => {
                const removeButton = event.target.closest('[data-remove-sibling]');

                if (!removeButton) {
                    return;
                }

                const row = removeButton.closest('[data-repeater-item]');
                if (!row) {
                    return;
                }

                row.remove();
                renumberRows();
            });

            hasSiblings.addEventListener('change', syncSiblingMode);
            syncSiblingMode();
        })();
    </script>
@endpush
