<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\ArticleService;

class ArticleController extends Controller
{
    protected $articleService;

    public function __construct(ArticleService $articleService)
    {
        $this->articleService = $articleService;
    }

    public function detail(Request $request, $id)
    {
        $detail = $this->articleService->getArticleDetailById($id);
        if (empty($detail)) {
            return abort(404);
        }
        return view('article', $detail);
    }
}
