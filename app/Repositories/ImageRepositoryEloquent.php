<?php

namespace App\Repositories;

use App\Entities\Common\Constant;
use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\ImageRepository;
use App\Entities\Image;

/**
 * Class ImageRepositoryEloquent
 * @package namespace App\Repositories;
 */
class ImageRepositoryEloquent extends BaseRepository implements ImageRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Image::class;
    }

    

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }

    public function getImageList($currentPage, $pageSize)
    {
        $pageSize = $pageSize < Constant::MAX_PAGE_SIZE ? $pageSize : Constant::MAX_PAGE_SIZE;
        return $this->model->orderBy('id', 'DESC')->paginate($pageSize, Image::LIST_KEY, Image::PAGE_NAME, $currentPage);
    }

    public function getHomeData($count)
    {
        return $this->model->orderBy('id', 'DESC')->limit($count)->get();
    }
}
