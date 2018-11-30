<?php

namespace App\Repositories;

use App\Entities\Common\Constant;
use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\VideoRepository;
use App\Entities\Video;

/**
 * Class VideoRepositoryEloquent
 * @package namespace App\Repositories;
 */
class VideoRepositoryEloquent extends BaseRepository implements VideoRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Video::class;
    }

    

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }

    public function getVideoList($currentPage, $pageSize, $type)
    {
        $pageSize = $pageSize < Constant::MAX_PAGE_SIZE ? $pageSize : Constant::MAX_PAGE_SIZE;
        return $this->model->where('type', $type)->orderBy('id', 'DESC')
            ->paginate($pageSize, Video::LIST_KEY, Video::PAGE_NAME, $currentPage);
    }

    public function getHomeData($type, $count)
    {
        return $this->model->where('type', $type)->orderBy('id', 'DESC')->limit($count)->get();
    }
}
