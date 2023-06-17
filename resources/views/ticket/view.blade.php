<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-slate-900 dark:text-white leading-5">
            {{ 'Ticket #' .$ticket->id }}
        </h2>
    </x-slot>

    <div class="mt-8 mx-auto w-2/5 flex flex-col">
        <h3 class="mb-4 font-extrabold text-xl font-mono text-slate-900 dark:text-white leading-5" >{{ $ticket->title }}</h3>
        <hr class="border-gray-400">
        <section class="border border-gray-400 rounded-lg p-4 mt-8 font-extrabold text-normal text-slate-900 dark:text-white leading-5">
            {{ $ticket->description }}
        </section>
        @if ($ticket->attachment)
            <section class="p-4 mt-8 font-extrabold text-normal text-slate-900 dark:text-white leading-5">
               Attachment: <a href="{{ asset('storage/' . $ticket->attachment) }}">{{ $ticket->attachment }}</a>
            </section>
        @endif
    </div>


</x-app-layout>
