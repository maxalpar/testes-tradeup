<?php

namespace App\Http\Controllers\Api;

use App\Domains\Entities\Submodule;
use App\Http\Controllers\ApiControllerTrait;
use App\Http\Controllers\Controller;

class SubmodulesController extends Controller
{
    use ApiControllerTrait;

    protected $model;
    protected $relationships = ['module','permissions'];
    public function __construct(Submodule $model)
    {
        $this->model = $model;
    }
}
