<?php

declare(strict_types=1);

namespace Tests\Unit\Catalog\Application\Service\Genre\List;

use App\Catalog\Application\Service\Genre\List\ListGenreRequest;
use App\Catalog\Application\Service\Genre\List\ListGenreService;
use App\Catalog\Domain\Model\Genre\GenreRepository;
use PHPUnit\Framework\TestCase;
use Tests\Unit\Catalog\Domain\Model\Genre\GenreObjectMother;

class ListGenreServiceTest extends TestCase
{
    public function testList(): void
    {
        $total = 3;

        $genres = [];
        for($i=0; $i<$total; $i++){
            $genres[] = GenreObjectMother::createOne();
        }

        $repository = $this->createMock(GenreRepository::class);
        $repository
            ->expects($this->once())
            ->method('all')
            ->willReturn($genres);

        $service = new ListGenreService($repository);
        $response = $service->execute(
            new ListGenreRequest()
        );

        self::assertEquals($total, count($response->genres));
    }
}
