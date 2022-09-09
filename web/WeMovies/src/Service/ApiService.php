<?php

namespace App\Service;

use App\Entity\GenreMovie;
use App\Entity\Movie;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\DependencyInjection\ParameterBag\ContainerBagInterface;
use Symfony\Contracts\HttpClient\HttpClientInterface;

/**
 * Class ApiService
 */
class ApiService
{
    private const API_GENRE_MOVIE_LIST = 'https://api.themoviedb.org/3/genre/movie/list';
    private const API_DISCOVER_MOVIE = 'https://api.themoviedb.org/3/discover/movie';
    private const API_MOVIE = 'https://api.themoviedb.org/3/movie/%d?append_to_response=videos';

    /* TODO: Use this API for search bar */
    // private const API_SEARCH_MOVIE = 'https://api.themoviedb.org/3/search/movie?query=%s&language=fr-FR';

    /**
     * @var HttpClientInterface
     */
    private $client;

    /**
     * @var ContainerBagInterface
     */
    private $params;

    /**
     * @var MovieService
     */
    private $movieService;

    /**
     * ApiService constructor.
     *
     * @param HttpClientInterface   $client
     * @param ContainerBagInterface $params
     * @param MovieService          $movieService
     */
    public function __construct(HttpClientInterface $client, ContainerBagInterface $params, MovieService $movieService)
    {
        $this->client = $client;
        $this->params = $params;
        $this->movieService = $movieService;
    }

    /**
     * @return ArrayCollection
     */
    public function getAllGenreMovie(): ArrayCollection
    {
        // Call API TheMovieDB to get all genre existing for movies
        $response = $this->callApi(self::API_GENRE_MOVIE_LIST);

        // Add all genres in a new collection to easy use and manipulate
        $genresList = new ArrayCollection();
        foreach ($response['genres'] as $genres) {
            $genresList->add(
                new GenreMovie($genres['id'], $genres['name'])
            );
        }

        // We return this collection
        return $genresList;
    }

    /**
     * @param string|null $genres
     *
     * @return ArrayCollection
     */
    public function getMoviesList(?string $genres = null): ArrayCollection
    {
        // Prepare query params to send at API
        $options['language'] = 'fr-FR';

        // Add genres at query params if we want to get movies list by genre
        if (!is_null($genres)) {
            $options['with_genres'] = $genres;
        }

        // Call API TheMovieDB to get this list
        $response = $this->callApi(self::API_DISCOVER_MOVIE, $options);

        // Add all movies in a new collection to easy use and manipulate
        $moviesList = new ArrayCollection();
        foreach ($response['results'] as $movies) {
            $moviesList->add($this->getMovieDetails($movies));
        }

        // We return this collection sort by vote average
        return $this->movieService->sortCollectionMoviesByVoteAverage($moviesList);
    }

    /**
     * @param array $movies
     *
     * @return Movie
     */
    public function getMovieDetails(array $movies): Movie
    {
        // Prepare query params for other API call
        $options = [
            'language' => 'fr-FR',
            'append_to_response' => 'videos',
        ];

        // Call API to get all details for every movie and return result
        return $this->movieService->generateMovie(
            $this->callApi(sprintf(self::API_MOVIE, $movies['id']), $options)
        );
    }

    /**
     * @param string $url
     * @param array  $options
     * @param string $method
     *
     * @return array
     */
    private function callApi(string $url, array $options = [], string $method = 'GET'): array
    {
        $options = [
            'query' => array_merge($options, ['api_key' => $this->params->get('app.api_key_themoviedb')])
        ];

        return $this->client->request($method, $url, $options)->toArray();
    }
}