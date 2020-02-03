<?php

namespace App\Domain\Repositories;


use App\Domain\Entities\Refunds;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\DB;

class RefundsRepository extends RepositoryAbstract
{
    protected $model = Refunds::class;

    public function allRefunds()
    {
        return $this->createModel();
    }

    public function findRefundBy(array $filter): Builder
    {
        return $this->createModel()->where($filter);
    }

    public function updateRefund($refund)
    {
        $this->createModel()
            ->where('id', $refund->refund['id'])
            ->update(['value' => $refund->refund['value']]);
    }

    public function report(array $filters)
    {
        $builder = $this->createModel()->select([
            'users.name',
            'users.identification',
            DB::raw(' SUM(value) as totalRefunds'),
            DB::raw(' count(*) as refunds'),
        ])
            ->join('users', 'users.id', '=', 'refunds.user_id')
            ->whereRaw("YEAR(date) = {$filters['year']} AND MONTH(date) = {$filters['month']}")
            ->groupBy('users.id', 'users.name');

        return $builder->get();
    }
}
