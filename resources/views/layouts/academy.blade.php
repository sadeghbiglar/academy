<!DOCTYPE html>
<html lang="fa" dir="rtl">

<head>
    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>
        {{ $title ?? 'آموزشگاه' }}
    </title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    @livewireStyles
</head>

<body class="min-h-screen bg-base-200">

    <div class="p-6">


        <div class="mb-6 flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
            <div>
                <h1 class="text-2xl font-bold">
                    🎓 آموزشگاه خصوصی
                </h1>

                <p class="text-sm opacity-60">
                    سامانه مدیریت آموزشگاه
                </p>
            </div>

            @auth
            <div class="flex items-center gap-3">
                <span class="text-sm">
                    خوش آمدید، {{ auth()->user()->name }}
                </span>

                <form method="POST" action="{{ route('logout') }}">
                    @csrf

                    <button
                        type="submit"
                        class="rounded-lg bg-red-600 px-4 py-2 text-sm font-semibold text-white hover:bg-red-700">
                        خروج
                    </button>
                </form>
            </div>
            @endauth
        </div>


        <main>
            {{ $slot }}
            <x-toast />
        </main>

    </div>

    @livewireScripts

</body>

</html>