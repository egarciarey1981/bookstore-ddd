<?php

declare(strict_types=1);

namespace App\Catalog\Infrastructure\Persistence\Doctrine;

use App\Catalog\Domain\Model\Genre\Genre;
use App\Catalog\Domain\Model\Genre\GenreId;
use App\Catalog\Domain\Model\Genre\GenreRepository;
use Doctrine\ORM\EntityManager;
use Ramsey\Uuid\Uuid;

class DoctrineGenreRepository implements GenreRepository
{
    private EntityManager $em;

    public function __construct(EntityManager $em)
    {
        $this->em = $em;
    }

    public function nextId(): GenreId
    {
        $uuid = Uuid::uuid4();
        return new GenreId($uuid->toString());
    }

    public function ofId(GenreId $id): ?Genre
    {
        return $this->em->find('App\Catalog\Domain\Model\Genre\Genre', $id);
    }

    public function contains(Genre $genre): bool
    {
        return !is_null($this->em->find('App\Catalog\Domain\Model\Genre\Genre', $genre->genreId()));
    }

    public function save(Genre $genre): void
    {
        $this->em->persist($genre);
        $this->em->flush();
    }

    public function remove(Genre $genre): void
    {
        $this->em->remove($genre);
        $this->em->flush();
    }

    /**
     * @return array<Genre>
     */
    public function all(): array
    {
        $repository = $this->em->getRepository('App\Catalog\Domain\Model\Genre\Genre');
        return $repository->findAll();
    }
}
