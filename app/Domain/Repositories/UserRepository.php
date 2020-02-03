<?php

    namespace App\Domain\Repositories;

    use Illuminate\Database\Eloquent\Builder;
    use App\Domain\Entities\User;

    class UserRepository extends RepositoryAbstract
    {
        protected $model = User::class;

        public function allUsers(){
            return $this->createModel();
        }

        public function findUserBy(array $filter): Builder
        {
            return $this->createModel()->where($filter);
        }
    }
