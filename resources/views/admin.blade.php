<x-app-layout>
    <div class="py-10">
        <x-slot name="header">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Admin Dashboard') }}
            </h2>
            <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <h1 class="text-3xl font-bold leading-tight tracking-tight text-gray-900">Dashboard</h1>
        </div>
        </x-slot>
        <main>
        <div class="py-12">
            <div class="mx-auto max-w-7xl px-4 py-8 sm:px-6 lg:px-8">
                        {{ __("You're logged in!") }}
                        <!-- Your content -->
            </div>
        </div>
     
    </main>
  </div>
</x-app-layout>

