<?php
/**
  * App Class
  * This loads up the application
  *
  * @package    CapitalsObi
  * @subpackage benevsAPI
  * @author     Obi Merenu <obinna@CapitalsObiedge.com>
  */
namespace CapitalsObi\benevsAPI;

define("A_VERSION", "v1");

class App
{
    /**
     * Stores an instance of the Slim application.
     *
     * @var \Slim\App
     */
    private $app;

    public function __construct() {
        $config = require __DIR__.'/config/settings.php';
        $app = new \Slim\App($config);
        require __DIR__.'/config/dependencies.php';
        require __DIR__.'/routes/routes.php';

        $this->app = $app;
    }

    /**
     * Get an instance of the application.
     *
     * @return \Slim\App
     */
    public function get()
    {
        return $this->app;
    }

}
