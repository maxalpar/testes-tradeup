<?php

    namespace App\Http\Controllers;

    use App\Domain\Services\RefundsService;
    use App\Domain\Services\UserService;
    use Illuminate\Foundation\Bus\DispatchesJobs;
    use Illuminate\Http\JsonResponse;
    use Illuminate\Support\Facades\Response;
    use Illuminate\Routing\Controller as BaseController;
    use Illuminate\Foundation\Validation\ValidatesRequests;
    use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
    use App\Domain\Components\Containers\ServiceContainer;


    abstract class ControllerAbstract extends BaseController
    {
        use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

        public $response;

        /**
         * @var UserService
         */
        protected $userService;

        /**
         * @var RefundsService
         */
        protected $refundsService;

        public function __construct(ServiceContainer $serviceContainer)
        {
            $this->response = [
                'codigo' => 0,
                'mensagem' => null,
                'dados' => []
            ];

            $this->userService    = $serviceContainer->getService(UserService::class);
            $this->refundsService = $serviceContainer->getService(RefundsService::class);
       }

        protected function buildResponseError(\Exception $exception, int $codeStatus): JsonResponse
        {
            $this->response['mensagem'] = $exception->getMessage();
            $this->response['codigo'] = $exception->getCode();
            $this->response['dados'] = method_exists($exception, 'getParams') ? $exception->getParams() : null;

            return Response::json($this->response, $codeStatus);
        }

    }
