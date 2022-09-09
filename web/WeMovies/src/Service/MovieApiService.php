<?php

namespace App\Service;

use App\Entity\GenreMovie;
use App\Entity\Movie;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\DependencyInjection\ParameterBag\ContainerBagInterface;
use Symfony\Contracts\HttpClient\HttpClientInterface;
use Symfony\Contracts\HttpClient\ResponseInterface;

/**
 * Class MovieApiService
 */
class MovieApiService
{
    private const API_GENRE_MOVIE_LIST = 'https://api.themoviedb.org/3/genre/movie/list';
    private const API_SEARCH_MOVIE = 'https://api.themoviedb.org/3/search/movie?query=%s&language=fr-FR';
    private const API_DISCOVER_MOVIE = 'https://api.themoviedb.org/3/discover/movie';
    private const API_MOVIE = 'https://api.themoviedb.org/3/movie/%d?append_to_response=videos';

    /**
     * @var HttpClientInterface
     */
    private $client;

    /**
     * @var ContainerBagInterface
     */
    private $params;

    /**
     * MovieApiService constructor.
     *
     * @param HttpClientInterface $client
     */
    public function __construct(HttpClientInterface $client, ContainerBagInterface $params)
    {
        $this->client = $client;
        $this->params = $params;
    }

    /**
     * @return ArrayCollection
     */
    public function getAllGenreMovie(): ArrayCollection
    {
        $response = $this->callApi(self::API_GENRE_MOVIE_LIST);

        $genres = new ArrayCollection();
        foreach ($response['genres'] as $genre) {
            $genres->add(
                new GenreMovie($genre['id'], $genre['name'])
            );
        }

        return $genres;
    }

    /**
     * @param string $genres
     *
     * @return ArrayCollection
     */
    public function getMoviesList(?string $genres = null): ArrayCollection
    {
        $options = [
            'language' => 'fr-FR',
        ];
        if (!is_null($genres)) {
            $options['with_genres'] = $genres;
        }

        $response = $this->callApi(self::API_DISCOVER_MOVIE, $options);

        $movies = new ArrayCollection();
        foreach ($response['results'] as $movie) {
            $options = [
                'language' => 'fr-FR',
                'append_to_response' => 'videos',
            ];
            $movieInformations = $this->callApi(sprintf(self::API_MOVIE, $movie['id']), $options);
//            var_dump($movieInformations);

            $movies->add(
                (new Movie())->setId($movieInformations['id'])
                ->setTitle($movieInformations['title'] ?? '')
                ->setOverview($movieInformations['overview'] ?? '')
                ->setPosterPath($movieInformations['poster_path'] ?? '')
                ->setProductionCompanies($movieInformations['production_companies'] ?? [])
                ->setReleaseDate(new \DateTime($movieInformations['release_date']) ?? new \DateTime('0000-00-00'))
//                ->setTrailer($movieInformations['id'])
                ->setVoteAverage($movieInformations['vote_average'] ?? 0)
                ->setVoteCount($movieInformations['vote_count'] ?? 0)
            );
        }

        return $movies;
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