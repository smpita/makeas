<?php

namespace Smpita\MakeAs;

use Illuminate\Container\Container;
use Illuminate\Support\ServiceProvider;
use Smpita\MakeAs\Exceptions\MakeAsResolutionException;
use Smpita\MakeAs\Exceptions\InvalidApplicationException;
use Illuminate\Contracts\Container\BindingResolutionException;

class MakeAsServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap MakeAs service.
     */
    public function boot(): void
    {
        $app = app();

        if(! is_object($app) || ! method_exists($app, 'macro')) {
            throw new InvalidApplicationException('Laravel is required to use smpita/makeas');
        }

        $app->macro('makeAs', function (string $abstract, array $parameters = [], ?string $expected = null) {
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
             * @throws BindingResolutionException
             * @throws MakeAsResolutionException
             */
            $expected ??= $abstract;

            $instance = Container::getInstance()->make($abstract, $parameters);

            if (is_object($instance) && is_a($instance, $expected)) {
                return $instance;
            }

            throw new MakeAsResolutionException("Target [$expected] is not instantiable.");
        });
    }
}
