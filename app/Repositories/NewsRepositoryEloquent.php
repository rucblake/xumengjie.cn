<?php

namespace App\Repositories;

use App\Entities\Common\Constant;
use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\NewsRepository;
use App\Entities\News;

/**
 * Class NewsRepositoryEloquent
 * @package namespace App\Repositories;
 */
class NewsRepositoryEloquent extends BaseRepository implements NewsRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return News::class;
    }

    

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }

    public function getNewsList($currentPage, $pageSize)
    {
        $pageSize = $pageSize < Constant::MAX_PAGE_SIZE ? $pageSize : Constant::MAX_PAGE_SIZE;
        return $this->model->orderBy('id', 'DESC')->paginate($pageSize, News::LIST_KEY, News::PAGE_NAME, $currentPage);
    }

    public function getHomeData($count)
    {
        return $this->model->orderBy('id', 'DESC')->limit($count)->get();
    }
}
