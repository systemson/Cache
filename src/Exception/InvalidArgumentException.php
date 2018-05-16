<?php

namespace Amber\Cache\Exception;

use Psr\SimpleCache\InvalidArgumentException as InvalidArgumentExceptionInterface;

/**
 * Exception interface for invalid cache arguments.
 *
 * When an invalid argument is passed it must throw an exception which implements
 * this interface
 */
class InvalidArgumentException extends \InvalidArgumentException implements InvalidArgumentExceptionInterface
{
}
