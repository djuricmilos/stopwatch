<?php

/**
 * This file is part of the Stopwatch package.
 *
 * Copyright (c) Miloš Đurić <djuric.milos@gmail.com>
 *
 * For full copyright and license information, please refer to the LICENSE file,
 * located at the package root folder.
 */

namespace Stopwatch;

/**
 * Class Stopwatch
 *
 * @package Stopwatch
 */
final class Stopwatch
{
    /**
     * @var float
     */
    private $time;

    /**
     * @var float
     */
    private $elapsed;

    /**
     * @var bool
     */
    private $isRunning;

    private function __construct()
    {
        $this->init();
    }

    /**
     * @return Stopwatch
     */
    public static function createNew() : self
    {
        return new self();
    }

    /**
     * Starts or resumes measurement.
     */
    public function start()
    {
        if ($this->time !== 0.0) {
            $this->time = microtime(true) - $this->elapsed + $this->time;
        } else {
            $this->time = microtime(true);
        }

        $this->isRunning = true;
    }

    /**
     * Stops measurement.
     */
    public function stop()
    {
        $this->storeElapsed();
        $this->isRunning = false;
    }

    /**
     * Stops measurement and starts from the beginning.
     */
    public function restart()
    {
        $this->init();
        $this->start();
    }

    /**
     * Stops measurement and resets elapsed time.
     */
    public function reset()
    {
        $this->init();
    }

    /**
     * @return float
     */
    public function getElapsed() : float
    {
        $this->storeElapsed();

        return $this->elapsed - $this->time;
    }

    /**
     * @return int
     */
    public function getElapsedSeconds() : int
    {
        return (int) $this->getElapsed();
    }

    /**
     * @return int
     */
    public function getElapsedMilliseconds() : int
    {
        return (int) ($this->getElapsed() * 1000);
    }

    /**
     * @return int
     */
    public function getElapsedMicroseconds() : int
    {
        return (int) ($this->getElapsed() * 1000000);
    }

    /**
     * Returns true if stopwatch is running, otherwise false.
     * @return bool
     */
    public function isRunning() : bool
    {
        return $this->isRunning;
    }

    /**
     * Initializes stopwatch internals.
     */
    private function init()
    {
        $this->time = 0.0;
        $this->elapsed = 0.0;
        $this->isRunning = false;
    }

    /**
     * Stores elapsed time.
     */
    private function storeElapsed()
    {
        if ($this->isRunning === false) {
            return;
        }

        $this->elapsed = microtime(true);
    }
}
