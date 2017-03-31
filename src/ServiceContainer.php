<?php
/**
 * Created by PhpStorm.
 * User: harry
 * Date: 3/31/17
 * Time: 9:25 AM
 */

namespace PluginHttpClientPassportLaravel;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\Loader\YamlFileLoader;

class ServiceContainer
{
    /**
     * @var self
     */
    private static $instance;

    /**
     * @var ContainerBuilder
     */
    private $container;

    public static function getInstance()
    {
        if (is_null(self::$instance)) {
            self::$instance = new self();
        }

        return self::$instance;
    }

    private function __construct()
    {
        $this->container = new ContainerBuilder();

        $loader = new YamlFileLoader($this->container, new FileLocator(__DIR__ . '../'));
        $loader->load('services.yml');
    }

    public function getContainer()
    {
        return $this->container;
    }
}