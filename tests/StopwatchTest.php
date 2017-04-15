<?php

/**
 * This file is part of the Stopwatch package.
 *
 * Copyright (c) Miloš Đurić <djuric.milos@gmail.com>
 *
 * For full copyright and license information, please refer to the LICENSE file,
 * located at the package root folder.
 */

namespace Stopwatch\Tests;

use Stopwatch\Stopwatch;

/**
 * Class StopwatchTest
 *
 * @package Stopwatch\Tests
 */
class StopwatchTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @return Stopwatch
     */
    public function testNew()
    {
        $stopwatch = Stopwatch::createNew();

        self::assertFalse($stopwatch->isRunning());
        self::assertSame(0.0, $stopwatch->getElapsed());

        return $stopwatch;
    }

    /**
     * @param Stopwatch $stopwatch
     * @return Stopwatch
     * @depends testNew
     */
    public function testStart(Stopwatch $stopwatch)
    {
        $stopwatch->start();

        self::assertTrue($stopwatch->isRunning());
        self::assertNotSame(0.0, $stopwatch->getElapsed());

        return $stopwatch;
    }

    /**
     * @param Stopwatch $stopwatch
     * @return Stopwatch
     * @depends testStart
     */
    public function testStop(Stopwatch $stopwatch)
    {
        $stopwatch->stop();

        self::assertFalse($stopwatch->isRunning());
        self::assertNotSame(0.0, $stopwatch->getElapsed());

        return $stopwatch;
    }

    /**
     * @param Stopwatch $stopwatch
     * @depends testStop
     */
    public function testResume(Stopwatch $stopwatch)
    {
        $stopwatch->start();

        self::assertTrue($stopwatch->isRunning());
        self::assertNotSame(0.0, $stopwatch->getElapsed());
    }

    /**
     * @param Stopwatch $stopwatch
     * @depends testStart
     */
    public function testReset(Stopwatch $stopwatch)
    {
        $stopwatch->reset();

        self::assertFalse($stopwatch->isRunning());
        self::assertSame(0.0, $stopwatch->getElapsed());
    }

    /**
     * @param Stopwatch $stopwatch
     * @depends testStart
     */
    public function testRestart(Stopwatch $stopwatch)
    {
        $stopwatch->restart();

        self::assertTrue($stopwatch->isRunning());
        self::assertNotSame(0.0, $stopwatch->getElapsed());
    }

    public function testElapsed()
    {
        $stopwatch = Stopwatch::createNew();
        $stopwatch->start();

        sleep(1);
        self::assertGreaterThanOrEqual(1, $stopwatch->getElapsed());

        sleep(1);
        self::assertGreaterThanOrEqual(2, $stopwatch->getElapsed());
        self::assertLessThanOrEqual(3, $stopwatch->getElapsed());
    }

    public function testElapsedSeconds()
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

    public function testElapsedMilliseconds()
    {
        $stopwatch = Stopwatch::createNew();
        $stopwatch->start();

        sleep(1);
        self::assertGreaterThanOrEqual(1000, $stopwatch->getElapsedMilliseconds());

        sleep(1);
        self::assertGreaterThanOrEqual(2000, $stopwatch->getElapsedMilliseconds());
        self::assertLessThanOrEqual(2100, $stopwatch->getElapsedMilliseconds());
    }

    public function testElapsedMicroseconds()
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
