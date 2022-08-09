<?php

/*
 *
 * BlogCI4 - Blog write with Codeigniter v4dev
 * @author Deathart <contact@deathart.fr>
 * @copyright Copyright (c) 2018 Deathart
 * @license https://opensource.org/licenses/MIT MIT License
 */

namespace App\Libraries;

use Twig\Environment;
use Twig\Error\Error;
use Twig\Extension\DebugExtension;
use Twig\Loader\FilesystemLoader;

/**
 * Class General
 *
 * @package App\Libraries
 */
class Twig
{
    /**
     * @var Environment
     */
    private $environment;

    /**
     * @var string
     */
    private $ext = '.twig';

    /**
     * Twig constructor.
     *
     * @param string $templateFolder
     * @throws DatabaseException
     */
    public function __construct(string $templateFolder)
    {

        $loader = new FilesystemLoader(base_path() . '/public/theme' . DIRECTORY_SEPARATOR . $templateFolder);

        if (!is_writable(storage_path() . '/framework/cache') || config("APP_ENV") == "development") {
            $dataConfig['cache'] = storage_path() . '/framework/cache';
            $dataConfig['auto_reload'] = true;
        }

        if (config("APP_ENV") == "development") {
            $dataConfig['debug'] = true;
        }

        $dataConfig['autoescape'] = false;

        $this->environment = new Environment($loader, $dataConfig);
        //$this->environment->addExtension(new CoreExtension());
        if (config("APP_ENV") == "development") {
            $this->environment->addExtension(new DebugExtension());
        }
    }

    /**
     * @param string $file
     * @param array $array
     *
     * @return string
     */
    public function render(string $file, array $array): string
    {
        try {
            $template = $this->environment->load($file . $this->ext);
        } catch (Error $error_Loader) {
            throw new \Exception("Template file not found : " . $file . $this->ext);
        }

        return $template->render($array);
    }
}
