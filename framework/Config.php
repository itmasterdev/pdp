<?php

namespace Framework;

class Config
{
    protected static array $config;

    /**
     * @param string $configFile
     * @return void
     */
    public static function load(string $configFile): void
    {
        self::$config = require dirname(__DIR__) . DIRECTORY_SEPARATOR . $configFile;
    }

    /**
     * @param string $config
     * @return string|null
     */
    public static function get(string $config): ?string
    {
        $configKeys = explode('.', $config);

        self::load('configs' . DIRECTORY_SEPARATOR . $configKeys[0] . '.php');
        unset($configKeys[0]);

        $value = self::$config;

        foreach ($configKeys as $key) {
            if (isset($value[$key])) {
                $value = $value[$key];
            } else {
                return null;
            }
        }

        return $value;
    }
}