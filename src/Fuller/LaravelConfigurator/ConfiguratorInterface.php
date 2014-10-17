<?php namespace Fuller\LaravelConfigurator;

use Illuminate\Contracts\Config\Repository;

/**
 * Custom configuration interface for use with
 * Laravel's Config repository class
 *
 * Interface ConfiguratorInterface
 * @package Fuller\LaravelConfigurator
 */
interface ConfiguratorInterface
{

    /**
     * Load and apply custom config options
     *
     * @param Repository $appConfigRepo Config repository instance
     */
    public function __construct(Repository $appConfigRepo);


    /**
     * Load/reload config options from storage
     *
     * @return instance
     */
    public function load();

    /**
     * Set custom config option. Does not apply to application config.
     *
     * @param $key
     * @param $value
     * @return instance
     */
    public function set($key, $value);


    /**
     * Apply the loaded options to application config
     *
     * @return instance
     */
    public function apply();

    /**
     * Save loaded options array to storage
     *
     * @return mixed
     */
    public function save();
}