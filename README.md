# ObHighchartsBundle

`ObWeatherBundle` is an attempt to have basic weather informations like current temperature and weather forecast for
one of the projects I'm working on.

[![Build Status](https://secure.travis-ci.org/marcaube/ObWeatherBundle.png?branch=master)](http://travis-ci.org/marcaube/ObWeatherBundle)

## How to get started

### Installation

Add the following lines to your `deps` file:

    [ObWeatherBundle]
        git=git://github.com/marcaube/ObWeatherBundle.git
        target=/bundles/Ob/WeatherBundle

Now, run the vendors script to download the bundle:

``` bash
    $ php bin/vendors install
```

Then configure the Autoloader

``` php
    <?php
    ...
    'Ob' => __DIR__.'/../vendor/bundles',
```

And finally register the bundle in your `app/AppKernel.php`:

``` php
    <?php
    ...
    public function registerBundles()
    {
        $bundles = array(
            ...
            new Ob\WeatherBundle\ObWeatherBundle(),
            ...
        );
    ...
```
