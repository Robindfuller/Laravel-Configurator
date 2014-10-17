<?php namespace Fuller\LaravelConfigurator;

use Illuminate\Contracts\Config\Repository;

/**
 * Custom configuration library interface for use with
 * Laravel's Config repository class
 *
 * Interface ConfiguratorInterface
 * @package Fuller\LaravelConfigurator
 */
interface ConfiguratorInterface
{

    /**
     * Load and apply custom config
     *
     * @param Repository $appConfigRepo Config repository instance
     */
    public function __construct(Repository $appConfigRepo);


    /**
     * Load/reload config from storage
     *
     * @return instance
     */
    public function load();

    /**
     * Set custom value of config
     *
     * @param $key
     * @param $value
     * @return instance
     */
    public function set($key, $value);


    /**
     * Apply the loaded settings to application config
     *
     * @return instance
     */
    public function apply();

    /**
     * Save loaded config array to storage
     *
     * @return mixed
     */
    public function save();
}