<?php

namespace App\Entity;

/**
 * Class Movie
 */
class Movie
{
    /**
     * @var int
     */
    private int $id;

    /**
     * @var string
     */
    private string $title;

    /**
     * @var int
     */
    private int $voteAverage;

    /**
     * @var int
     */
    private int $voteCount;

    /**
     * @var \DateTime
     */
    private \DateTime $releaseDate;

    /**
     * @var string
     */
    private string $overview;

    /**
     * @var string
     */
    private string $posterPath;

    /**
     * @var array
     */
    private array $productionCompanies;

    /**
     * @var array
     */
    private array $trailer;

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     * @return Movie
     */
    public function setId(int $id): self
    {
        $this->id = $id;

        return $this;
    }

    /**
     * @return string
     */
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * @param string $title
     * @return Movie
     */
    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    /**
     * @return int
     */
    public function getVoteAverage(): int
    {
        return $this->voteAverage;
    }

    /**
     * @param int $voteAverage
     * @return Movie
     */
    public function setVoteAverage(int $voteAverage): Movie
    {
        $this->voteAverage = $voteAverage;

        return $this;
    }

    /**
     * @return int
     */
    public function getVoteCount(): int
    {
        return $this->voteCount;
    }

    /**
     * @param int $voteCount
     * @return Movie
     */
    public function setVoteCount(int $voteCount): Movie
    {
        $this->voteCount = $voteCount;

        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getReleaseDate(): \DateTime
    {
        return $this->releaseDate;
    }

    /**
     * @param \DateTime $releaseDate
     * @return Movie
     */
    public function setReleaseDate(\DateTime $releaseDate): Movie
    {
        $this->releaseDate = $releaseDate;

        return $this;
    }

    /**
     * @return string
     */
    public function getOverview(): string
    {
        return $this->overview;
    }

    /**
     * @param string $overview
     * @return Movie
     */
    public function setOverview(string $overview): Movie
    {
        $this->overview = $overview;

        return $this;
    }

    /**
     * @return string
     */
    public function getPosterPath(): string
    {
        return $this->posterPath;
    }

    /**
     * @param string $posterPath
     * @return Movie
     */
    public function setPosterPath(string $posterPath): Movie
    {
        $this->posterPath = $posterPath;

        return $this;
    }

    /**
     * @return array
     */
    public function getProductionCompanies(): array
    {
        return $this->productionCompanies;
    }

    /**
     * @param array $productionCompanies
     * @return Movie
     */
    public function setProductionCompanies(array $productionCompanies): Movie
    {
        $this->productionCompanies = $productionCompanies;

        return $this;
    }

    /**
     * @return array
     */
    public function getTrailer(): array
    {
        return $this->trailer;
    }

    /**
     * @param array $trailer
     * @return Movie
     */
    public function setTrailer(array $trailer): Movie
    {
        $this->trailer = $trailer;

        return $this;
    }
}
