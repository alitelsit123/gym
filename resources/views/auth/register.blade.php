<x-guest-layout>
  <form method="POST" action="{{ route('register') }}">
    @csrf

    <div class="divide-x space-x-3" style="display: flex; align-items-center">
      <div style="flex-grow:1;">
          <!-- Name -->
          <div>
            <x-input-label for="name" :value="__('Name')" />
            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required
              autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
          </div>

          <!-- Email Address -->
          <div class="mt-4">
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')"
              required autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
          </div>

          <!-- Password -->
          <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />

            <div class="relative">
              <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required
                autocomplete="new-password" />
              <button type="button" id="togglePasswordVisibility" class="absolute right-0 top-0 mr-4"
                style="position: absolute;margin-top:-2rem;right:.5rem;">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                  stroke="currentColor" class="w-6 h-6">
                  <path stroke-linecap="round" stroke-linejoin="round"
                    d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178z" />
                  <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                </svg>

              </button>
            </div>
            <script>
              const togglePasswordVisibilityButton = document.getElementById('togglePasswordVisibility');
              const passwordInput = document.getElementById('password');

              togglePasswordVisibilityButton.addEventListener('click', () => {
                const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
                passwordInput.setAttribute('type', type);

                // Toggle eye icon color
                togglePasswordVisibilityButton.classList.toggle('text-gray-100');
                togglePasswordVisibilityButton.classList.toggle('text-gray-700');
              });
            </script>
          </div>
          <x-input-error :messages="$errors->get('password')" class="mt-2" />

          <!-- Confirm Password -->
          <div class="mt-4">
            <x-input-label for="password_confirmation" :value="__('Confirm Password')" />


            <div class="relative">
              <x-text-input id="password_confirmation" class="block mt-1 w-full" type="password" name="password_confirmation"
              required autocomplete="new-password" />
              <button type="button" id="togglePasswordVisibilitys" class="absolute right-0 top-0 mr-4"
                style="position: absolute;margin-top:-2rem;right:.5rem;">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                  stroke="currentColor" class="w-6 h-6">
                  <path stroke-linecap="round" stroke-linejoin="round"
                    d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178z" />
                  <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                </svg>

              </button>
            </div>
            <script>
              const togglePasswordVisibilityButtons = document.getElementById('togglePasswordVisibilitys');
              const passwordInputs = document.getElementById('password_confirmation');

              togglePasswordVisibilityButtons.addEventListener('click', () => {
                const type = passwordInputs.getAttribute('type') === 'password' ? 'text' : 'password';
                passwordInputs.setAttribute('type', type);

                // Toggle eye icon color
                togglePasswordVisibilityButtons.classList.toggle('text-gray-100');
                togglePasswordVisibilityButtons.classList.toggle('text-gray-700');
              });
            </script>

            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
          </div>
      </div>

      <div style="flex-grow:1;" class="pl-3">
        <div>
          <x-input-label for="phone" :value="__('Nomor HP')" />
          <x-text-input id="phone" class="block mt-1 w-full" type="text" name="phone" :value="old('phone')" required
            autofocus autocomplete="phone" />
          <x-input-error :messages="$errors->get('phone')" class="mt-2" />
        </div>
        <div class="mt-4">
          <x-input-label for="gender" :value="__('Jenis Kelamin')" />
          <div class="mt-3 flex flex-col space-y-3">
            <div>
              <input type="radio" name="gender" id="" value="m" class="mr-1" checked /> Laki Laki
            </div>
            <div>
              <input type="radio" name="gender" id="" value="f" class="mr-1" /> Perempuan
            </div>
          </div>
          <x-input-error :messages="$errors->get('gender')" class="mt-2" />
        </div>
        <div class="mt-7">
          <x-input-label for="address" :value="__('Alamat')" />
          <x-text-input id="address" class="block mt-1 w-full h-full" type="text" name="address" :value="old('address')"
            required autofocus autocomplete="address" />
          <x-input-error :messages="$errors->get('address')" class="mt-2" />
        </div>
      </div>
      {{-- </div> --}}

    </div>


    <div class="flex items-center justify-end mt-4">
      <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
        href="{{ route('login') }}">
        {{ __('Sudah punya akun?') }}
      </a>

      <x-primary-button class="ml-4">
        {{ __('Daftar') }}
      </x-primary-button>
    </div>
  </form>
</x-guest-layout>
