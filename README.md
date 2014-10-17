# User Customisable and Persistent App Config Options

This Laravel package provides a convenient way to save custom configuration options within your Laravel application. Once saved all custom options then override those in the main app config and can be accessed using the standard `Illuminate\Contracts\Config\Repository` instance or `\Config` Facade as shown below:

	\Config::get($key);

This is especially useful for many applications that feature a low level admin panel to configure an app via a web form.

## Requirements

This package uses `Illuminate\Contracts\Config\Repository` which I believe is only available in the Laravel 5.

## Installation

Begin by installing this package through Composer. Edit your project's `composer.json` file to require `fuller/laravel-configuration`.

	"require": {
		"fuller/laravel-configurator": "~0.1"
	}

Next, update Composer from the Terminal:

    composer update

Once this operation completes, the final step is to add the service provider. Open `config/app.php`, and add a new item to the top of the providers array.

    'fuller/laravel-configurator'

## Usage

All usage can be done by using the '\Configure' facade. Please remember that this package is only intended for saving custom config options. You will use the standard `\Config::get($key)` upon the next request to use the custom options.

###Setting

	\Configure::set($key, $value);

You can also use an associative array like the example below:

	\Configure::set([
		'site.title' => 'Cool Website',
		'site.slogan' => 'Cool things for everyone',
		'mail.driver' => 'smtp',
	]);

### Saving

Once you have set all custom options you will the need to save them:

	\Configure::save();

### Applying (Automatic on next request)

You may whish to apply the custom options just set, to the main app config in memory before the next request. For this you can use:

	\Configure::apply();


## Configuration

All custom config options are written to a .php file. By default this is kept in the app storage folder. However you are free to change this in the package configuration file.

## F.A.Q

Q. Why save to a file and not to a database?

A. Saving to a file means that the package can also be used to save custom database options. This very useful if your application has an installation form.

Q. Can I call the class directly for testing purposes?

A. Yes but you must pass the `Illuminate\Contracts\Config\Repository` instance into the constructor. This is just my first draft and soon I'll release a version where you don't need to do this.
