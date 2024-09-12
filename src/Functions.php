<?php

declare(strict_types=1);

use App\Library\Auth;
use App\Library\Database;
use App\Library\View;
use App\Library\Config;

/**
 * Escapes a string for safe output in HTML.
 *
 * @param string $string The string to be escaped.
 * @return string The escaped string.
 */
function esc(string $string): string
{
    return htmlspecialchars($string, ENT_QUOTES, 'UTF-8');
}

/**
 * Sends an HTML response with the specified status code.
 *
 * @param string $html The HTML content to be sent.
 * @param int $statusCode The HTTP status code (default: 200).
 * @return void
 */
function htmlResponse(string $html, int $statusCode = 200): void
{
    View::htmlResponse($html, $statusCode);
}

/**
 * Renders a view with optional data and layout.
 *
 * @param string $view The name of the view file.
 * @param array $data An associative array of data to be passed to the view (default: []).
 * @param bool $layout Whether to use the layout file (default: true).
 * @param int $statusCode The HTTP status code (default: 200).
 * @throws Exception If the view file is not found.
 * @return void
 */
function render(string $view, array $data = [], bool $layout = true, int $statusCode = 200): void
{
    View::render($view, $data, $layout, $statusCode);
}

/**
 * Includes a template file.
 *
 * @param string $template The name of the template file.
 * @return void
 */
function includeTemplate(string $template): void
{
    View::includeTemplate($template);
}

/**
 * Retrieves content from the database.
 *
 * @param string $path The path to the content file.
 * @return array|null The content as an array, or null if not found.
 */
function getContentFromDatabase(string $path): ?array
{
    global $markdownParser;
    $fullPath = dirname(__DIR__) . '/database/' . ltrim($path, '/') . '.md';
    if (!file_exists($fullPath)) {
        return null;
    }
    return $markdownParser->getFileContent($path);
}

/**
 * Redirects to the specified URL.
 *
 * @param string $url The URL to redirect to.
 * @param int $statusCode The HTTP status code for the redirect (default: 302).
 * @return void
 */
function redirect(string $url, int $statusCode = 302): void
{
    header("Location: $url", true, $statusCode);
    exit;
}

/**
 * Retrieves user information.
 *
 * @param string|null $key The specific user information key to retrieve (optional).
 * @return array|null The user information, or null if not logged in.
 */
function user(?string $key = null): ?array
{
    return Auth::user($key);
}

/**
 * Checks if the user is logged in.
 *
 * @return bool True if the user is logged in, false otherwise.
 */
function isLoggedIn(): bool
{
    return Auth::isLoggedIn();
}

/**
 * Checks if the user has a specific permission.
 *
 * @param string $permission The permission to check.
 * @return bool True if the user has the permission, false otherwise.
 */
function hasPermission(string $permission): bool
{
    return Auth::hasPermission($permission);
}

/**
 * Checks if the user is a member.
 *
 * @return bool True if the user is a member, false otherwise.
 */
function isMember(): bool
{
    return Auth::hasPermission('membership_access');
}

/**
 * Dumps the given data and terminates the script.
 *
 * @param mixed $data The data to be dumped.
 * @return void
 */
function dd($data): void
{
    echo "<pre>";
    var_dump($data);
    echo "</pre>";
    die;
}

/**
 * Retrieves the configuration array.
 *
 * @return array The configuration array.
 * @throws Exception If the config file is not found.
 */
function config(): array
{
    return Config::get();
}

/**
 * Fetches cached articles.
 *
 * @param string|null $slug The slug of a specific article (optional).
 * @return array An array of cached articles.
 */
function fetchCachedArticles(?string $slug = null): array
{
    global $cacheDir;

    if ($slug !== null) {
        $filePath = $cacheDir . '/articles/' . $slug . '.json';
        if (file_exists($filePath)) {
            $content = file_get_contents($filePath);
            return $content !== false ? [json_decode($content, true)] : [];
        }
        return [];
    }

    $cachedFiles = glob($cacheDir . '/articles/*.json');
    return array_reduce($cachedFiles, function ($articles, $file) {
        $content = file_get_contents($file);
        $article = $content !== false ? json_decode($content, true) : null;
        if ($article !== null) {
            $articles[] = $article;
        }
        return $articles;
    }, []);
}

/**
 * Caches an article.
 *
 * @param string $slug The slug of the article.
 * @param array $articleData The article data to be cached.
 * @return bool True if the article was successfully cached, false otherwise.
 */
function cacheArticle(string $slug, array $articleData): bool
{
    global $cacheDir;
    $directoryPath = $cacheDir . '/articles';

    if (!is_dir($directoryPath)) {
        mkdir($directoryPath, 0755, true);
    }

    $filePath = $directoryPath . '/' . $slug . '.json';
    $jsonData = json_encode($articleData, JSON_PRETTY_PRINT);

    if ($jsonData === false) {
        return false;
    }

    return file_put_contents($filePath, $jsonData) !== false;
}

/**
 * Throws a 404 Not Found error.
 *
 * @return void
 */
function throw404(): void
{
    View::htmlResponse(file_get_contents(dirname(__DIR__) . '/views/errors/404.html'), 404);
}

/**
 * Returns a PDO instance for database operations.
 *
 * @return PDO The PDO instance.
 * @throws Exception If the database connection fails.
 */
function db(): PDO
{
    return Database::db();
}
