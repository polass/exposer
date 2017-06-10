<?php

namespace Polass\Tests;

use PHPUnit\Framework\TestCase;
use Polass\Exposer\Exposer;
use ReflectionException;

class EnumTest extends TestCase
{
    /**
     * テストの準備
     *
     */
    public function setUp()
    {
        parent::setUp();

        $this->class = Stubs\Secrecy::class;
        $this->instance = new $this->class;
    }

    /**
     * `__construct()` の正常系のテスト
     *
     */
    public function testConstruct()
    {
        $this->assertInstanceOf(Exposer::class, new Exposer($this->class));
        $this->assertInstanceOf(Exposer::class, new Exposer($this->instance));
        $this->assertInstanceOf(Exposer::class, expose($this->class));
        $this->assertInstanceOf(Exposer::class, expose($this->instance));
    }

    /**
     * `__get()` のテスト
     *
     */
    public function testGet()
    {
        $class = new Exposer($this->class);

        $this->assertEquals($class->publicProperty, 'public');
        $this->assertEquals($class->protectedProperty, 'protected');
        $this->assertEquals($class->privateProperty, 'private');

        $instance = new Exposer($this->instance);

        $this->assertEquals($instance->publicProperty, 'public');
        $this->assertEquals($instance->protectedProperty, 'protected');
        $this->assertEquals($instance->privateProperty, 'private');
    }

    /**
     * `__get()` の異常系のテスト
     *
     */
    public function testGetFailed()
    {
        $this->expectException(
            ReflectionException::class
        );

        (new Exposer($this->instance))->none;
    }

    /**
     * `__set()` の正常系のテスト
     *
     */
    public function testSet()
    {
        $value = 'assigned';


        $class = new Exposer($this->class);

        $class->publicProperty = $value;
        $this->assertNotEquals($class->publicProperty, $value, 'public property not assigned.');

        $class->protectedProperty = $value;
        $this->assertNotEquals($class->protectedProperty, $value, 'protected property not assigned.');

        $class->privateProperty = $value;
        $this->assertNotEquals($class->privateProperty, $value, 'private property not assigned.');


        $instance = new Exposer($this->instance);

        $instance->publicProperty = $value;
        $this->assertEquals($instance->publicProperty, $value, 'public property not assigned.');

        $instance->protectedProperty = $value;
        $this->assertEquals($instance->protectedProperty, $value, 'protected property not assigned.');

        $instance->privateProperty = $value;
        $this->assertEquals($instance->privateProperty, $value, 'private property not assigned.');
    }

    /**
     * `__set()` の異常系のテスト
     *
     */
    public function testSetFailed()
    {
        $this->expectException(
            ReflectionException::class
        );

        $instance = new Exposer($this->instance);
        $instance->none = 'assigned';
    }

    /**
     * `__call()` の正常系のテスト
     *
     */
    public function testCall()
    {
        $first = 'first'; $second = 'second';


        $class = new Exposer($this->class);

        $this->assertEquals(
            $class->publicFunction($first, $second),
            "called public function with `$first`, `$second`, `third`"
        );

        $this->assertEquals(
            $class->protectedFunction($first, $second),
            "called protected function with `$first`, `$second`, `third`"
        );

        $this->assertEquals(
            $class->privateFunction($first, $second),
            "called private function with `$first`, `$second`, `third`"
        );

        $this->assertEquals(
            $class->publicStaticFunction($first, $second),
            "called public static function with `$first`, `$second`, `third`"
        );

        $this->assertEquals(
            $class->protectedStaticFunction($first, $second),
            "called protected static function with `$first`, `$second`, `third`"
        );

        $this->assertEquals(
            $class->privateStaticFunction($first, $second),
            "called private static function with `$first`, `$second`, `third`"
        );


        $instance = new Exposer($this->instance);

        $this->assertEquals(
            $instance->publicFunction($first, $second),
            "called public function with `$first`, `$second`, `third`"
        );

        $this->assertEquals(
            $instance->protectedFunction($first, $second),
            "called protected function with `$first`, `$second`, `third`"
        );

        $this->assertEquals(
            $instance->privateFunction($first, $second),
            "called private function with `$first`, `$second`, `third`"
        );

        $this->assertEquals(
            $instance->publicStaticFunction($first, $second),
            "called public static function with `$first`, `$second`, `third`"
        );

        $this->assertEquals(
            $instance->protectedStaticFunction($first, $second),
            "called protected static function with `$first`, `$second`, `third`"
        );

        $this->assertEquals(
            $instance->privateStaticFunction($first, $second),
            "called private static function with `$first`, `$second`, `third`"
        );
    }

    /**
     * `__call()` の異常系のテスト
     *
     */
    public function testCallFailed()
    {
        $this->expectException(
            ReflectionException::class
        );

        (new Exposer($this->instance))->none();
    }
}
