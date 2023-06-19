<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-slate-900 dark:text-white leading-5">
            {{ 'Ticket #' .$ticket->id }}
        </h2>
    </x-slot>

    <div class="mt-8 mx-auto w-2/5 flex flex-col">
        <div class="flex flex-1 justify-between items-center">
            <div class="flex flex-col gap-2 dark:text-white text-gray-500">
                <x-avatar :user="$user" class="w-12 h-12"/>
                <h4>{{ $user->email }}</h4>
            </div>

            <div class="flex flex-col items-end mb-2">
                <h3 class="mb-4  font-extrabold text-xl font-mono text-slate-900 dark:text-white leading-5" >{{ $ticket->title }}</h3>
                <h4 class="mb-4  font-extrabold text-xl font-mono text-slate-900 dark:text-white">
                    {{ $ticket->created_at->diffForHumans() }}
                </h4>
            </div>
        </div>
        <hr class="border-gray-400">
        <section class="border border-gray-400 rounded-lg p-4 mt-8 font-extrabold text-normal text-slate-900 dark:text-white leading-5 h-auto">
            {{ $ticket->description }}
        </section>
        @if ($ticket->attachment)
            <section class="p-4 mt-8 font-extrabold text-normal text-slate-900 dark:text-white leading-5">
               Attachment: <a href="{{ asset('storage/' . $ticket->attachment) }}">{{ $ticket->attachment }}</a>
            </section>
        @endif
    </div>


</x-app-layout>
