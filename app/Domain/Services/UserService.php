<?php

    namespace App\Domain\Services;

    use Carbon\Carbon;
    use Illuminate\Database\Eloquent\Builder;
    use Illuminate\Support\Collection;
    use App\Domain\Entities\User;
    use Illuminate\Support\Fluent;
    use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

    class UserService extends ServiceAbstract
    {
        public function all()
        {
            return  $this->userRepository->allUsers();
        }
        public function createOrUpdateUser($attribute): User
        {
            $filter = [
                'identification' => $attribute['identification']
            ];
            $user   = $this->userRepository->findUserBy($filter)->first();

            if (!$user instanceof User) {
                $user = $this->userRepository->create($this->populateUser($attribute, $user));
            } else {
                $user = $this->userRepository->update($user, $this->populateUser($attribute, $user));
            }

            return $user;
        }

        public function findUserBy($filter): User
        {
            $user = $this->userRepository->findUserBy($filter)->first();

            if (!$user instanceof User) {
                throw new NotFoundHttpException('Usuário não encontrado.');
            }

            return $user;
        }

        private function populateUser(array $attribute, User $user = null): array
        {
            $attribute = new Fluent($attribute);

            $data['identification'] = $attribute->identification;
            $data['name']           = $attribute->name;
            $data['job_role']       = $attribute->job_role;

            return $data;
        }
    }
