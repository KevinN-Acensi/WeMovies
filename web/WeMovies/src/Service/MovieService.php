<?php

namespace App\Service;

use App\Entity\Movie;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Criteria;

/**
 * Class MovieService
 */
class MovieService
{
    private const VIDEO_TYPE_TRAILER = 'Trailer';

    /**
     * @param ArrayCollection $movies
     *
     * @return Movie
     */
    public function getBestMovie(ArrayCollection $movies): Movie
    {
        // Return the best movie by vote average
        return $this->sortCollectionMoviesByVoteAverage($movies)->first();
    }

    /**
     * @param array $informations
     *
     * @return Movie
     */
    public function generateMovie(array $informations): Movie
    {
        // Return a movie entity with details
        return (new Movie())->setId($informations['id'])
            ->setTitle($informations['title'] ?? '')
            ->setOverview(array_key_exists('overview', $informations) ? $informations['overview'] : '')
            ->setPosterPath(array_key_exists('poster_path', $informations) ? $informations['poster_path'] : '')
            ->setProductionCompanies(array_key_exists('production_companies', $informations) ? $informations['production_companies'] : [])
            ->setReleaseDate(array_key_exists('release_date', $informations) ? new \DateTime($informations['release_date']) : null)
            ->setTrailer(array_key_exists('videos', $informations) ? $this->getTrailerMovie($informations) : null)
            ->setVoteAverage($informations['vote_average'] ?? 0)
            ->setVoteCount($informations['vote_count'] ?? 0);
    }

    /**
     * @param array $informations
     *
     * @return ArrayCollection
     */
    public function getTrailerMovie(array $informations): ArrayCollection
    {
        // Create criteria to get the first trailer about this film but we can change to select all trailer if we want
        $collection = new ArrayCollection($informations['videos']['results']);
        $expr = Criteria::expr();
        $criteria = new Criteria($expr->eq('type', self::VIDEO_TYPE_TRAILER), ['published_at' => Criteria::ASC], true);

        return $collection->matching($criteria);
    }

    /**
     * @param ArrayCollection $collection
     *
     * @return ArrayCollection
     */
    public function sortCollectionMoviesByVoteAverage(ArrayCollection $collection): ArrayCollection
    {
        // Sort collection by vote average of this movie
        $iterator = $collection->getIterator();
        $iterator->uasort(
            function ($first, $second) {
                return ($first->getVoteAverage() >= $second->getVoteAverage()) ? -1 : 1;
            }
        );

        return new ArrayCollection(iterator_to_array($iterator));
    }
}