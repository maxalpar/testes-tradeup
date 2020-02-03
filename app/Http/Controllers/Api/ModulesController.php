<?php

namespace App\Http\Controllers\Api;

use App\Domain\Entities\Module;
use App\Supports\ApiControllerTrait;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ModulesController extends Controller
{
    use ApiControllerTrait;

    protected $model;
    protected $relationships = ['submodule'];
    public function __construct(Module $model)
    {
        $this->model = $model;
    }

    public function index()
    {
        $modules = Module::paginate();
        return response()->json($modules);
    }
}
