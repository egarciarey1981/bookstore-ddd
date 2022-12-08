<?php

declare(strict_types=1);

namespace Bookstore\Catalog\Infrastructure\Persistence\Doctrine\Types\Genre;

use Bookstore\Catalog\Domain\Model\Genre\GenreId;
use Doctrine\DBAL\Platforms\AbstractPlatform;
use Doctrine\DBAL\Types\Type;

class GenreIdType extends Type
{
    public function getName(): string
    {
        return 'GenreId';
    }

    public function getSQLDeclaration(
        array $fieldDeclaration,
        AbstractPlatform $platform
    ) {
        return $platform->getVarcharTypeDeclarationSQL(
            $fieldDeclaration
        );
    }

    /**
     * @param string $value
     * @return GenreId
     */
    public function convertToPHPValue(
        $value,
        AbstractPlatform $platform
    ) {
        return new GenreId($value);
    }
    /**
     * @param GenreId $value
     */
    public function convertToDatabaseValue(
        $value,
        AbstractPlatform $platform
    ) {
        return strval($value);
    }
}
