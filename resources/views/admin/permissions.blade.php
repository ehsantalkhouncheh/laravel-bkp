<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Permission') }}
        </h2>
    </x-slot>

    <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">
        <livewire:admin.permission/>
    </div>
</x-app-layout>
