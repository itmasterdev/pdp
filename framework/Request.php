<?php

namespace Framework;

class Request
{
    public const METHOD_GET = 'GET';
    public const METHOD_POST = 'POST';

    public function getPath(): string
    {
        $path = $_SERVER['REQUEST_URI'] ?? false;
        $position = strpos($path, '?');
        if ($position === false) {
            return $path;
        }

        return substr($path, 0, $position);
    }

    public function getMethod(): string
    {
        return $_SERVER['REQUEST_METHOD'];
    }

    public function getBody(): array
    {
        $body = [];

        if ($this->getMethod() === self::METHOD_GET) {
            foreach ($_GET as $key => $value) {
                $body[$key] = filter_input(INPUT_GET, $key, FILTER_SANITIZE_SPECIAL_CHARS);

            }
        }

        if ($this->getMethod() === self::METHOD_POST) {
            foreach ($_GET as $key => $value) {
                $body[$key] = filter_input(INPUT_POST, $key, FILTER_SANITIZE_SPECIAL_CHARS);
            }
        }

        return $body;
    }
}