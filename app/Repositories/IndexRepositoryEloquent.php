<?php

namespace App\Repositories;

use App\Entities\Common\Constant;
use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\IndexRepository;
use App\Entities\Index;

/**
 * Class IndexRepositoryEloquent
 * @package namespace App\Repositories;
 */
class IndexRepositoryEloquent extends BaseRepository implements IndexRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Index::class;
    }

    

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }

    public function getIndexConf()
    {
        return $this->model->where('status', Constant::VALID_STATUS)->get();
    }
}
