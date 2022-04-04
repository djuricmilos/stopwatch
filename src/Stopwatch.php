<?php

/**
 * This file is part of the Stopwatch package.
 *
 * Copyright (c) Miloš Đurić <djuric.milos@gmail.com>
 *
 * For full copyright and license information, please refer to the LICENSE file,
 * located at the package root folder.
 */

namespace Laganica\Stopwatch;

/**
 * Class Stopwatch
 *
 * @package Laganica\Stopwatch
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

    /**
     * Constuctor
     */
    private function __construct()
    {
        $this->init();
    }

    /**
     * @return Stopwatch
     */
    public static function createNew(): self
    {
        return new self();
    }

    /**
     * Starts or resumes measurement.
     *
     * @return void
     */
    public function start(): void
    {
        $this->time = microtime(true) - $this->getElapsed();
        $this->isRunning = true;
    }

    /**
     * Stops measurement.
     *
     * @return void
     */
    public function stop(): void
    {
        $this->storeElapsed();
        $this->isRunning = false;
    }

    /**
     * Stops measurement and starts from the beginning.
     *
     * @return void
     */
    public function restart(): void
    {
        $this->init();
        $this->start();
    }

    /**
     * Stops measurement and resets elapsed time.
     *
     * @return void
     */
    public function reset(): void
    {
        $this->init();
    }

    /**
     * @return float
     */
    public function getElapsed(): float
    {
        $this->storeElapsed();

        return $this->elapsed - $this->time;
    }

    /**
     * @return int
     */
    public function getElapsedSeconds(): int
    {
        return (int) $this->getElapsed();
    }

    /**
     * @return int
     */
    public function getElapsedMilliseconds(): int
    {
        return (int) ($this->getElapsed() * 1000);
    }

    /**
     * @return int
     */
    public function getElapsedMicroseconds(): int
    {
        return (int) ($this->getElapsed() * 1000000);
    }

    /**
     * Returns true if stopwatch is running, otherwise false.
     *
     * @return bool
     */
    public function isRunning(): bool
    {
        return $this->isRunning;
    }

    /**
     * Initializes stopwatch internals.
     *
     * @return void
     */
    private function init(): void
    {
        $this->time = 0.0;
        $this->elapsed = 0.0;
        $this->isRunning = false;
    }

    /**
     * Stores elapsed time.
     *
     * @return void
     */
    private function storeElapsed(): void
    {
        if ($this->isRunning === false) {
            return;
        }

        $this->elapsed = microtime(true);
    }
}
