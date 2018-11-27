<?php

namespace App\Services;

use App\Repositories\ArticleRepository;

class ArticleService {

    protected $articleRepository;

    public function __construct(ArticleRepository $articleRepository)
    {
        $this->articleRepository = $articleRepository;
    }

    public function getArticleDetailById($id)
    {
        return $this->articleRepository->getArticleDetailById($id);
    }
}