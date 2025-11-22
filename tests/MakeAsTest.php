<?php

namespace Smpita\MakeAs\Tests;

use Smpita\MakeAs\Exceptions\MakeAsResolutionException;

class MakeAsTest extends TestCase
{
    /**
     * @test
     *
     * @group smpita
     * @group makeas
     */
    public function container_can_make_as_from_abstract(): void
    {
        app()->bind(ContainerConcreteStub::class, function () {
            return new ContainerConcreteStub;
        });

        $this->assertInstanceOf(ContainerConcreteStub::class, app()->makeAs(ContainerConcreteStub::class));
    }

    /**
     * @test
     *
     * @group smpita
     * @group makeas
     */
    public function can_make_as_from_magic_string(): void
    {
        app()->bind('makeAs', function () {
            return new ContainerConcreteStub;
        });

        $this->assertInstanceOf(ContainerConcreteStub::class, app()->makeAs('makeAs', [], ContainerConcreteStub::class));
    }

    /**
     * @test
     *
     * @group smpita
     * @group makeas
     */
    public function make_as_throws_exception_when_misused(): void
    {
        app()->bind(ContainerConcreteStub::class, function () {
            return 'makeAs';
        });

        $this->expectException(MakeAsResolutionException::class);
        app()->makeAs(ContainerConcreteStub::class);
    }

    /**
     * @test
     *
     * @group smpita
     * @group makeas
     */
    public function make_as_throws_exception_when_expectation_is_not_met(): void
    {
        app()->bind(ContainerConcreteStub::class, function () {
            return new ContainerConcreteStub;
        });

        $this->expectException(MakeAsResolutionException::class);
        app()->makeAs(ContainerConcreteStub::class, [], ContainerConcreteStubAlternate::class);
    }

    /**
     * @test
     *
     * @group smpita
     * @group makeas
     */
    public function static_analysis_understands(): void
    {
        app()->bind(ContainerConcreteStub::class, function () {
            return new ContainerConcreteStub;
        });

        $this->assertTrue(app()->makeAs(ContainerConcreteStub::class)->testMethod());
    }
}

class ContainerConcreteStub
{
    public function testMethod(): bool
    {
        return true;
    }
}

class ContainerConcreteStubAlternate {}
