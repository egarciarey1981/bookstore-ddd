<?php

declare(strict_types=1);

namespace Tests\Unit\Catalog\Application\Service\Genre\List;

use App\Catalog\Application\Service\Genre\Delete\DeleteGenreRequest;
use App\Catalog\Application\Service\Genre\Delete\DeleteGenreService;
use App\Catalog\Domain\Model\Genre\GenreNotFoundException;
use App\Catalog\Domain\Model\Genre\GenreRepository;
use Exception;
use InvalidArgumentException;
use PHPUnit\Framework\TestCase;
use Tests\Unit\Catalog\Domain\Model\Genre\GenreObjectMother;

class DeleteGenreServiceTest extends TestCase
{
    public function testDelete(): void
    {
        $genre = GenreObjectMother::createOne();

        $repository = $this->createMock(GenreRepository::class);
        $repository
            ->expects($this->once())
            ->method('ofId')
            ->with($genre->id())
            ->willReturn($genre);
        $repository
            ->expects($this->once())
            ->method('remove')
            ->with($genre)
            ->willReturn(true);

        $service = new DeleteGenreService($repository);
        $service->execute(
            new DeleteGenreRequest(strval($genre->id()))
        );
    }

    public function testNotDelete(): void
    {
        $genre = GenreObjectMother::createOne();

        $repository = $this->createMock(GenreRepository::class);
        $repository
            ->expects($this->once())
            ->method('ofId')
            ->with($genre->id())
            ->willReturn($genre);
        $repository
            ->expects($this->once())
            ->method('remove')
            ->with($genre)
            ->willReturn(false);

        $this->expectException(Exception::class);

        $service = new DeleteGenreService($repository);
        $service->execute(
            new DeleteGenreRequest(strval($genre->id()))
        );
    }

    public function testNotFound(): void
    {
        $genre = GenreObjectMother::createOne();

        $repository = $this->createMock(GenreRepository::class);
        $repository
            ->expects($this->once())
            ->method('ofId')
            ->with($genre->id())
            ->willReturn(null);

        $this->expectException(GenreNotFoundException::class);

        $service = new DeleteGenreService($repository);
        $service->execute(
            new DeleteGenreRequest(strval($genre->id()))
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
