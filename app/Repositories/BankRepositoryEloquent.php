<?php

namespace CodeFinance\Repositories;

use CodeFinance\Events\BankStoredEvent;
use Illuminate\Http\UploadedFile;
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

        // Dispara o nosso evento
        $event = new BankStoredEvent($model, $logo);
        event($event);

        return $model;
    }

    public function update(array $attributes, $id)
    {
        $logo = null;
        if(isset($attributes['logo']) && $attributes['logo'] instanceof  UploadedFile) {
            $logo = $attributes['logo'];
            unset($attributes['logo']);
        }

        $model = parent::update($attributes, $id);

        // Dispara o nosso evento
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
