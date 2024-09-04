<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\Setting;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;

class SetLocale
{
    // ...
      private $locales = [ 'en','ar'];

    // ...
    public function handle($request, Closure $next)
    {
        $locale = $request->header('Accept-Language');
        if (in_array($locale, $this->locales)) {
            App::setLocale($locale);
        } else {
            $locale = Cookie::get('lang');
            if (in_array($locale, $this->locales)) {
                App::setLocale($locale);
            } else {
                App::setLocale('ar');
            }
        }

        return $next($request);
    }
}
