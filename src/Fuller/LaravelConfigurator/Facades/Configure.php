<?php namespace Fuller\LaravelConfigurator\Facades;

use Illuminate\Support\Facades\Facade;


class Configure extends Facade
{

    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor() { return 'configurator'; }

}