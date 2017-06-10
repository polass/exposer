<?php

namespace Polass\Exposer;

use ReflectionClass;

class Exposer
{
    /**
     * ターゲット
     *
     * @var mixed
     */
    protected $__class;

    /**
     * コンストラクタ
     *
     * @param mixed $class
     */
    public function __construct($class)
    {
        $this->__class = $class;
    }

    /**
     * プロパティの値を取得
     *
     * @param string $key
     * @return mixed
     */
    public function __get($key)
    {
        return $this->getHiddenProperty($key);
    }

    /**
     * プロパティの値を設定
     *
     * @param string $key
     * @param mixed $value
     * @return void
     */
    public function __set($key, $value)
    {
        $this->setHiddenProperty($key, $value);
    }

    /**
     * メソッド呼び出し
     *
     * @param string $method
     * @param array $parameters
     * @return mixed
     */
    public function __call($method, array $parameters)
    {
        return $this->callHiddenMethod($method, $parameters);
    }

    /**
     * `private` や `protected` に設定されたメソッドを呼び出す
     *
     * @param string $method
     * @param array $parameters
     * @return mixed
     *
     * @throws \ReflectionException
     */
    protected function callHiddenMethod($method, array $parameters)
    {
        $reflectionClass = new ReflectionClass($this->__class);
        $reflectionMethod = $reflectionClass->getMethod($method);
        $reflectionMethod->setAccessible(true);

        if ($reflectionMethod->isStatic()) {
            return $reflectionMethod->invokeArgs(null, $parameters);
        }

        if (is_string($instance = $this->__class)) {
            $instance = new $this->__class;
        }

        return $reflectionMethod->invokeArgs($instance, $parameters);
    }

    /**
     * `private` や `protected` に設定されたプロパティの値を取得
     *
     * @param string $property
     * @return mixed
     *
     * @throws \ReflectionException
     */
    protected function getHiddenProperty($property)
    {
        if (is_string($instance = $this->__class)) {
            $instance = new $this->__class;
        }

        $reflectionClass = new ReflectionClass($this->__class);
        $reflectionProperty = $reflectionClass->getProperty($property);
        $reflectionProperty->setAccessible(true);

        return $reflectionProperty->getValue($instance);
    }

    /**
     * `private` や `protected` に設定されたプロパティに値を設定
     *
     * @param string $property
     * @param mixed $value
     * @return void
     *
     * @throws \ReflectionException
     */
    protected function setHiddenProperty($property, $value)
    {
        if (is_string($instance = $this->__class)) {
            $instance = new $this->__class;
        }

        $reflectionClass = new ReflectionClass($this->__class);
        $reflectionProperty = $reflectionClass->getProperty($property);
        $reflectionProperty->setAccessible(true);

        $reflectionProperty->setValue($instance, $value);
    }
}
