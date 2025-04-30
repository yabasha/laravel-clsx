<?php

use PHPUnit\Framework\TestCase;
use Yabasha\Clsx\Clsx;

class ClsxTest extends TestCase
{
    public function test_basic_strings()
    {
        $this->assertEquals('foo bar', Clsx::make('foo', 'bar'));
    }

    public function test_array_conditionals()
    {
        $this->assertEquals('foo bar', Clsx::make(['foo' => true, 'bar' => true, 'baz' => false]));
    }

    public function test_nested_arrays()
    {
        $this->assertEquals('foo bar baz', Clsx::make(['foo', ['bar', ['baz']]]));
    }

    public function test_filtering()
    {
        $result = Clsx::make('foo', 'bar', function($c) { return strtoupper($c); });
        $this->assertEquals('FOO BAR', $result);
    }

    public function test_deduplication()
    {
        $this->assertEquals('foo bar', Clsx::make('foo', 'bar', 'foo'));
    }
}
