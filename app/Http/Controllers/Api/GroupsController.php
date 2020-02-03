<?php

namespace App\Http\Controllers\Api;

use App\Domains\Entities\Group;
use App\Supports\ApiControllerTrait;
use App\Supports\BaseRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class GroupsController extends Controller
{
    use ApiControllerTrait;

    protected $model;
    protected $repository;
    protected $relationships = ['users','permissions'];
    public function __construct(Group $model, BaseRepository $repository)
    {
        $this->model = $model;
        $this->repository = $repository;
    }
}
