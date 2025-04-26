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
