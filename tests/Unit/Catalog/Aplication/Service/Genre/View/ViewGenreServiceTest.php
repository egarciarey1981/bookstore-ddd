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
    public function testFind(): void
    {
        $genre = GenreObjectMother::createOne();

        $repository = $this->createMock(GenreRepository::class);
        $repository
            ->expects($this->once())
            ->method('genreOfId')
            ->with($genre->id())
            ->willReturn($genre);

        $service = new ViewGenreService($repository);
        $response = $service->execute(
            new ViewGenreRequest(strval($genre->id()))
        );

        self::assertEquals(strval($genre->id()), $response->genre['id']);
        self::assertEquals(strval($genre->name()), $response->genre['name']);
    }

    public function testNotFound(): void
    {
        $genre = GenreObjectMother::createOne();

        $repository = $this->createMock(GenreRepository::class);
        $repository
            ->expects($this->once())
            ->method('genreOfId')
            ->with($genre->id())
            ->willReturn(null);

        $this->expectException(GenreNotFoundException::class);

        $service = new ViewGenreService($repository);
        $service->execute(
            new ViewGenreRequest(strval($genre->id()))
        );
    }

    public function testMessageException(): void
    {
        $message = '';

        $genre = GenreObjectMother::createOne();

        $repository = $this->createMock(GenreRepository::class);
        $repository
            ->expects($this->once())
            ->method('genreOfId')
            ->with($genre->id())
            ->willReturn(null);

        try {
            $service = new ViewGenreService($repository);
            $service->execute(
                new ViewGenreRequest(strval($genre->id()))
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
