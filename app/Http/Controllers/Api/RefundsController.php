<?php

namespace App\Http\Controllers\Api;

use App\Exceptions\RefundsNotFoundException;
use App\Http\Requests\Refunds\RefundsUpdateRequest;
use App\Http\Requests\Report\ReportRequest;
use App\Http\Resources\RefundsResourceCollection;
use App\Http\Resources\ReportResourceCollection;
use Symfony\Component\HttpFoundation\Response as HttpResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\ControllerAbstract;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Fluent;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class RefundsController extends ControllerAbstract
{

    public function get(Request $request)
    {
        $refunds = $this->userService->all()->load(array('refunds'));
        $refunds = $refunds->paginate(10, ['*'], 'page', $request->get('pagina') ?? 1);
        $this->response['dados'] = new RefundsResourceCollection($refunds);

        return Response::json($this->response, HttpResponse::HTTP_OK);

    }

    public function create(Request $request)
    {
        try {
            $data = new Fluent($request->all());

            $userValues['identification'] = $data->identification;
            $userValues['name']           = $data->name;
            $userValues['job_role']       = $data->jobRole;

            $user = $this->userService->createOrUpdateUser($userValues);

            $this->refundsService->createRefund($data, $user);

            $this->response['mensagem'] = 'Reembolso inserido com sucesso!';

        } catch (RefundsNotFoundException $exception) {
            return $this->buildResponseError($exception, HttpResponse::HTTP_BAD_REQUEST);
        }
        return Response::json($this->response, HttpResponse::HTTP_OK);
    }

    public function update(RefundsUpdateRequest $request)
    {
        try {
            $data                      = new Fluent($request->all());
            $filter ['identification'] = $data->identification;
            $this->refundsService->updateRefund($data);
            $this->response['mensagem'] = 'Reembolso atualizado com sucesso!';
        } catch (NotFoundHttpException $exception) {
            return $this->buildResponseError($exception, HttpResponse::HTTP_BAD_REQUEST);
        }

        return Response::json($this->response, HttpResponse::HTTP_OK);
    }

    public function delete($id)
    {
        try {
            $refund = $this->refundsService->findRefundBy(['id' => $id]);
            $this->refundsService->deleteRefund($refund);
            $this->response['mensagem'] = 'Reembolso excluído com sucesso!';
        } catch (NotFoundHttpException $exception) {
            return $this->buildResponseError($exception, HttpResponse::HTTP_BAD_REQUEST);
        }

        return Response::json($this->response, HttpResponse::HTTP_OK);
    }

    public function report(ReportRequest $request)
    {
        try {
            $values = new Fluent($request->all());

            $filters['year']  = $values->year;
            $filters['month'] = $values->month;

            $refunds = $this->refundsService->report($filters);

            if ($refunds->count()) {
                $this->response['dados'] = new ReportResourceCollection($refunds);
                return Response::json($this->response, HttpResponse::HTTP_OK);
            } else {
                $this->response['mensagem'] = 'Nenhum reembolso encontrado para o período!';
            }


        } catch (NotFoundHttpException $exception) {
            return $this->buildResponseError($exception, HttpResponse::HTTP_BAD_REQUEST);
        }

        return Response::json($this->response, HttpResponse::HTTP_OK);
    }
}
