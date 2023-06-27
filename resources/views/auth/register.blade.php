<x-guest-layout>
    <form method="POST" action="{{ route('register') }}">
        @csrf

        <div class="divide-x space-x-3" style="display: flex; align-items-center">
          <div style="flex-grow:1;">
            <!-- Name -->
            <div>
                <x-input-label for="name" :value="__('Name')" />
                <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
                <x-input-error :messages="$errors->get('name')" class="mt-2" />
            </div>

            <!-- Email Address -->
            <div class="mt-4">
                <x-input-label for="email" :value="__('Email')" />
                <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autocomplete="username" />
                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>

            <!-- Password -->
            <div class="mt-4">
                <x-input-label for="password" :value="__('Password')" />

                <x-text-input id="password" class="block mt-1 w-full"
                                type="password"
                                name="password"
                                required autocomplete="new-password" />

                <x-input-error :messages="$errors->get('password')" class="mt-2" />
            </div>

            <!-- Confirm Password -->
            <div class="mt-4">
                <x-input-label for="password_confirmation" :value="__('Confirm Password')" />

                <x-text-input id="password_confirmation" class="block mt-1 w-full"
                                type="password"
                                name="password_confirmation" required autocomplete="new-password" />

                <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
            </div>
          </div>
          <div style="flex-grow:1;" class="pl-3">
            <div>
                <x-input-label for="phone" :value="__('Nomor HP')" />
                <x-text-input id="phone" class="block mt-1 w-full" type="text" name="phone" :value="old('phone')" required autofocus autocomplete="phone" />
                <x-input-error :messages="$errors->get('phone')" class="mt-2" />
            </div>
            <div class="mt-4">
              <x-input-label for="gender" :value="__('Jenis Kelamin')" />
              <div class="mt-3 flex flex-col space-y-3">
                <div>
                  <input type="radio" name="gender" id="" value="m" class="mr-1" checked /> Laki Laki
                </div>
                <div>
                  <input type="radio" name="gender" id="" value="f" class="mr-1"/> Perempuan
                </div>
              </div>
              <x-input-error :messages="$errors->get('gender')" class="mt-2" />
            </div>
            <div class="mt-7">
              <x-input-label for="address" :value="__('Alamat')" />
              <x-text-input id="address" class="block mt-1 w-full h-full" type="text" name="address" :value="old('address')" required autofocus autocomplete="address" />
              <x-input-error :messages="$errors->get('address')" class="mt-2" />
            </div>
          </div>
        </div>

        <div class="flex items-center justify-end mt-4">
            <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('login') }}">
                {{ __('Sudah punya akun?') }}
            </a>

            <x-primary-button class="ml-4">
                {{ __('Daftar') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>