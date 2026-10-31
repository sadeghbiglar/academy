<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    /**
     * نمایش صفحه ورود
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * بررسی اطلاعات و ورود کاربر
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required', 'string'],
        ]);

        // ساخت کلید محدودیت تلاش بر اساس ایمیل و IP
        $key = Str::transliterate(
            Str::lower($request->input('email')) . '|' . $request->ip()
        );

        // جلوگیری از تلاش‌های مکرر برای ورود
        if (RateLimiter::tooManyAttempts($key, 5)) {
            throw ValidationException::withMessages([
                'email' => 'تعداد تلاش‌های ورود بیش از حد مجاز است. لطفاً کمی بعد دوباره تلاش کنید.',
            ]);
        }

        // بررسی ایمیل و رمز عبور
        $credentials = $request->only('email', 'password');

        if (! Auth::attempt($credentials, $request->boolean('remember'))) {
            RateLimiter::hit($key, 60);

            throw ValidationException::withMessages([
                'email' => 'ایمیل یا رمز عبور صحیح نیست.',
            ]);
        }

        // پاک کردن شمارنده تلاش‌های ناموفق
        RateLimiter::clear($key);

        // بازسازی نشست برای امنیت بیشتر
        $request->session()->regenerate();

        // انتقال به صفحه‌ای که کاربر قصد بازدید از آن را داشت
        return redirect()->intended('/students');
    }

    /**
     * خروج امن کاربر از حساب
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        // باطل کردن نشست قبلی
        $request->session()->invalidate();

        // تولید توکن CSRF جدید
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }
}