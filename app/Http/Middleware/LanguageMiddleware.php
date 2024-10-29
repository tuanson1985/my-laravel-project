<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\App;

class LanguageMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Lấy segment đầu tiên của URL
        $segment_one = $request->segment(1);

        // Kiểm tra xem segment đầu tiên có phải là một mã ngôn ngữ hợp lệ
        if (!in_array($segment_one, ['vi', 'en'])) {
            // Lấy ngôn ngữ từ session hoặc config (ngôn ngữ mặc định)
            $language = Session::get('locale', config('app.locale'));

            // Redirect người dùng đến URL có ngôn ngữ
            return redirect("/{$language}/" . $request->path());
        }

        // Nếu URL đã có ngôn ngữ, thiết lập lại session và config
        Session::put('locale', $segment_one);
        App::setLocale($segment_one);

        return $next($request);
    }
}
