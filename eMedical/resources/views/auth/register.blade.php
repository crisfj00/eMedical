<x-guest-layout>
    <x-auth-card>
        <x-slot name="logo">
            <a href="/">
                <x-application-logo class="w-20 h-20 fill-current text-gray-500" />
            </a>
        </x-slot>

        <!-- Validation Errors -->
        <x-auth-validation-errors class="mb-4" :errors="$errors" />

        @if (Route::has('login'))
                <div class="hidden fixed top-0 right-0 px-6 py-4 sm:block">
                    @auth
                        <a href="{{ url('/dashboard') }}" class="text-sm text-gray-700 dark:text-gray-500 underline">Dashboard</a>
                    @else
                        <a href="{{ route('login') }}" class="text-sm text-gray-700 dark:text-gray-500">Log in</a>

                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="ml-4 text-sm text-gray-700 dark:text-gray-500 underline">Register</a>
                        @endif
                    @endauth
                </div>
        @endif

        <form method="POST" action="{{ route('register') }}">
            @csrf

            <!-- Name -->
            <div>
                <x-label for="name" :value="__('Name')" />

                <x-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus />
            </div>

            <!-- Id Number -->
            <div>
                <x-label for="id_number" :value="__('ID Number')" />

                <x-input id="id" maxlength="10" onkeyup="this.value = this.value.toUpperCase();" onpaste="return false;" ondrop="return false;" autocomplete="off" onkeydown="return /[a-z0-9]/i.test(event.key)"  class="block mt-1 w-full" type="text" name="id" :value="old('id')" required autofocus />
            </div>

            <div>
                <x-label for="healthcare_number" :value="__('Health Care Number')" />

                <x-input id="healthcare_number" maxlength="10" onkeyup="this.value = this.value.toUpperCase();" onpaste="return false;" ondrop="return false;" autocomplete="off" onkeydown="return /[a-z0-9]/i.test(event.key)"  class="block mt-1 w-full" type="text" name="healthcare_number" :value="old('healthcare_number')" required autofocus />
            </div>

            <!-- Email Address -->
            <div class="mt-4">
                <x-label for="email" :value="__('Email')" />

                <x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required />
            </div>

            <div>
                <x-label for="birthday" :value="__('Date of birthday')" />

                <x-input id="birthday" class="block mt-1 w-full" type="date" name="birthday" :value="old('birthday')" required autofocus />
            </div>
            
            <div>
                <x-label for="occupation" :value="__('Occupation')" />

                <x-input id="occupation" class="block mt-1 w-full" onpaste="return false;" ondrop="return false;" autocomplete="off" onkeydown="return /[a-z ]/i.test(event.key)" type="text" name="occupation" :value="old('occupation')" required autofocus />
            </div>

            <div>
                <x-label for="address" :value="__('Address')" />

                <x-input id="address" class="block mt-1 w-full" type="text" name="address" :value="old('address')" required autofocus />
            </div>

            <div>
                <x-label for="phone_number" :value="__('Phone Number')" />

                <x-input id="phone_number"  maxlength="20"  onpaste="return false;" oninput="this.value = this.value.replace(/+-[^0-9]/g, '').replace(/(\.*)\./g, '$1');" class="block mt-1 w-full"  type="text" name="phone_number" :value="old('phone_number')" required autofocus />
            </div>

            <!-- Password -->
            <div class="mt-4">
                <x-label for="password" :value="__('Password')" />

                <x-input id="password" class="block mt-1 w-full"
                                type="password"
                                name="password"
                                required autocomplete="new-password" />
            </div>

            <!-- Confirm Password -->
            <div class="mt-4">
                <x-label for="password_confirmation" :value="__('Confirm Password')" />

                <x-input id="password_confirmation" class="block mt-1 w-full"
                                type="password"
                                name="password_confirmation" required />
            </div>

            <div class="flex items-center justify-end mt-4">
                <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('login') }}">
                    {{ __('Already registered?') }}
                </a>

                <x-button class="ml-4">
                    {{ __('Register') }}
                </x-button>
            </div>
        </form>
    </x-auth-card>
</x-guest-layout>
