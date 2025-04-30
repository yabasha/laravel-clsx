<?php

namespace Yabasha\Clsx;

use Illuminate\Support\Traits\Macroable;

class Clsx
{
    /**
     * Conditionally join class names (like clsx in JS).
     *
     * @param  mixed  ...$args
     */
    /**
     * Conditionally join class names (like clsx in JS), supporting nested arrays and optional transformation.
     *
     * @param  mixed ...$args
     * @return string
     */
    public static function make(...$args): string
    {
        $filter = null;
        if (count($args) && is_callable($args[count($args)-1])) {
            $filter = array_pop($args);
        }
        $classes = self::flatten($args);
        $classes = array_filter($classes, fn($c) => is_string($c) && $c !== '');
        if ($filter) {
            $classes = array_map($filter, $classes);
        }
        return implode(' ', array_unique($classes));
    }

    /**
     * Recursively flatten class names from nested arrays/structures.
     *
     * @param mixed $items
     * @return array
     */
    protected static function flatten($items): array
    {
        $result = [];
        foreach ($items as $item) {
            if (is_string($item)) {
                $result[] = $item;
            } elseif (is_array($item)) {
                foreach ($item as $key => $value) {
                    if (is_string($key)) {
                        if ($value) {
                            $result[] = $key;
                        }
                    } else {
                        $result = array_merge($result, self::flatten([$value]));
                    }
                }
            }
        }
        return $result;
    }
}
