<?php

namespace App\Repositories;

use App\Entities\Common\Constant;
use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\ArticleRepository;
use App\Entities\Article;

/**
 * Class ArticleRepositoryEloquent
 * @package namespace App\Repositories;
 */
class ArticleRepositoryEloquent extends BaseRepository implements ArticleRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Article::class;
    }

    

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }

    public function getArticleDetailById($id)
    {
        return $this->model->where([
            'id' => $id,
            'status' => Constant::VALID_STATUS,
        ])->first();
    }
}
