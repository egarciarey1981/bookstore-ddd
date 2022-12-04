<?php

declare(strict_types=1);

namespace App\Catalog\Infrastructure\Persistence\Doctrine\Types\Genre;

use App\Catalog\Domain\Model\Genre\GenreName;
use Doctrine\DBAL\Platforms\AbstractPlatform;
use Doctrine\DBAL\Types\Type;

class GenreNameType extends Type
{
    public function getName(): string
    {
        return 'GenreName';
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
     * @return GenreName
     */
    public function convertToPHPValue(
        $value,
        AbstractPlatform $platform
    ) {
        return new GenreName($value);
    }
    /**
     * @param GenreName $value
     */
    public function convertToDatabaseValue(
        $value,
        AbstractPlatform $platform
    ) {
        return strval($value);
    }
}
