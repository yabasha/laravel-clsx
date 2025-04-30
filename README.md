# Laravel Clsx

A Laravel utility for conditional class name concatenation, inspired by the popular [clsx](https://github.com/lukeed/clsx) JavaScript package.

## Features

- Concatenate class names based on conditions
- Supports arbitrarily nested arrays of class names
- Optional transformation/filter callback for class names
- Use as a global helper (`clsx()`) or as a static class (`Clsx::make()`)
- Macroable: extend with your own methods
- Blade directive: `@clsx` for easy usage in Blade templates
- Validation helper: `clsx_with_error()` for error class toggling
- Perfect for Blade templates and PHP code

## Installation

```bash
composer require yabasha/laravel-clsx
```

## Usage

### Nested Arrays

You can pass deeply nested arrays and all class names will be flattened:

```php
$classString = clsx(['foo', ['bar', ['baz']]]); // "foo bar baz"
```

### Filtering/Transformation Callback

Optionally pass a callable as the last argument to transform class names:

```php
$classString = clsx('foo', 'bar', function($c) { return strtoupper($c); }); // "FOO BAR"
```

### Macroable (Extending Clsx)

You can add your own macros to Clsx:

```php
use Yabasha\Clsx\Clsx;
Clsx::macro('withPrefix', function ($prefix, ...$args) {
    return Clsx::make(...array_map(fn($c) => $prefix.$c, $args));
});
// Usage:
$classes = Clsx::withPrefix('tw-', 'foo', 'bar'); // "tw-foo tw-bar"
```

### Blade Directive

Register the Blade directive by ensuring the service provider is loaded (auto-discovered):

```blade
<div class="@clsx('foo', ['bar' => $isBar])"></div>
```

### Validation Helper

Add error classes easily:

```php
<input class="<?= clsx_with_error('email', $errors, 'is-invalid', 'form-input') ?>">
```

### In Blade Templates

```blade
<div class="{{ clsx('p-4', ['active' => $isActive, 'disabled' => !$isEnabled], $extraClasses) }}">
    Example
</div>
```

### In PHP

```php
use Yabasha\Clsx\Clsx;

$classString = Clsx::make('foo', ['bar' => $isBar, 'baz' => $isBaz], $moreClasses);
```

### Advanced Examples

**Conditional route:**

```blade
<li class="{{ clsx('nav-item', ['active' => Route::is('dashboard')]) }}">
    <a href="{{ route('dashboard') }}">Dashboard</a>
</li>
```

**With validation errors:**

```blade
<input type="text" class="{{ clsx('form-input', ['is-invalid' => $errors->has('email')]) }}">
```

**Mixing arrays and strings:**

```blade
@php
    $extra = 'rounded shadow';
@endphp

<div class="{{ clsx('p-4', ['bg-blue-500' => $isBlue], $extra) }}">
    Mixed usage
</div>
```

**Using the static class in Blade:**

```blade
@php
    use Yabasha\Clsx\Clsx;
@endphp
<div class="{{ Clsx::make('card', ['card-highlight' => $highlight]) }}">
    Card Content
</div>
```

**Looping over items:**

```blade
@foreach($items as $item)
    <div class="{{ clsx('item', ['selected' => $item->isSelected(), 'disabled' => !$item->isEnabled()]) }}">
        {{ $item->name }}
    </div>
@endforeach
```

## License

MIT
