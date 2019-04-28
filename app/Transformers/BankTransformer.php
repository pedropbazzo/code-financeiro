<?php

namespace CodeFinance\Transformers;

use League\Fractal\TransformerAbstract;
use CodeFinance\Models\Bank;

/**
 * Class BankTransformer.
 *
 * @package namespace CodeFinance\Transformers;
 */
class BankTransformer extends TransformerAbstract
{
    /**
     * Transform the Bank entity.
     *
     * @param \CodeFinance\Models\Bank $model
     *
     * @return array
     */
    public function transform(Bank $model)
    {
        return [
            'id'         => (int) $model->id,

            /* place your other model properties here */

            'created_at' => $model->created_at,
            'updated_at' => $model->updated_at
        ];
    }
}
