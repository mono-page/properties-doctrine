<?php declare(strict_types=1);

namespace Monopage\Properties\Doctrine\Exceptions;

use Monopage\Contracts\Exceptions\MaintenanceException;

class UnknownPropertyException extends MaintenanceException
{
    public $message = 'Unknown property in type';
}
