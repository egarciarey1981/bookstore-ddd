<?php

declare(strict_types=1);

namespace Tests\Unit\Catalog\Application\Service\Genre\View;

use App\Catalog\Application\Service\Genre\View\ViewGenreRequest;
use App\Catalog\Application\Service\Genre\View\ViewGenreService;
use App\Catalog\Domain\Model\Genre\GenreNotFoundException;
use App\Catalog\Domain\Model\Genre\GenreRepository;
use InvalidArgumentException;
use PHPUnit\Framework\TestCase;
use Tests\Unit\Catalog\Domain\Model\Genre\GenreObjectMother;

class ViewGenreServiceTest extends TestCase
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

        $service = new ViewGenreService($repository);
        $response = $service->execute(
            new ViewGenreRequest($genre->genreId()->value())
        );

        self::assertEquals($genre->genreId()->value(), $response->genre['id']);
        self::assertEquals($genre->genreName()->value(), $response->genre['name']);
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

        $service = new ViewGenreService($repository);
        $service->execute(
            new ViewGenreRequest($genre->genreId()->value())
        );
    }

    public function testMessageException(): void
    {
        $message = '';

        $genre = GenreObjectMother::createOne();

        $repository = $this->createMock(GenreRepository::class);
        $repository
            ->expects($this->once())
            ->method('ofId')
            ->with($genre->genreId())
            ->willReturn(null);

        try {
            $service = new ViewGenreService($repository);
            $service->execute(
                new ViewGenreRequest($genre->genreId()->value())
            );
        } catch (GenreNotFoundException $e) {
            $message = $e->getMessage();
        }

        self::assertEquals('Genre not found', $message);
    }

    public function testInvalidUuid(): void
    {
        $service = new ViewGenreService(
            $this->createMock(GenreRepository::class)
        );

        $this->expectException(InvalidArgumentException::class);

        $service->execute(
            new ViewGenreRequest('invalid uuid')
        );
    }
}
