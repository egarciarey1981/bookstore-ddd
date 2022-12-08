<?php

declare(strict_types=1);

namespace Tests\Unit\Catalog\Application\Service\Genre\View;

use Bookstore\Catalog\Application\DataTransformer\Genre\ArrayGenreDataTransformer;
use Bookstore\Catalog\Application\Service\Genre\View\ViewGenreRequest;
use Bookstore\Catalog\Application\Service\Genre\View\ViewGenreService;
use Bookstore\Catalog\Domain\Model\Genre\GenreNotFoundException;
use Bookstore\Catalog\Domain\Model\Genre\GenreRepository;
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

        $service = new ViewGenreService(
            $repository,
            new ArrayGenreDataTransformer(),
        );

        $service->execute(
            new ViewGenreRequest($genre->genreId()->value())
        );

        $genreDataTransformer = $service->genreDataTransformer();

        $array = $genreDataTransformer->read();

        self::assertEquals($genre->genreId()->value(), $array['id']);
        self::assertEquals($genre->genreName()->value(), $array['name']);
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

        $service = new ViewGenreService(
            $repository,
            new ArrayGenreDataTransformer(),
        );

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
            $service = new ViewGenreService(
                $repository,
                new ArrayGenreDataTransformer(),
            );

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
            $this->createMock(GenreRepository::class),
            new ArrayGenreDataTransformer(),
        );

        $this->expectException(InvalidArgumentException::class);

        $service->execute(
            new ViewGenreRequest('invalid uuid')
        );
    }
}
