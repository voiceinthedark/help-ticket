<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
            {{ __('Avatar') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
            {{ __("Add or update Avatar") }}
        </p>
    </header>

    <div class="mt-6 flex items-center gap-6">
         <img src="{{ url($user->avatar) }}" class="rounded-full w-20 h-20" alt="Avatar" srcset="{{ $user->avatar }}">
    </div>

    <form action="{{ route('profile.generate') }}" class="mt-6 space-y-6" method="post">
        @csrf
        {{-- @method('patch') --}}

        <div class="flex items-center gap-4">
            <x-primary-button>{{ __('Generate Avatar') }}</x-primary-button>
        </div>
    </form>

    <p class="mt-6 text-base text-gray-600 dark:text-gray-400">{{ __("Or Upload a new Avatar") }}</p>

    <form method="post" action="{{ route('profile.avatar') }}" class="mt-6 space-y-6" enctype="multipart/form-data">
        @csrf
        @method('patch')

        <div>
            <x-input-label for="avatar" :value="__('Avatar')" />
            <x-text-input id="avatar" name="avatar" type="file" class="mt-1 block w-full" :value="old('avatar', $user->avatar)" required autofocus autocomplete="avatar" />
            <x-input-error class="mt-2" :messages="$errors->get('avatar')" />
        </div>


        <div class="flex items-center gap-4">
            <x-primary-button>{{ __('Save') }}</x-primary-button>

        </div>
    </form>
</section>
