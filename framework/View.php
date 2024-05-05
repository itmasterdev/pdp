<?php

namespace Framework;

class View
{
    private static string $viewPath;
    private static array $viewData;

    /**
     * @param string $view
     * @param array $data
     * @return string
     */
    public static function render(string $view, array $data = []): string
    {
        self::$viewData = $data;
        self::$viewPath = Config::get('common.view_default_path') .
            DIRECTORY_SEPARATOR .
            str_replace('.', '/', $view) . '.php'
        ;

        return self::getContent();
    }

    /**
     * @return string
     */
    public static function getContent(): string
    {
        extract(self::$viewData);
        ob_start();

        include self::$viewPath;

        $html = ob_get_contents();

        ob_end_clean();

        return $html;
    }
}
