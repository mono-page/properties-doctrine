<?php declare(strict_types=1);

namespace Monopage\Properties\Doctrine\Types;

use Doctrine\DBAL\Platforms\AbstractPlatform;
use Doctrine\DBAL\Types\BigIntType;
use Monopage\Properties\Doctrine\Exceptions\UnknownPropertyException;
use Monopage\Properties\Doctrine\Types;
use Monopage\Properties\IdProperty;

class IdPropertyType extends BigIntType
{
    public function getName(): string
    {
        return Types::ID_PROPERTY;
    }

    /**
     * {@inheritDoc}
     *
     * @throws UnknownPropertyException
     */
    public function convertToDatabaseValue($value, AbstractPlatform $platform)
    {
        if (null === $value) {
            return $value;
        }

        if ($value instanceof IdProperty) {
            return $value->getValue();
        }

        throw new UnknownPropertyException();
    }

    public function convertToPHPValue($value, AbstractPlatform $platform)
    {
        return IdProperty::create($value);
    }
}
