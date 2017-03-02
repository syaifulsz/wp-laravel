<?php

namespace App\Http\Middleware;

use Closure;
use Cache;

class CachePage
{
    public function handle($request, Closure $next)
    {
        $key = $request->fullUrl();
        if (Cache::has($key) && Cache::get($key) && config('cms.useCache.view')) return response(Cache::get($key));

        $content = $next($request)->content();
        $content = \Minify_HTML::minify($content);

        Cache::put($key, $content, 60);

        return $next($request);
    }
}