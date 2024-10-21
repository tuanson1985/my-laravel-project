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
//        $language = Session::get('locale', config('app.locale'));
//        // Lấy dữ liệu lưu trong Session, không có thì trả về default lấy trong config
//
//        config(['app.locale' => $language]);


        if (!in_array($request->segment(1), ['vi', 'en'])) {
            $language = Session::get('locale', config('app.locale'));
            // Chuyển hướng đến ngôn ngữ mặc định (ví dụ: /vi)
            return redirect('/'. $language . $request->getRequestUri());
        }
        $segment_one = $request->segment(1);
        Session::put('locale', $segment_one);
        config(['app.locale' => $segment_one]);
        $language = Session::get('locale', config('app.locale'));
        App::setLocale($language);

        return $next($request);
    }
}
