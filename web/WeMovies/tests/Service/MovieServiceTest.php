<?php

namespace App\Tests\Service;

use App\Entity\Movie;
use App\Service\MovieService;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class MovieServiceTest extends KernelTestCase
{
    /**
     * @var MovieService
     */
    private MovieService $movieService;

    /**
     * @var ArrayCollection
     */
    private ArrayCollection $moviesCollection;

    /**
     * @var Movie
     */
    private Movie $movie1;

    /**
     * @var Movie
     */
    private Movie $bestMovie;

    /**
     * @var Movie
     */
    private Movie $movie3;

    /**
     * setUp MovieServiceTest
     */
    public function setUp(): void
    {
        $this->movie1 = (new Movie())
            ->setId(100)
            ->setVoteAverage(8)
            ->setTitle('Movie Numéro 1');
        $this->bestMovie = (new Movie())
            ->setId(200)
            ->setVoteAverage(9)
            ->setTitle('Movie Numéro 2');
        $this->movie3 = (new Movie())
            ->setId(300)
            ->setVoteAverage(7)
            ->setTitle('Movie Numéro 3');
        $this->moviesCollection = new ArrayCollection([
            $this->movie1,
            $this->bestMovie,
            $this->movie3,
        ]);

        $this->movieService = new MovieService();
    }

    /**
     * Unit Test for getBestMovie function
     */
    public function testGetBestMovie(): void
    {
        $bestMovie = $this->movieService->getBestMovie($this->moviesCollection);

        $this->assertEquals($this->bestMovie, $bestMovie);
    }

    /**
     * Unit Test for generateMovie function
     */
    public function testGenerateMovie(): void
    {
        $id = 555;
        $voteAverage = 4;
        $voteCount = 508896;
        $informations = [
            'id' => $id,
            'vote_average' => $voteAverage,
            'vote_count' => $voteCount,

        ];

        $movie = $this->movieService->generateMovie($informations);

        $this->assertInstanceOf(Movie::class, $movie);
        $this->assertEquals($id, $movie->getId());
        $this->assertEquals($voteAverage, $movie->getVoteAverage());
        $this->assertEquals($voteCount, $movie->getVoteCount());
    }

    /**
     * Unit Test for sortCollectionMoviesByVoteAverage function
     */
    public function testSortCollectionMoviesByVoteAverage(): void
    {
        $moviesSort = $this->movieService->sortCollectionMoviesByVoteAverage($this->moviesCollection);

        $this->assertEquals($this->bestMovie, $moviesSort->first());
        $this->assertEquals($this->movie3, $moviesSort->last());
    }
}
