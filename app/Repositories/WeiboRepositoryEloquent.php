<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\WeiboRepository;
use App\Entities\Weibo;
use App\Validators\WeiboValidator;

/**
 * Class WeiboRepositoryEloquent
 * @package namespace App\Repositories;
 */
class WeiboRepositoryEloquent extends BaseRepository implements WeiboRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Weibo::class;
    }

    

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }

    public function getMidsByUid($uid)
    {
        return $this->model->where(['uid' => $uid])->pluck('mid')->toArray();
    }

    public function getFirstWeibo($uid)
    {
        return $this->model->where(['uid' => $uid])->orderBy('mid', 'DESC')->first();
    }
}
