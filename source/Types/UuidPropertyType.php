<?php declare(strict_types=1);

namespace Monopage\Properties\Doctrine\Types;

use Doctrine\DBAL\Platforms\AbstractPlatform;
use Doctrine\DBAL\Types\GuidType;
use Monopage\Properties\Doctrine\Exceptions\UnknownPropertyException;
use Monopage\Properties\Doctrine\Types;
use Monopage\Properties\UuidProperty;

class UuidPropertyType extends GuidType
{
    public function getName(): string
    {
        return Types::UUID_PROPERTY;
    }

    public function getDefaultLength(AbstractPlatform $platform)
    {
        return 36;
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

        if ($value instanceof UuidProperty) {
            return $value->getValue();
        }

        throw new UnknownPropertyException();
    }

    public function convertToPHPValue($value, AbstractPlatform $platform)
    {
        return UuidProperty::create($value);
    }
}
