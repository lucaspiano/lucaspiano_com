<?php

class StaticDataHelper
{
    /**
     * @var array
     */
    private $content = [];

    public function __construct(array $config)
    {
        foreach ($config as $name => $path) {
            $fileContent = file_get_contents($path);
            $content = json_decode($fileContent, true);

            if (json_last_error() !== JSON_ERROR_NONE) {
                throw new Exception("JSON '{$path}' inválido: " . json_last_error_msg());
            }

            $this->content[$name] = $content;
        }
    }

    /**
     * @param string $name
     * @return array
     * @throws Exception
     */
    public function get($name)
    {
        if (!array_key_exists($name, $this->content)) {
            throw new Exception("Conteúdo estático '{$name}' é inválido.");
        }

        return $this->content[$name];
    }
}