
<!DOCTYPE html>
<html lang="fa" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ورود به آکادمی</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="min-h-screen bg-base-200 flex items-center justify-center p-4">

    <div class="card bg-base-100 shadow-xl w-full max-w-md">
        <div class="card-body">
            <h1 class="text-2xl font-bold text-center">ورود به آکادمی</h1>
            <p class="text-sm text-center opacity-70 mb-4">
                برای ورود، اطلاعات حساب خود را وارد کنید.
            </p>

            @if (session('status'))
                <div class="alert alert-success mb-4">
                    {{ session('status') }}
                </div>
            @endif

            @if ($errors->any())
                <div class="alert alert-error mb-4">
                    اطلاعات ورود صحیح نیست یا ورود امکان‌پذیر نیست.
                </div>
            @endif

            <form method="POST" action="{{ route('login.store') }}" class="space-y-4">
                @csrf

                <div>
                    <label for="email" class="label">
                        <span class="label-text">ایمیل</span>
                    </label>
                    <input
                        id="email"
                        name="email"
                        type="email"
                        value="{{ old('email') }}"
                        autocomplete="username"
                        required
                        autofocus
                        class="input input-bordered w-full"
                        dir="ltr"
                    >
                    @error('email')
                        <p class="text-error text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="password" class="label">
                        <span class="label-text">رمز عبور</span>
                    </label>
                    <input
                        id="password"
                        name="password"
                        type="password"
                        autocomplete="current-password"
                        required
                        class="input input-bordered w-full"
                        dir="ltr"
                    >
                    @error('password')
                        <p class="text-error text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <label class="flex items-center gap-2">
                    <input
                        type="checkbox"
                        name="remember"
                        value="1"
                        class="checkbox checkbox-sm"
                    >
                    <span class="text-sm">مرا به خاطر بسپار</span>
                </label>

                <button type="submit" class="btn btn-primary w-full">
                    ورود
                </button>
            </form>
        </div>
    </div>

</body>
</html>
