<?php

declare(strict_types=1);

namespace App\Library;

use App\Library\Config;

class View
{
    /**
     * Renders a view with optional data and layout.
     *
     * @param string $view The name of the view file.
     * @param array $data An associative array of data to be passed to the view (default: []).
     * @param bool $layout Whether to use the layout file (default: true).
     * @param int $statusCode The HTTP status code (default: 200).
     * @throws \Exception If the view file is not found.
     * @return void
     */
    public static function render(string $view, array $data = [], bool $layout = true, int $statusCode = 200): void
    {
        $config = Config::get();
        $data = array_merge($config, $data);
        $viewsPath = dirname(__DIR__, 2) . '/views/';
        $layoutPath = $viewsPath . '_layout.php';
        $viewPath = $viewsPath . ltrim($view, '/') . '.php';

        if (!file_exists($viewPath)) {
            throw new \Exception("View file not found: $viewPath");
        }

        ob_start();
        extract($data);
        include $viewPath;
        $content = ob_get_clean();

        if ($layout) {
            ob_start();
            include $layoutPath;
            $html = ob_get_clean();
        } else {
            $html = $content;
        }

        self::htmlResponse($html, $statusCode);
    }

    /**
     * Sends an HTML response with the specified status code.
     *
     * @param string $html The HTML content to be sent.
     * @param int $statusCode The HTTP status code.
     * @return void
     */
    public static function htmlResponse(string $html, int $statusCode): void
    {
        http_response_code($statusCode);
        header('Content-Type: text/html');
        echo $html;
        exit;
    }

    /**
     * Includes a template file.
     *
     * @param string $template The name of the template file.
     * @return void
     */
    public static function includeTemplate(string $template): void
    {
        include dirname(__DIR__, 2) . "/views/_include/$template.php";
    }
}
