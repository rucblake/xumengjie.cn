<?php

namespace App\Repositories;

use Illuminate\Support\Facades\DB;
use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\WeiboUserRepository;
use App\Entities\WeiboUser;
use App\Validators\WeiboUserValidator;

/**
 * Class WeiboUserRepositoryEloquent
 * @package namespace App\Repositories;
 */
class WeiboUserRepositoryEloquent extends BaseRepository implements WeiboUserRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return WeiboUser::class;
    }

    

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }

    public function getCommentCount()
    {
        return $this->model->withCount('weiboComments')->get()->toArray();
    }

    public function clearFailures()
    {
        return $this->model->where('failed_time', '>', 0)->update(['failed_time' => 0]);
    }
}
