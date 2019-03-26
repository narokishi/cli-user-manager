<?php
declare(strict_types = 1);

namespace Src;

/**
 * Class Env
 * @package Src
 */
final class Env
{
    /**
     * @var array
     */
    protected $variables = [];

    /**
     * @const string
     */
    protected const ENV_FILE_NAME = '.environment.json';

    /**
     * Env constructor.
     */
    public function __construct()
    {

        $filepath = dirname(__DIR__) . DIRECTORY_SEPARATOR . self::ENV_FILE_NAME;

        if (!file_exists($filepath)) {
            throw new \RuntimeException(
                'Plik zmiennych środowiskowych nie istnieje'
            );
        }

        $fileContents = file_get_contents($filepath);

        if (!$fileContents) {
            throw new \RuntimeException(
                'Nie udało się wczytać zmiennych środowiskowych'
            );
        }

        $this->variables = json_decode($fileContents, true);
    }

    /**
     * @param string $key
     * @param null $default
     * @return mixed
     */
    public function get($key, $default = null)
    {
        return array_key_exists($key, $this->variables)
            ? $this->variables[$key] : $default;
    }
}
