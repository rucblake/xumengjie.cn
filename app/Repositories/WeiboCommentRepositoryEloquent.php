<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\WeiboCommentRepository;
use App\Entities\WeiboComment;
use App\Validators\WeiboCommentValidator;

/**
 * Class WeiboCommentRepositoryEloquent
 * @package namespace App\Repositories;
 */
class WeiboCommentRepositoryEloquent extends BaseRepository implements WeiboCommentRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return WeiboComment::class;
    }

    

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }

    public function getCount($mid)
    {
        if (empty($mid)) {
            return $this->model->count();
        } else {
            return $this->model->where('mid', '=', $mid)->count();
        }
    }
}
