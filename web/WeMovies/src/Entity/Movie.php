<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;

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
     * @var float
     */
    private float $voteAverage;

    /**
     * @var int
     */
    private int $voteCount;

    /**
     * @var \DateTime|null
     */
    private \DateTime|null $releaseDate;

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
     * @var ArrayCollection|null
     */
    private ArrayCollection|null $trailer;

    /**
     * Movie constructor.
     */
    public function __construct()
    {
        $this->trailer = new ArrayCollection();
    }

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
     * @return float
     */
    public function getVoteAverage(): float
    {
        return $this->voteAverage;
    }

    /**
     * @param float $voteAverage
     * @return Movie
     */
    public function setVoteAverage(float $voteAverage): Movie
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
     * @return \DateTime|null
     */
    public function getReleaseDate(): ?\DateTime
    {
        return $this->releaseDate;
    }

    /**
     * @param \DateTime|null $releaseDate
     * @return Movie
     */
    public function setReleaseDate(?\DateTime $releaseDate): Movie
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
     * @return ArrayCollection|null
     */
    public function getTrailer(): ?ArrayCollection
    {
        return $this->trailer;
    }

    /**
     * @param ArrayCollection|null $trailer
     * @return Movie
     */
    public function setTrailer(?ArrayCollection $trailer): Movie
    {
        $this->trailer = $trailer;

        return $this;
    }
}
