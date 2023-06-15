<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-slate-900 dark:text-white leading-5 ">
            {{ __('Create Ticket') }}
        </h2>
    </x-slot>
    {{-- Create The Ticket form to hold the body --}}
    <form method="POST" action="{{ route('ticket.store') }}" enctype="multipart/form-data">
        @csrf
        <div class="mt-8 mx-auto w-2/5">
            <div>
                <x-input-label for="title" :value="__('Title')" />
                <x-text-input id="title" class="block mt-1 w-full" type="text" name="title" :value="old('title')"
                    required autofocus autocomplete="title" />
                <x-input-error :messages="$errors->get('title')" class="mt-2" />
            </div>
            <div>
                <x-input-label for="description" :value="__('Description')" />
                <x-text-area id="description" name="description"/>
                <x-input-error :messages="$errors->get('description')" class="mt-2" />
            </div>
            <div>
                <x-file-input name="attachment" id="attachment" />
                <x-input-error :messages="$errors->get('attachment')" class="mt-2" />
            </div>
            <div class="flex justify-end">
                <x-primary-button class="my-6">{{ __('Create Ticket') }}</x-primary-button>
            </div>
        </div>
    </form>

</x-app-layout>
