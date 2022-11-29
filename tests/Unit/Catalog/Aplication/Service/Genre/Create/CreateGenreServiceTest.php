<?php

declare(strict_types=1);

namespace Tests\Unit\Catalog\Application\Service\Genre\View;

use App\Catalog\Application\Service\Genre\Create\CreateGenreRequest;
use App\Catalog\Application\Service\Genre\Create\CreateGenreService;
use App\Catalog\Domain\Model\Genre\GenreId;
use App\Catalog\Domain\Model\Genre\GenreName;
use App\Catalog\Infrastructure\Persistence\InMemory\InMemoryGenreRepository;
use PHPUnit\Framework\TestCase;

class CreateGenreServiceTest extends TestCase
{
    public function testCreate(): void
    {
        $name = 'Terror';

        $repository = new InMemoryGenreRepository();
        
        $service = new CreateGenreService($repository);
        $response = $service->execute(
            new CreateGenreRequest(
                $name
            )
        );
            
        $genreId = new GenreId($response->genre['id']);
        $genre = $repository->genreOfId($genreId);

        self::assertTrue($genre->id()->equals($genreId));
        self::assertTrue($genre->name()->equals(new GenreName($name)));
    }

}
