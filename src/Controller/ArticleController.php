<?php

namespace Src\Controller;

use App\Controller;
use Src\Repository\ArticleRepository;

class ArticleController extends Controller {

    /**
     * @var ArticleRepository $articleRepository
     */
    private $articleRepository;

    public function __construct()
    {
        $this->articleRepository = new ArticleRepository();
    }
    
    public function index(){

        $articles   = $this->articleRepository->findAll();
        $aaa   = $this->articleRepository->find(1111);

        return $this->renderView('articles.html.twig', [
            'articles' => $articles,
        ]);
    }
}