<?php

declare(strict_types=1);

namespace Tests\Unit\Catalog\Application\Service\Genre\List;

use Bookstore\Catalog\Application\Service\Genre\Delete\DeleteGenreRequest;
use Bookstore\Catalog\Application\Service\Genre\Delete\DeleteGenreService;
use Bookstore\Catalog\Domain\Model\Genre\GenreNotFoundException;
use Bookstore\Catalog\Domain\Model\Genre\GenreRepository;
use Exception;
use InvalidArgumentException;
use PHPUnit\Framework\TestCase;
use Tests\Unit\Catalog\Domain\Model\Genre\GenreObjectMother;

class DeleteGenreServiceTest extends TestCase
{
    public function testHappyPath(): void
    {
        $genre = GenreObjectMother::createOne();

        $repository = $this->createMock(GenreRepository::class);
        $repository
            ->expects($this->once())
            ->method('ofId')
            ->with($genre->genreId())
            ->willReturn($genre);
        $repository
            ->expects($this->once())
            ->method('remove')
            ->with($genre);

        $service = new DeleteGenreService($repository);
        $service->execute(
            new DeleteGenreRequest($genre->genreId()->value())
        );
    }

    public function testNotFound(): void
    {
        $genre = GenreObjectMother::createOne();

        $repository = $this->createMock(GenreRepository::class);
        $repository
            ->expects($this->once())
            ->method('ofId')
            ->with($genre->genreId())
            ->willReturn(null);

        $this->expectException(GenreNotFoundException::class);

        $service = new DeleteGenreService($repository);
        $service->execute(
            new DeleteGenreRequest($genre->genreId()->value())
        );
    }

    public function testInvalidArgument(): void
    {
        $service = new DeleteGenreService(
            $this->createMock(GenreRepository::class)
        );

        $this->expectException(InvalidArgumentException::class);

        $service->execute(
            new DeleteGenreRequest('invalid uuid')
        );
    }
}
