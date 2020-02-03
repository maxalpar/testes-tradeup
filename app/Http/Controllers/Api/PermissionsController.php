<?php

namespace App\Http\Controllers\Api;

use App\Domains\Entities\Permission;
use App\Http\Controllers\ApiControllerTrait;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PermissionsController extends Controller
{
    use ApiControllerTrait;

    protected $model;
    protected $relationships = ['modules','groups'];
    public function __construct(Permission $model)
    {
        $this->model = $model;
    }
}
