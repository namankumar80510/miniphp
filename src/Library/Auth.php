<?php

declare(strict_types=1);

namespace App\Library;

use Kinde\KindeSDK\Configuration;
use Kinde\KindeSDK\KindeClientSDK;

class Auth
{
    /**
     * Returns an instance of the KindeClientSDK.
     *
     * @return KindeClientSDK The KindeClientSDK instance.
     */
    public static function authClient(): KindeClientSDK
    {
        static $client = null;
        if ($client === null) {
            $client = new KindeClientSDK(
                domain: getenv('KINDE_DOMAIN'),
                redirectUri: getenv('KINDE_REDIRECT_URL'),
                clientId: getenv('KINDE_CLIENT_ID'),
                clientSecret: getenv('KINDE_CLIENT_SECRET'),
                grantType: getenv('KINDE_GRANT_TYPE'),
                logoutRedirectUri: getenv('KINDE_LOGOUT_REDIRECT_URL'),
            );
        }
        return $client;
    }

    /**
     * Returns an instance of the Kinde Configuration.
     *
     * @return Configuration The Kinde Configuration instance.
     */
    public static function authConfig(): Configuration
    {
        static $config = null;
        if ($config === null) {
            $config = new Configuration();
            $config->setHost(getenv('KINDE_DOMAIN'));
        }
        return $config;
    }

    /**
     * Retrieves user information.
     *
     * @param string|null $key The specific user information key to retrieve (optional).
     * @return array|null The user information, or null if not logged in.
     */
    public static function user(?string $key = null): ?array
    {
        if (!self::isLoggedIn()) {
            return null;
        }

        if (empty($_SESSION['user'])) {
            $_SESSION['user'] = self::authClient()->getUserDetails();
        }

        if ($key !== null) {
            return $_SESSION['user'][$key] ?? null;
        }

        return $_SESSION['user'];
    }

    /**
     * Checks if the user is logged in.
     *
     * @return bool True if the user is logged in, false otherwise.
     */
    public static function isLoggedIn(): bool
    {
        return isset($_SESSION['authenticated']) && $_SESSION['authenticated'] === true;
    }

    /**
     * Checks if the user has a specific permission.
     *
     * @param string $permission The permission to check.
     * @return bool True if the user has the permission, false otherwise.
     */
    public static function hasPermission(string $permission): bool
    {
        if (!self::isLoggedIn()) {
            return false;
        }

        if (!isset($_SESSION['permissions'])) {
            $_SESSION['permissions'] = self::authClient()->getPermissions()['permissions'];
        }

        return in_array($permission, $_SESSION['permissions']);
    }
}
