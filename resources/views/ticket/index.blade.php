<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-slate-900 dark:text-white leading-5 ">
            {{ __('Tickets') }}
        </h2>
    </x-slot>

    <x-list-items :user="$user" :tickets="$tickets" class="mt-12 max-w-4xl mx-auto"/>



</x-app-layout>
