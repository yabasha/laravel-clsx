<?php

namespace Yabasha\Clsx;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Blade;

class LaravelClsxServiceProvider extends ServiceProvider
{
    public function boot()
    {
        // Register the @clsx Blade directive
        Blade::directive('clsx', function ($expression) {
            return "<?php echo e(clsx($expression)); ?>";
        });
    }

    public function register()
    {
        // No bindings needed
    }
}
