<?php

namespace App\Domain\Services;

use App\Domain\Entities\Refunds;
use App\Domain\Entities\User;
use App\Exceptions\RefundsNotFoundException;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Fluent;
use Symfony\Component\HttpFoundation\Response as HttpResponse;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class RefundsService extends ServiceAbstract
{
    public function all()
    {
        return $this->refundsRepository->allRefunds();
    }

    public function createRefund($attribute, $user): Model
    {
        foreach ($attribute->refunds as $key => $refund) {
            $refund = $this->refundsRepository->create($this->populateRefund($refund, $user));
        }

        return $refund;
    }

    public function populateRefund($refund, $user)
    {
        $data['user_id']     = $user->id;
        $data['date']        = Carbon::parse($refund['date']);
        $data['type']        = $refund['type'];
        $data['description'] = $refund['description'];
        $data['value']       = $refund['value'];

        return $data;
    }

    public function findRefundBy($filter): Refunds
    {
        $refund = $this->refundsRepository->findRefundBy($filter)->first();

        if (!$refund instanceof Refunds) {
            throw new NotFoundHttpException('Reembolso não encontrado.');
        }

        return $refund;
    }

    public function updateRefund($refund)
    {
        $this->refundsRepository->updateRefund($refund);
    }

    public function deleteRefund(Refunds $refund)
    {
        $this->refundsRepository->delete($refund);
    }

    public function report($filters)
    {
        return $this->refundsRepository->report($filters);
    }
}
