<?php declare(strict_types=1);

namespace Monopage\Properties\Types\Doctrine;

use Monopage\Contracts\Exceptions\MaintenanceException;

class UnknownPropertyException extends MaintenanceException
{
    public $message = 'Unknown property in type';
}
