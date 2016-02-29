<?php

namespace Shuc324\Support\Facades;

use RuntimeException;

/**
 * 门面类
 */
abstract class Facade
{
    const PARAM_LEN_ZE = 0;
    const PARAM_LEN_ON = 1;
    const PARAM_LEN_TW = 2;
    const PARAM_LEN_TH = 3;
    const PARAM_LEN_FO = 4;

    protected static $container;

    protected static $resolveInstance;

    /**
     * 解析门面
     * @param $facade
     * @return mixed
     */
    protected static function resolveFacadeInstance($facade)
    {
        if (is_object($facade)) {
            return $facade;
        }

        if (isset(static::$resolveInstance[$facade])) {
            return static::$resolveInstance[$facade];
        }

        return static::$resolveInstance[$facade] = static::$container[$facade];
    }

    /**
     * 设置容器
     * @param $container
     * @return mixed
     */
    public static function setContainer($container)
    {
        return static::$container = $container;
    }

    /**
     * 设置门面
     */
    protected static function setFacade()
    {
        throw new RuntimeException("Facade does not implement setFacade method.");
    }

    /**
     * 获取门面实例
     */
    public static function getFacadeInstance()
    {
        return static::resolveFacadeInstance(static::setFacade());
    }

    /**
     * 执行具体方法
     * @param $method
     * @param $parameters
     * @return mixed
     */
    public static function __callStatic($method, $parameters)
    {
        $instance = static::getFacadeInstance();
        if (empty($instance)) {
            throw new RuntimeException("A facade has not been set.");
        }
        switch (count($parameters)) {
            case self::PARAM_LEN_ZE:
                return $instance->$method();
            case self::PARAM_LEN_ON:
                return $instance->$method($parameters[self::PARAM_LEN_ZE]);
            case self::PARAM_LEN_TW:
                return $instance->$method($parameters[self::PARAM_LEN_ZE], $parameters[self::PARAM_LEN_ON]);
            case self::PARAM_LEN_TH:
                return $instance->$method($parameters[self::PARAM_LEN_ZE], $parameters[self::PARAM_LEN_ON], $parameters[self::PARAM_LEN_TW]);
            case self::PARAM_LEN_FO:
                return $instance->$method($parameters[self::PARAM_LEN_ZE], $parameters[self::PARAM_LEN_ON], $parameters[self::PARAM_LEN_TW], $parameters[self::PARAM_LEN_TH]);
            default:
                return call_user_func_array([$instance, $method], $parameters);
        }
    }
}
