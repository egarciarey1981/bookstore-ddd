<?php

declare(strict_types=1);

namespace Tests\Unit\Catalog\Application\Service\Genre\List;

use Bookstore\Catalog\Application\Service\Genre\Search\SearchGenreRequest;
use Bookstore\Catalog\Application\Service\Genre\Search\SearchGenreService;
use Bookstore\Catalog\Domain\Model\Genre\GenreRepository;
use PHPUnit\Framework\TestCase;
use Tests\Unit\Catalog\Domain\Model\Genre\GenreObjectMother;

class SearchGenreServiceTest extends TestCase
{
    public function testHappyPath(): void
    {
        $total = rand(3, 9);

        $genres = [];
        for ($i = 0; $i < $total; $i++) {
            $genres[] = GenreObjectMother::createOne();
        }

        $repository = $this->createMock(GenreRepository::class);
        $repository
            ->expects($this->once())
            ->method('all')
            ->willReturn($genres);

        $service = new SearchGenreService($repository);
        $response = $service->execute(
            new SearchGenreRequest()
        );

        self::assertEquals($total, count($response->genres));
    }
}
