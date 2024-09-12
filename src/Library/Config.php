<?php

declare(strict_types=1);

namespace App\Library;

use Exception;

class Config
{
    private static ?array $config = null;

    /**
     * Retrieves the configuration array.
     *
     * @return array The configuration array.
     * @throws Exception If the config file is not found.
     */
    public static function get(): array
    {
        if (self::$config === null) {
            $configFile = dirname(__DIR__, 2) . '/config.php';
            if (!file_exists($configFile)) {
                throw new Exception("Config file not found: $configFile");
            }
            self::$config = include $configFile;
        }
        return self::$config;
    }

    /**
     * Retrieves a specific configuration value.
     *
     * @param string $key The configuration key to retrieve.
     * @param mixed $default The default value to return if the key is not found.
     * @return mixed The configuration value.
     */
    public static function getValue(string $key, $default = null)
    {
        $config = self::get();
        return $config[$key] ?? $default;
    }
}
