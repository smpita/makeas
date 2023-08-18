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
    public function containerCanMakeAsFromAbstract(): void
    {
        app()->bind(ContainerConcreteStub::class, function () {
            return new ContainerConcreteStub();
        });

        $this->assertInstanceOf(ContainerConcreteStub::class, app()->makeAs(ContainerConcreteStub::class));
    }

    /**
     * @test
     *
     * @group smpita
     * @group makeas
     */
    public function canMakeAsFromMagicString(): void
    {
        app()->bind('makeAs', function () {
            return new ContainerConcreteStub();
        });

        $this->assertInstanceOf(ContainerConcreteStub::class, app()->makeAs('makeAs', [], ContainerConcreteStub::class));
    }

    /**
     * @test
     *
     * @group smpita
     * @group makeas
     */
    public function makeAsThrowsExceptionWhenMisused(): void
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
    public function makeAsThrowsExceptionWhenExpectationIsNotMet(): void
    {
        app()->bind(ContainerConcreteStub::class, function () {
            return new ContainerConcreteStub();
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
    public function staticAnalysisUnderstands(): void
    {
        app()->bind(ContainerConcreteStub::class, function () {
            return new ContainerConcreteStub();
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

class ContainerConcreteStubAlternate
{
}
