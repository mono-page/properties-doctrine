<?php declare(strict_types=1);

namespace Monopage\Properties\Doctrine\Types;

use Doctrine\DBAL\Platforms\AbstractPlatform;
use Doctrine\DBAL\Types\StringType;
use Monopage\Properties\Doctrine\Exceptions\UnknownPropertyException;
use Monopage\Properties\Doctrine\Types;
use Monopage\Properties\LocaleProperty;

class LocalePropertyType extends StringType
{
    public function getName(): string
    {
        return Types::LOCALE_PROPERTY;
    }

    public function getDefaultLength(AbstractPlatform $platform)
    {
        return 5;
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

        if ($value instanceof LocaleProperty) {
            return $value->getLocaleString();
        }

        throw new UnknownPropertyException();
    }

    public function convertToPHPValue($value, AbstractPlatform $platform)
    {
        [$language, $territory] = explode('-', $value, 2);

        return LocaleProperty::create($language, $territory);
    }
}
