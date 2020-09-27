<?php
App::uses('AppTestCase', 'Test');

/**
 * Class BaseTestCase
 *
 * @property  DataSource dataSource
 */
abstract class BaseTestCase extends AppTestCase
{
    /**
     * getPublicMethods
     *
     * @param    string $className
     *
     * @throws ReflectionException
     *
     * @return    array
     */
    public function getPublicMethods($className)
    {
        $reflector = new ReflectionClass($className);
        $methods = $reflector->getMethods(ReflectionMethod::IS_PUBLIC);

        return array_filter($methods, function ($key) use ($className) {
            return $key->class === $className;
        });
    }

    /**
     * getPrivateProperty
     *
     * @author    Joe Sexton <joe@webtipblog.com>
     *
     * @param    string $className
     * @param    string $propertyName
     *
     * @throws ReflectionException
     *
     * @return    ReflectionProperty
     */
    public function getPrivateProperty($className, $propertyName)
    {
        $reflector = new ReflectionClass($className);
        $property = $reflector->getProperty($propertyName);
        $property->setAccessible(true);

        return $property;
    }

        /**
     * getPrivateMethod
     *
     * @author    Joe Sexton <joe@webtipblog.com>
     *
     * @param    string $className
     * @param    string $methodName
     *
     * @throws ReflectionException
     *
     * @return    ReflectionMethod
     */
    public function getPrivateMethod($className, $methodName)
    {
        $reflector = new ReflectionClass($className);
        $method = $reflector->getMethod($methodName);
        $method->setAccessible(true);

        return $method;
    }

    /**
     * getConstants
     *
     * @param string $className
     *
     * @throws ReflectionException
     *
     * @return array
     */
    public function getConstants($className)
    {
        $oClass = new ReflectionClass($className);

        return $oClass->getConstants();
    }
}