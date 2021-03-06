<?php

/**
 * Linna Framework.
 *
 * @author Sebastian Rapetti <sebastian.rapetti@alice.it>
 * @copyright (c) 2018, Sebastian Rapetti
 * @license http://opensource.org/licenses/MIT MIT License
 */
declare(strict_types=1);

namespace Linna\Storage;

use InvalidArgumentException;

/**
 * Storage Factory.
 */
abstract class AbstractStorageFactory
{
    /**
     * @var string One of supported drivers
     */
    protected string $driver = '';

    /**
     * @var array<string> Factory supported driver
     */
    protected array $supportedDriver = [];

    /**
     * @var array<mixed> Options for the driver
     */
    protected array $options = [];

    /**
     * Constructor.
     *
     * @param string       $driver
     * @param array<mixed> $options
     */
    public function __construct(string $driver, array $options)
    {
        $this->driver = $driver;
        $this->options = $options;
    }

    /**
     * Return Storage Object.
     *
     * @throws InvalidArgumentException If required driver is not supported
     *
     * @return mixed
     */
    protected function returnStorageObject()
    {
        $driver = $this->driver;
        $options = $this->options;

        if (isset($this->supportedDriver[$driver])) {
            $class = $this->supportedDriver[$driver];

            return new $class($options);
        }

        throw new InvalidArgumentException("[{$driver}] not supported.");
    }

    /**
     * Get storage object.
     *
     * @return mixed
     */
    abstract public function get();
}
