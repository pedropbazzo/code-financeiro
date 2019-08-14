<?php

namespace CodeFinance\Repositories;

use CodeFinance\Events\BankStoredEvent;
use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use CodeFinance\Repositories\BankRepository;
use CodeFinance\Models\Bank;
use CodeFinance\Validators\BankValidator;

/**
 * Class BankRepositoryEloquent.
 *
 * @package namespace CodeFinance\Repositories;
 */
class BankRepositoryEloquent extends BaseRepository implements BankRepository
{

    public function create(array $attributes)
    {
        $logo = $attributes['logo'];
        $attributes['logo'] = "semimagem.jpeg";

        $model = parent::create($attributes);

        // Criando um novo evento
        $event = new BankStoredEvent($model, $logo);
        event($event);

        return $model;
    }

    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Bank::class;
    }

    /**
    * Specify Validator class name
    *
    * @return mixed
    */
    public function validator()
    {

        return BankValidator::class;
    }


    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
    
}
