<?php declare(strict_types=1);

namespace Monopage\Properties\Doctrine\Types;

use Doctrine\DBAL\Platforms\AbstractPlatform;
use Doctrine\DBAL\Types\StringType;
use Monopage\Properties\AliasProperty;
use Monopage\Properties\Doctrine\Exceptions\UnknownPropertyException;
use Monopage\Properties\Doctrine\Types;

class AliasPropertyType extends StringType
{
    public function getName(): string
    {
        return Types::ALIAS_PROPERTY;
    }

    public function getDefaultLength(AbstractPlatform $platform)
    {
        return 100;
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

        if ($value instanceof AliasProperty) {
            return $value->getValue();
        }

        throw new UnknownPropertyException();
    }

    public function convertToPHPValue($value, AbstractPlatform $platform)
    {
        return AliasProperty::create($value);
    }
}
