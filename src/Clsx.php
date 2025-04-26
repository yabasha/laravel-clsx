<?php

namespace Yabasha\Clsx;

class Clsx
{
    /**
     * Conditionally join class names (like clsx in JS).
     *
     * @param  mixed  ...$args
     */
    public static function make(...$args): string
    {
        $classes = [];

        foreach ($args as $arg) {
            if (is_string($arg)) {
                $classes[] = $arg;
            } elseif (is_array($arg)) {
                foreach ($arg as $key => $value) {
                    if (is_string($key)) {
                        if ($value) {
                            $classes[] = $key;
                        }
                    } else {
                        $classes[] = $value;
                    }
                }
            }
        }

        return implode(' ', array_unique(array_filter($classes)));
    }
}
