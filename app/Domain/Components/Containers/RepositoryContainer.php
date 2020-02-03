<?php


namespace App\Domain\Components\Containers;

class RepositoryContainer
{
    private $repository;

    public function getRepository($repository)
    {
        return $this->repository[$repository];
    }

    public function addRepository($repository)
    {
        $this->repository[$repository] = (new $repository());
    }
}
