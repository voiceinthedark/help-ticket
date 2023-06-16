<section class="space-y-6 w-9/12 mx-auto text-center">
    <header>
        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
            {{ __('Delete Ticket') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
            {{ __('Once The Ticket is deleted, it\'s gone forever') }}
        </p>
    </header>

    <x-danger-button
        x-data=""
        x-on:click.prevent="$dispatch('open-modal', 'confirm-ticket-deletion')"
    >{{ __('Delete Ticket') }}</x-danger-button>

    <x-modal name="confirm-ticket-deletion" :show="$errors->ticketDeletion->isNotEmpty()" focusable>
        <form method="post" action="{{ route('ticket.destroy', $ticket) }}" class="p-6">
            @csrf
            @method('delete')

            <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                {{ __('Are you sure you want to delete your ticket?') }}
            </h2>

            <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                {{ __('Once your Ticket is deleted it\'s gone forever.') }}
            </p>

            {{-- <div class="mt-6">
                <x-input-label for="password" value="{{ __('Password') }}" class="sr-only" />

                <x-text-input
                    id="password"
                    name="password"
                    type="password"
                    class="mt-1 block w-3/4"
                    placeholder="{{ __('Password') }}"
                />

                <x-input-error :messages="$errors->ticketDeletion->get('password')" class="mt-2" />
            </div> --}}

            <div class="mt-6 flex justify-end">
                <x-secondary-button x-on:click="$dispatch('close')">
                    {{ __('Cancel') }}
                </x-secondary-button>

                <x-danger-button class="ml-3">
                    {{ __('Delete Ticket') }}
                </x-danger-button>
            </div>
        </form>
    </x-modal>
</section>
