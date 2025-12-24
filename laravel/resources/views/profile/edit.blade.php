<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Profile') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.update-profile-information-form')
                </div>
            </div>

            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.update-password-form')
                </div>
            </div>

            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.delete-user-form')
                </div>
            </div>
        </div>
    </div>
    <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
    <div class="max-w-xl">
        <h3 class="text-lg font-medium text-gray-900 dark:text-gray-100">
            API токен (Passport)
        </h3>

        <form method="POST" action="{{ route('profile.token') }}" class="mt-3">
            @csrf
            <button type="submit" class="btn btn-primary">
                Сгенерировать токен
            </button>
        </form>

        @if(session('api_token'))
            <div class="mt-3">
                <div><strong>Токен (скопируй сейчас):</strong></div>
                <pre style="white-space: pre-wrap;">{{ session('api_token') }}</pre>
                <div><strong>Postman Header:</strong></div>
                <pre>Authorization: Bearer {{ session('api_token') }}</pre>
            </div>
        @endif
    </div>
</div>
</x-app-layout>
