<x-app-layout>
    <x-slot name="header">
        <h2 style="font-weight: 800; font-size: 1.5rem; background: linear-gradient(135deg, #ec4899, #d946ef, #f472b6); -webkit-background-clip: text; -webkit-text-fill-color: transparent;">
            ⚙️ {{ __('Profile Settings') }}
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8 space-y-6">

            <div style="background: rgba(31, 16, 32, 0.85); backdrop-filter: blur(16px); border: 1px solid rgba(255,192,203,0.08); border-radius: 1rem; padding: 2rem; box-shadow: 0 8px 32px rgba(0,0,0,0.35);">
                <div class="max-w-xl">
                    <h3 style="font-size: 1.125rem; font-weight: 700; color: #fdf2f8; margin-bottom: 0.25rem;">
                        👤 {{ __('Profile Information') }}
                    </h3>

                    <p style="font-size: 0.875rem; color: #c08497; margin-bottom: 1.5rem;">
                        {{ __("Update your account's profile information and email address.") }}
                    </p>

                    <form method="post" action="{{ route('profile.update') }}" style="display: flex; flex-direction: column; gap: 1.25rem;">
                        @csrf
                        @method('patch')

                        <div>
                            <label for="name" style="display:block;font-size:0.8125rem;font-weight:500;color:#c08497;text-transform:uppercase;letter-spacing:0.05em;margin-bottom:0.4rem;">
                                {{ __('Name') }}
                            </label>

                            <input
                                id="name"
                                name="name"
                                type="text"
                                value="{{ old('name', $user->name) }}"
                                required
                                autofocus
                                autocomplete="name"
                                style="width:100%;padding:0.75rem 1rem;background:rgba(0,0,0,0.3);border:1px solid rgba(255,192,203,0.08);border-radius:0.75rem;color:#fdf2f8;font-size:0.9375rem;font-family:'Inter',sans-serif;transition:all 0.25s;"
                                onfocus="this.style.borderColor='#ec4899'; this.style.boxShadow='0 0 0 3px rgba(236,72,153,0.12)';"
                                onblur="this.style.borderColor='rgba(255,192,203,0.08)'; this.style.boxShadow='none';"
                            >

                            @error('name')
                                <p style="color:#f87171;font-size:0.8125rem;margin-top:0.35rem;">
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>

                        <div>
                            <label for="email" style="display:block;font-size:0.8125rem;font-weight:500;color:#c08497;text-transform:uppercase;letter-spacing:0.05em;margin-bottom:0.4rem;">
                                {{ __('Email') }}
                            </label>

                            <input
                                id="email"
                                name="email"
                                type="email"
                                value="{{ old('email', $user->email) }}"
                                required
                                autocomplete="username"
                                style="width:100%;padding:0.75rem 1rem;background:rgba(0,0,0,0.3);border:1px solid rgba(255,192,203,0.08);border-radius:0.75rem;color:#fdf2f8;font-size:0.9375rem;font-family:'Inter',sans-serif;transition:all 0.25s;"
                                onfocus="this.style.borderColor='#ec4899'; this.style.boxShadow='0 0 0 3px rgba(236,72,153,0.12)';"
                                onblur="this.style.borderColor='rgba(255,192,203,0.08)'; this.style.boxShadow='none';"
                            >

                            @error('email')
                                <p style="color:#f87171;font-size:0.8125rem;margin-top:0.35rem;">
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>

                        <div style="display:flex;align-items:center;gap:1rem;">
                            <button
                                type="submit"
                                style="padding:0.75rem 2rem;background:linear-gradient(135deg,#db2777,#c026d3,#f472b6);color:white;border:none;border-radius:0.75rem;font-weight:700;font-size:0.875rem;cursor:pointer;transition:all 0.3s;font-family:'Inter',sans-serif;"
                                onmouseover="this.style.transform='translateY(-2px)'; this.style.boxShadow='0 8px 24px rgba(236,72,153,0.35)';"
                                onmouseout="this.style.transform='none'; this.style.boxShadow='none';"
                            >
                                💾 {{ __('Save Changes') }}
                            </button>

                            @if (session('status') === 'profile-updated')
                                <p
                                    x-data="{ show: true }"
                                    x-show="show"
                                    x-transition
                                    x-init="setTimeout(() => show = false, 2000)"
                                    style="color:#4ade80;font-size:0.875rem;font-weight:500;"
                                >
                                    ✅ Saved.
                                </p>
                            @endif
                        </div>
                    </form>
                </div>
            </div>

            <div style="background: rgba(31, 16, 32, 0.85); backdrop-filter: blur(16px); border: 1px solid rgba(255,192,203,0.08); border-radius: 1rem; padding: 2rem; box-shadow: 0 8px 32px rgba(0,0,0,0.35);">
                <div class="max-w-xl">
                    <h3 style="font-size:1.125rem;font-weight:700;color:#fdf2f8;margin-bottom:0.25rem;">
                        🔐 {{ __('Update Password') }}
                    </h3>

                    <p style="font-size:0.875rem;color:#c08497;margin-bottom:1.5rem;">
                        {{ __('Ensure your account is using a long, random password to stay secure.') }}
                    </p>

                    <form method="post" action="{{ route('password.update') }}" style="display:flex;flex-direction:column;gap:1.25rem;">
                        @csrf
                        @method('put')

                        <div>
                            <label style="display:block;font-size:0.8125rem;font-weight:500;color:#c08497;text-transform:uppercase;letter-spacing:0.05em;margin-bottom:0.4rem;">
                                {{ __('Current Password') }}
                            </label>

                            <input
                                name="current_password"
                                type="password"
                                autocomplete="current-password"
                                style="width:100%;padding:0.75rem 1rem;background:rgba(0,0,0,0.3);border:1px solid rgba(255,192,203,0.08);border-radius:0.75rem;color:#fdf2f8;font-size:0.9375rem;font-family:'Inter',sans-serif;transition:all 0.25s;"
                                onfocus="this.style.borderColor='#ec4899'; this.style.boxShadow='0 0 0 3px rgba(236,72,153,0.12)';"
                                onblur="this.style.borderColor='rgba(255,192,203,0.08)'; this.style.boxShadow='none';"
                            >
                        </div>

                        <div>
                            <label style="display:block;font-size:0.8125rem;font-weight:500;color:#c08497;text-transform:uppercase;letter-spacing:0.05em;margin-bottom:0.4rem;">
                                {{ __('New Password') }}
                            </label>

                            <input
                                name="password"
                                type="password"
                                autocomplete="new-password"
                                style="width:100%;padding:0.75rem 1rem;background:rgba(0,0,0,0.3);border:1px solid rgba(255,192,203,0.08);border-radius:0.75rem;color:#fdf2f8;font-size:0.9375rem;font-family:'Inter',sans-serif;transition:all 0.25s;"
                                onfocus="this.style.borderColor='#ec4899'; this.style.boxShadow='0 0 0 3px rgba(236,72,153,0.12)';"
                                onblur="this.style.borderColor='rgba(255,192,203,0.08)'; this.style.boxShadow='none';"
                            >
                        </div>

                        <div>
                            <label style="display:block;font-size:0.8125rem;font-weight:500;color:#c08497;text-transform:uppercase;letter-spacing:0.05em;margin-bottom:0.4rem;">
                                {{ __('Confirm Password') }}
                            </label>

                            <input
                                name="password_confirmation"
                                type="password"
                                autocomplete="new-password"
                                style="width:100%;padding:0.75rem 1rem;background:rgba(0,0,0,0.3);border:1px solid rgba(255,192,203,0.08);border-radius:0.75rem;color:#fdf2f8;font-size:0.9375rem;font-family:'Inter',sans-serif;transition:all 0.25s;"
                                onfocus="this.style.borderColor='#ec4899'; this.style.boxShadow='0 0 0 3px rgba(236,72,153,0.12)';"
                                onblur="this.style.borderColor='rgba(255,192,203,0.08)'; this.style.boxShadow='none';"
                            >
                        </div>

                        <button
                            type="submit"
                            style="padding:0.75rem 2rem;background:linear-gradient(135deg,#db2777,#c026d3,#f472b6);color:white;border:none;border-radius:0.75rem;font-weight:700;font-size:0.875rem;cursor:pointer;transition:all 0.3s;font-family:'Inter',sans-serif;"
                            onmouseover="this.style.transform='translateY(-2px)'; this.style.boxShadow='0 8px 24px rgba(236,72,153,0.35)';"
                            onmouseout="this.style.transform='none'; this.style.boxShadow='none';"
                        >
                            🔐 {{ __('Update Password') }}
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>