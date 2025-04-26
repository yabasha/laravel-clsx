# Laravel Clsx

A Laravel utility for conditional class name concatenation, inspired by the popular [clsx](https://github.com/lukeed/clsx) JavaScript package.

## Features

- Concatenate class names based on conditions
- Use as a global helper (`clsx()`) or as a static class (`Clsx::make()`)
- Perfect for Blade templates and PHP code

## Installation

```bash
composer require yabasha/laravel-clsx
```

## Usage

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
