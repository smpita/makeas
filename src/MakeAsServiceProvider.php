<?php

namespace Smpita\MakeAs;

use Illuminate\Container\Container;
use Smpita\MakeAs\Exceptions\MakeAsResolutionException;
use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

class MakeAsServiceProvider extends PackageServiceProvider
{
    /**
     * Bootstrap MakeAs service.
     */
    public function boot(): void
    {
        $this->app->macro('makeAs', function (string $abstract, array $parameters = [], string $expected = null) {
            /**
             * Guarantee a resolved object is a given class.
             *
             * @template TAbstract of object
             * @template TExpected of object
             *
             * @param  string  $abstract
             * @param  array  $parameters
             * @param  class-string<TExpected>|null  $expected
             * @return ($abstract is class-string<TAbstract> ? ($expected is null ? TAbstract : TExpected) : TExpected)
             *
             * @throws MakeAsResolutionException
             */
            $expected ??= $abstract;

            if (is_a($concrete = Container::getInstance()->make($abstract, $parameters), $expected)) {
                return $concrete;
            }

            throw new MakeAsResolutionException("Target [$expected] is not instantiable.");
        });
    }

    public function configurePackage(Package $package): void
    {
        /*
         * This class is a Package Service Provider
         *
         * More info: https://github.com/spatie/laravel-package-tools
         */
        $package->name('makeas');
    }
}
