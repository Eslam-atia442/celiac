<?php

use Illuminate\Support\Arr;

if (!function_exists('__json')) {
    /**
     * Get the translation for a given key from json files.
     *
     * @param string|null $key
     * @param array $replace
     * @param string|null $locale
     * @return string|array|null
     */
    function __json(string $key = null, array $replace = [], string $locale = null): array|string|null
    {
        // Default behavior
        if (is_null($key)) return $key;
        if (trans()->has($key)) return trans($key, $replace, $locale);
        // Search in .json file
        $search = Arr::get(trans('*'), $key);
        if ($search !== null) return $search;
        // Return .json fallback
        $fallback = Arr::get(trans('*', [], config('app.fallback_locale')), $key);
        if ($fallback !== null) return $fallback;
        // Return key name if not found
        else return $key;
    }
}

if (!function_exists('static_url')) {
    /**
     * default static url for file not exists (specific for frontend)
     *
     */
    function static_url($url): array
    {
        return ['url' => asset("UI/assets/$url")];
    }
}


