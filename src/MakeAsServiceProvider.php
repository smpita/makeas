<?php

namespace Smpita\MakeAs;

use Illuminate\Container\Container;
use Illuminate\Support\ServiceProvider;
use Smpita\MakeAs\Exceptions\MakeAsResolutionException;

class MakeAsServiceProvider extends ServiceProvider
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
}
