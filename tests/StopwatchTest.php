<?php

/**
 * This file is part of the Stopwatch package.
 *
 * Copyright (c) Miloš Đurić <djuric.milos@gmail.com>
 *
 * For full copyright and license information, please refer to the LICENSE file,
 * located at the package root folder.
 */

namespace Laganica\Stopwatch\Tests;

use Laganica\Stopwatch\Stopwatch;
use PHPUnit\Framework\TestCase;

/**
 * Class StopwatchTest
 *
 * @package Stopwatch\Tests
 */
class StopwatchTest extends TestCase
{
    /**
     * @return Stopwatch
     */
    public function testNew(): Stopwatch
    {
        $stopwatch = Stopwatch::createNew();

        self::assertFalse($stopwatch->isRunning());
        self::assertSame(0.0, $stopwatch->getElapsed());

        return $stopwatch;
    }

    /**
     * @param Stopwatch $stopwatch
     *
     * @depends testNew
     *
     * @return Stopwatch
     */
    public function testStart(Stopwatch $stopwatch): Stopwatch
    {
        $stopwatch->start();

        self::assertTrue($stopwatch->isRunning());
        self::assertNotSame(0.0, $stopwatch->getElapsed());

        return $stopwatch;
    }

    /**
     * @param Stopwatch $stopwatch
     *
     * @depends testStart
     *
     * @return Stopwatch
     */
    public function testStop(Stopwatch $stopwatch): Stopwatch
    {
        $stopwatch->stop();

        self::assertFalse($stopwatch->isRunning());
        self::assertNotSame(0.0, $stopwatch->getElapsed());

        return $stopwatch;
    }

    /**
     * @param Stopwatch $stopwatch
     *
     * @depends testStop
     *
     * @return void
     */
    public function testResume(Stopwatch $stopwatch): void
    {
        $stopwatch->start();

        self::assertTrue($stopwatch->isRunning());
        self::assertNotSame(0.0, $stopwatch->getElapsed());
    }

    /**
     * @param Stopwatch $stopwatch
     *
     * @depends testStart
     *
     * @return void
     */
    public function testReset(Stopwatch $stopwatch): void
    {
        $stopwatch->reset();

        self::assertFalse($stopwatch->isRunning());
        self::assertSame(0.0, $stopwatch->getElapsed());
    }

    /**
     * @param Stopwatch $stopwatch
     *
     * @depends testStart
     *
     * @return void
     */
    public function testRestart(Stopwatch $stopwatch): void
    {
        $stopwatch->restart();

        self::assertTrue($stopwatch->isRunning());
        self::assertNotSame(0.0, $stopwatch->getElapsed());
    }

    /**
     * @return void
     */
    public function testElapsed(): void
    {
        $stopwatch = Stopwatch::createNew();
        $stopwatch->start();

        sleep(1);
        self::assertGreaterThanOrEqual(1, $stopwatch->getElapsed());

        sleep(1);
        self::assertGreaterThanOrEqual(2, $stopwatch->getElapsed());
        self::assertLessThanOrEqual(3, $stopwatch->getElapsed());
    }

    /**
     * @return void
     */
    public function testElapsedSeconds(): void
    {
        $stopwatch = Stopwatch::createNew();
        $stopwatch->start();

        sleep(1);
        self::assertGreaterThanOrEqual(1, $stopwatch->getElapsedSeconds());

        $stopwatch->stop();
        sleep(2);
        $stopwatch->start();

        sleep(1);
        self::assertGreaterThanOrEqual(2, $stopwatch->getElapsedSeconds());
        self::assertLessThanOrEqual(3, $stopwatch->getElapsedSeconds());
    }

    /**
     * @return void
     */
    public function testElapsedMilliseconds(): void
    {
        $stopwatch = Stopwatch::createNew();
        $stopwatch->start();

        sleep(1);
        self::assertGreaterThanOrEqual(1000, $stopwatch->getElapsedMilliseconds());

        sleep(1);
        self::assertGreaterThanOrEqual(2000, $stopwatch->getElapsedMilliseconds());
        self::assertLessThanOrEqual(2100, $stopwatch->getElapsedMilliseconds());
    }

    /**
     * @return void
     */
    public function testElapsedMicroseconds(): void
    {
        $stopwatch = Stopwatch::createNew();
        $stopwatch->start();

        sleep(1);
        self::assertGreaterThanOrEqual(1000000, $stopwatch->getElapsedMicroseconds());

        sleep(1);
        self::assertGreaterThanOrEqual(2000000, $stopwatch->getElapsedMicroseconds());
        self::assertLessThanOrEqual(21000000, $stopwatch->getElapsedMicroseconds());
    }
}
