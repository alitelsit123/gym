<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />

            <div class="relative">
              <x-text-input id="password" class="block mt-1 w-full"
                            type="password"
                            name="password"
                            required autocomplete="current-password" />
                            <button
                            type="button"
                            id="togglePasswordVisibility"
                            class="absolute right-0 top-0 mr-4"
                            style="position: absolute;margin-top:-2rem;right:.5rem;"
                          >
                          <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178z" />
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                          </svg>

                          </button>
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
        </div>

        @if (session('error'))
        <x-input-error :messages="session('error')" class="mt-2" />
        @endif

        <div style="margin-top:1rem;">
          <a href="{{url('forgot-password')}}">Lupa Password ?</a>
        </div>

        <div class="flex items-center justify-end mt-4">
            <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('register') }}">
                {{ __('Daftar') }}
            </a>
            <x-primary-button class="ml-3">
                {{ __('Masuk') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
