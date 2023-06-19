@props(['user', 'tickets'])

<div {!! $attributes->merge(['class' => 'flex flex-col py-6 items-center justify-center']) !!}>
    <ul class="flex flex-col w-5/12">
        @foreach ($tickets as $ticket)
            <li class="flex flex-row mb-2 border-gray-400 h-44">
                <div
                    class="cursor-pointer bg-white dark:bg-gray-800 rounded-md flex flex-1 items-center justify-start p-4">
                    <div class="flex flex-col items-center justify-center w-12 h-12 mr-4">
                        <x-avatar :user="$user" />
                    </div>
                    <div class="flex-1 pl-1 md:mr-16">
                        <div class="font-medium dark:text-white">
                            {{ $user->name }}
                        </div>
                        <div class="text-sm text-gray-600 dark:text-gray-200">
                            {{ $user->email }}
                        </div>
                    </div>
                    <div class=" text-lg text-gray-600 dark:text-gray-200">
                        {{ $ticket->title }}
                    </div>
                    <div class="flex flex-col ml-8">
                        <x-nav-link href="{{ route('ticket.edit', $ticket) }}">Edit</x-nav-link>
                        <x-nav-link href="{{ route('ticket.show', $ticket) }}">View</x-nav-link>
                    </div>

                </div>
            </li>
        @endforeach
    </ul>
</div>
