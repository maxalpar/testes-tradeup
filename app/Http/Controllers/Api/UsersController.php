<?php

namespace App\Http\Controllers\Api;

use App\Domain\Entities\User;
use App\Supports\ApiControllerTrait;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UsersController extends Controller
{
    // use ApiControllerTrait;

    protected $model;
    protected $relationships = ['group'];
    public function __construct(User $model)
    {
        $this->model = $model;
    }

    public function index()
    {
        $users = User::paginate();
        return response()->json($users);
    }
}
