<?php

use Yabasha\Clsx\Clsx;

if (! function_exists('clsx')) {
    /**
     * Conditionally join class names (like clsx in JS).
     *
     * @param  mixed  ...$args
     */
    function clsx(...$args): string
    {
        return Clsx::make(...$args);
    }
}

if (! function_exists('clsx_with_error')) {
    /**
     * Join class names and add an error class if the validation errors contain the given key.
     *
     * @param string $key
     * @param array $errors
     * @param string $errorClass
     * @param mixed ...$args
     * @return string
     */
    function clsx_with_error(string $key, $errors, string $errorClass = 'is-invalid', ...$args): string
    {
        $hasError = ($errors instanceof \Illuminate\Support\MessageBag)
            ? $errors->has($key)
            : (is_array($errors) ? !empty($errors[$key]) : false);
        $args[] = [$errorClass => $hasError];
        return clsx(...$args);
    }
}
