<div>
    <x-input-label for="attachment" :value="__('Attachment')" />
    {{-- <input type="file" class="block mt-1 w-full" /> --}}
    <input {!! $attributes->merge([
        'class' =>
            'block w-full px-3 py-2 mt-2 text-sm text-gray-600 bg-white border border-gray-300 rounded-lg file:bg-gray-200 file:text-gray-700 file:text-sm file:px-4 file:py-1 file:border-none file:rounded-full dark:file:bg-gray-800 dark:file:text-gray-200 dark:text-gray-300 placeholder-gray-400/70 dark:placeholder-gray-500 focus:border-indigo-500 focus:outline-none focus:ring focus:ring-indigo-500 focus:ring-opacity-40 dark:border-indigo-600 dark:bg-gray-900 dark:focus:border-indigo-600',
    ]) !!} type="file" />
</div>
