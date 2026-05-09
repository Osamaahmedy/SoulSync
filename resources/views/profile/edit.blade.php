<x-app-layout>
    <x-slot name="header">
        <h2 style="font-weight: 800; font-size: 1.5rem; background: linear-gradient(135deg, #38bdf8, #818cf8, #c084fc); -webkit-background-clip: text; -webkit-text-fill-color: transparent;">
            ⚙️ {{ __('Profile Settings') }}
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8 space-y-6">

            {{-- Profile Information --}}
            <div style="background: rgba(17, 24, 39, 0.85); backdrop-filter: blur(16px); border: 1px solid rgba(255,255,255,0.06); border-radius: 1rem; padding: 2rem;">
                <div class="max-w-xl">
                    <h3 style="font-size: 1.125rem; font-weight: 700; color: #f1f5f9; margin-bottom: 0.25rem;">
                        👤 {{ __('Profile Information') }}
                    </h3>
                    <p style="font-size: 0.875rem; color: #64748b; margin-bottom: 1.5rem;">
                        {{ __("Update your account's profile information and email address.") }}
                    </p>

                    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
                        @csrf
                    </form>

                    <form method="post" action="{{ route('profile.update') }}" style="display: flex; flex-direction: column; gap: 1.25rem;">
                        @csrf
                        @method('patch')

                        <div>
                            <label for="name" style="display: block; font-size: 0.8125rem; font-weight: 500; color: #64748b; text-transform: uppercase; letter-spacing: 0.05em; margin-bottom: 0.4rem;">{{ __('Name') }}</label>
                            <input id="name" name="name" type="text" value="{{ old('name', $user->name) }}" required autofocus autocomplete="name"
                                   style="width: 100%; padding: 0.75rem 1rem; background: rgba(0,0,0,0.3); border: 1px solid rgba(255,255,255,0.06); border-radius: 0.75rem; color: #f1f5f9; font-size: 0.9375rem; font-family: 'Inter', sans-serif; transition: all 0.25s;"
                                   onfocus="this.style.borderColor='#38bdf8'; this.style.boxShadow='0 0 0 3px rgba(56,189,248,0.1)';"
                                   onblur="this.style.borderColor='rgba(255,255,255,0.06)'; this.style.boxShadow='none';">
                            @error('name') <p style="color: #f87171; font-size: 0.8125rem; margin-top: 0.35rem;">{{ $message }}</p> @enderror
                        </div>

                        <div>
                            <label for="email" style="display: block; font-size: 0.8125rem; font-weight: 500; color: #64748b; text-transform: uppercase; letter-spacing: 0.05em; margin-bottom: 0.4rem;">{{ __('Email') }}</label>
                            <input id="email" name="email" type="email" value="{{ old('email', $user->email) }}" required autocomplete="username"
                                   style="width: 100%; padding: 0.75rem 1rem; background: rgba(0,0,0,0.3); border: 1px solid rgba(255,255,255,0.06); border-radius: 0.75rem; color: #f1f5f9; font-size: 0.9375rem; font-family: 'Inter', sans-serif; transition: all 0.25s;"
                                   onfocus="this.style.borderColor='#38bdf8'; this.style.boxShadow='0 0 0 3px rgba(56,189,248,0.1)';"
                                   onblur="this.style.borderColor='rgba(255,255,255,0.06)'; this.style.boxShadow='none';">
                            @error('email') <p style="color: #f87171; font-size: 0.8125rem; margin-top: 0.35rem;">{{ $message }}</p> @enderror
                        </div>

                        <div style="display: flex; align-items: center; gap: 1rem;">
                            <button type="submit" style="padding: 0.75rem 2rem; background: linear-gradient(135deg, #0ea5e9, #6366f1); color: white; border: none; border-radius: 0.75rem; font-weight: 700; font-size: 0.875rem; cursor: pointer; transition: all 0.3s; font-family: 'Inter', sans-serif;"
                                    onmouseover="this.style.transform='translateY(-2px)'; this.style.boxShadow='0 8px 24px rgba(56,189,248,0.3)';"
                                    onmouseout="this.style.transform='none'; this.style.boxShadow='none';">
                                💾 {{ __('Save Changes') }}
                            </button>
                            @if (session('status') === 'profile-updated')
                                <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2000)" style="color: #34d399; font-size: 0.875rem; font-weight: 500;">✅ Saved.</p>
                            @endif
                        </div>
                    </form>
                </div>
            </div>

            {{-- Update Password --}}
            <div style="background: rgba(17, 24, 39, 0.85); backdrop-filter: blur(16px); border: 1px solid rgba(255,255,255,0.06); border-radius: 1rem; padding: 2rem;">
                <div class="max-w-xl">
                    <h3 style="font-size: 1.125rem; font-weight: 700; color: #f1f5f9; margin-bottom: 0.25rem;">
                        🔐 {{ __('Update Password') }}
                    </h3>
                    <p style="font-size: 0.875rem; color: #64748b; margin-bottom: 1.5rem;">
                        {{ __('Ensure your account is using a long, random password to stay secure.') }}
                    </p>

                    <form method="post" action="{{ route('password.update') }}" style="display: flex; flex-direction: column; gap: 1.25rem;">
                        @csrf
                        @method('put')

                        <div>
                            <label for="update_password_current_password" style="display: block; font-size: 0.8125rem; font-weight: 500; color: #64748b; text-transform: uppercase; letter-spacing: 0.05em; margin-bottom: 0.4rem;">{{ __('Current Password') }}</label>
                            <input id="update_password_current_password" name="current_password" type="password" autocomplete="current-password"
                                   style="width: 100%; padding: 0.75rem 1rem; background: rgba(0,0,0,0.3); border: 1px solid rgba(255,255,255,0.06); border-radius: 0.75rem; color: #f1f5f9; font-size: 0.9375rem; font-family: 'Inter', sans-serif; transition: all 0.25s;"
                                   onfocus="this.style.borderColor='#38bdf8'; this.style.boxShadow='0 0 0 3px rgba(56,189,248,0.1)';"
                                   onblur="this.style.borderColor='rgba(255,255,255,0.06)'; this.style.boxShadow='none';">
                            @error('current_password', 'updatePassword') <p style="color: #f87171; font-size: 0.8125rem; margin-top: 0.35rem;">{{ $message }}</p> @enderror
                        </div>

                        <div>
                            <label for="update_password_password" style="display: block; font-size: 0.8125rem; font-weight: 500; color: #64748b; text-transform: uppercase; letter-spacing: 0.05em; margin-bottom: 0.4rem;">{{ __('New Password') }}</label>
                            <input id="update_password_password" name="password" type="password" autocomplete="new-password"
                                   style="width: 100%; padding: 0.75rem 1rem; background: rgba(0,0,0,0.3); border: 1px solid rgba(255,255,255,0.06); border-radius: 0.75rem; color: #f1f5f9; font-size: 0.9375rem; font-family: 'Inter', sans-serif; transition: all 0.25s;"
                                   onfocus="this.style.borderColor='#38bdf8'; this.style.boxShadow='0 0 0 3px rgba(56,189,248,0.1)';"
                                   onblur="this.style.borderColor='rgba(255,255,255,0.06)'; this.style.boxShadow='none';">
                            @error('password', 'updatePassword') <p style="color: #f87171; font-size: 0.8125rem; margin-top: 0.35rem;">{{ $message }}</p> @enderror
                        </div>

                        <div>
                            <label for="update_password_password_confirmation" style="display: block; font-size: 0.8125rem; font-weight: 500; color: #64748b; text-transform: uppercase; letter-spacing: 0.05em; margin-bottom: 0.4rem;">{{ __('Confirm Password') }}</label>
                            <input id="update_password_password_confirmation" name="password_confirmation" type="password" autocomplete="new-password"
                                   style="width: 100%; padding: 0.75rem 1rem; background: rgba(0,0,0,0.3); border: 1px solid rgba(255,255,255,0.06); border-radius: 0.75rem; color: #f1f5f9; font-size: 0.9375rem; font-family: 'Inter', sans-serif; transition: all 0.25s;"
                                   onfocus="this.style.borderColor='#38bdf8'; this.style.boxShadow='0 0 0 3px rgba(56,189,248,0.1)';"
                                   onblur="this.style.borderColor='rgba(255,255,255,0.06)'; this.style.boxShadow='none';">
                            @error('password_confirmation', 'updatePassword') <p style="color: #f87171; font-size: 0.8125rem; margin-top: 0.35rem;">{{ $message }}</p> @enderror
                        </div>

                        <div style="display: flex; align-items: center; gap: 1rem;">
                            <button type="submit" style="padding: 0.75rem 2rem; background: linear-gradient(135deg, #0ea5e9, #6366f1); color: white; border: none; border-radius: 0.75rem; font-weight: 700; font-size: 0.875rem; cursor: pointer; transition: all 0.3s; font-family: 'Inter', sans-serif;"
                                    onmouseover="this.style.transform='translateY(-2px)'; this.style.boxShadow='0 8px 24px rgba(56,189,248,0.3)';"
                                    onmouseout="this.style.transform='none'; this.style.boxShadow='none';">
                                🔐 {{ __('Update Password') }}
                            </button>
                            @if (session('status') === 'password-updated')
                                <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2000)" style="color: #34d399; font-size: 0.875rem; font-weight: 500;">✅ Updated.</p>
                            @endif
                        </div>
                    </form>
                </div>
            </div>

            {{-- Delete Account --}}
            <div style="background: rgba(17, 24, 39, 0.85); backdrop-filter: blur(16px); border: 1px solid rgba(239, 68, 68, 0.15); border-radius: 1rem; padding: 2rem;">
                <div class="max-w-xl">
                    <h3 style="font-size: 1.125rem; font-weight: 700; color: #f87171; margin-bottom: 0.25rem;">
                        ⚠️ {{ __('Delete Account') }}
                    </h3>
                    <p style="font-size: 0.875rem; color: #64748b; margin-bottom: 1.5rem;">
                        {{ __('Once your account is deleted, all of its resources and data will be permanently deleted.') }}
                    </p>

                    <button x-data="" x-on:click.prevent="$dispatch('open-modal', 'confirm-user-deletion')"
                            style="padding: 0.75rem 2rem; background: linear-gradient(135deg, #ef4444, #dc2626); color: white; border: none; border-radius: 0.75rem; font-weight: 700; font-size: 0.875rem; cursor: pointer; transition: all 0.3s; font-family: 'Inter', sans-serif;"
                            onmouseover="this.style.transform='translateY(-2px)'; this.style.boxShadow='0 8px 24px rgba(239,68,68,0.3)';"
                            onmouseout="this.style.transform='none'; this.style.boxShadow='none';">
                        🗑️ {{ __('Delete Account') }}
                    </button>

                    <x-modal name="confirm-user-deletion" :show="$errors->userDeletion->isNotEmpty()" focusable>
                        <form method="post" action="{{ route('profile.destroy') }}" style="padding: 2rem;">
                            @csrf
                            @method('delete')

                            <h2 style="font-size: 1.125rem; font-weight: 700; color: #f87171; margin-bottom: 0.5rem;">
                                {{ __('Are you sure?') }}
                            </h2>

                            <p style="font-size: 0.875rem; color: #64748b; margin-bottom: 1.5rem;">
                                {{ __('Please enter your password to confirm permanent deletion.') }}
                            </p>

                            <div>
                                <input id="password" name="password" type="password" placeholder="{{ __('Password') }}"
                                       style="width: 75%; padding: 0.75rem 1rem; background: rgba(0,0,0,0.3); border: 1px solid rgba(255,255,255,0.06); border-radius: 0.75rem; color: #f1f5f9; font-size: 0.9375rem; font-family: 'Inter', sans-serif;">
                                @error('password', 'userDeletion') <p style="color: #f87171; font-size: 0.8125rem; margin-top: 0.35rem;">{{ $message }}</p> @enderror
                            </div>

                            <div style="margin-top: 1.5rem; display: flex; justify-content: flex-end; gap: 0.75rem;">
                                <button type="button" x-on:click="$dispatch('close')"
                                        style="padding: 0.75rem 1.5rem; background: rgba(255,255,255,0.06); color: #94a3b8; border: 1px solid rgba(255,255,255,0.06); border-radius: 0.75rem; font-weight: 600; cursor: pointer; font-family: 'Inter', sans-serif;">
                                    {{ __('Cancel') }}
                                </button>
                                <button type="submit"
                                        style="padding: 0.75rem 1.5rem; background: linear-gradient(135deg, #ef4444, #dc2626); color: white; border: none; border-radius: 0.75rem; font-weight: 700; cursor: pointer; font-family: 'Inter', sans-serif;">
                                    🗑️ {{ __('Delete Account') }}
                                </button>
                            </div>
                        </form>
                    </x-modal>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
