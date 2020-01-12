<?php declare(strict_types=1);

namespace Monopage\Properties\Doctrine\Types;

use Doctrine\DBAL\Platforms\AbstractPlatform;
use Doctrine\DBAL\Types\StringType;
use Monopage\Properties\Doctrine\Exceptions\UnknownPropertyException;
use Monopage\Properties\Doctrine\Types;
use Monopage\Properties\StringProperty;

class StringPropertyType extends StringType
{
    public function getName(): string
    {
        return Types::STRING_PROPERTY;
    }

    public function getDefaultLength(AbstractPlatform $platform)
    {
        return 65_535;
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

        if ($value instanceof StringProperty) {
            return $value->getValue();
        }

        throw new UnknownPropertyException();
    }

    public function convertToPHPValue($value, AbstractPlatform $platform)
    {
        return StringProperty::create($value);
    }
}
