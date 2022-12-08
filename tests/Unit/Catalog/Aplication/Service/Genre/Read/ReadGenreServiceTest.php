<?php

declare(strict_types=1);

namespace Tests\Unit\Catalog\Application\Service\Genre\Read;

use Bookstore\Catalog\Application\Service\Genre\Read\ReadGenreRequest;
use Bookstore\Catalog\Application\Service\Genre\Read\ReadGenreService;
use Bookstore\Catalog\Domain\Model\Genre\GenreNotFoundException;
use Bookstore\Catalog\Domain\Model\Genre\GenreRepository;
use InvalidArgumentException;
use PHPUnit\Framework\TestCase;
use Tests\Unit\Catalog\Domain\Model\Genre\GenreObjectMother;

class ReadGenreServiceTest extends TestCase
{
    public function testHappyPath(): void
    {
        $genre = GenreObjectMother::createOne();

        $genreRepository = $this->createMock(GenreRepository::class);
        $genreRepository
            ->expects($this->once())
            ->method('genreOfId')
            ->with($genre->genreId())
            ->willReturn($genre);

        $readGenreService = new ReadGenreService($genreRepository);

        $response = $readGenreService->execute(
            new ReadGenreRequest($genre->genreId()->value())
        );

        self::assertEquals($genre->genreId()->value(), $response->genre['id']);
        self::assertEquals($genre->genreName()->value(), $response->genre['name']);
    }

    public function testNotFound(): void
    {
        $this->expectException(GenreNotFoundException::class);

        $genre = GenreObjectMother::createOne();

        $genreRepository = $this->createMock(GenreRepository::class);
        $genreRepository
            ->expects($this->once())
            ->method('genreOfId')
            ->with($genre->genreId())
            ->willReturn(null);
    
        $readGenreService = new ReadGenreService($genreRepository);

        $readGenreService->execute(
            new ReadGenreRequest($genre->genreId()->value())
        );
    }

    public function testMessageException(): void
    {
        $message = '';

        $genre = GenreObjectMother::createOne();

        $genreRepository = $this->createMock(GenreRepository::class);
        $genreRepository
            ->expects($this->once())
            ->method('genreOfId')
            ->with($genre->genreId())
            ->willReturn(null);

        $readGenreService = new ReadGenreService($genreRepository);

        try {
            $readGenreService->execute(
                new ReadGenreRequest($genre->genreId()->value())
            );
        } catch (GenreNotFoundException $e) {
            $message = $e->getMessage();
        }

        self::assertEquals('Genre not found', $message);
    }

    public function testInvalidUuid(): void
    {
        $this->expectException(InvalidArgumentException::class);

        $readGenreService = new ReadGenreService(
            $this->createMock(GenreRepository::class)
        );

        $readGenreService->execute(
            new ReadGenreRequest('invalid uuid')
        );
    }
}
