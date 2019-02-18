<?php
declare(strict_types = 1);

namespace App\Http\Controllers;

use App\Article;
use App\User;
use Illuminate\Support\Collection;

/**
 * Class ArticleController
 * @package App\Http\Controllers
 */
class ArticleController extends Controller
{
    /**
     * @param User $user
     * @return \Illuminate\Support\Collection
     */
    public function getUserArticles(User $user): Collection
    {
        return User::getArticles($user);
    }

    /**
     * @return Collection
     */
    public function index(): Collection
    {
        return Article::with('users')->get();
    }

    /**
     * @param $article_id
     * @param User $user
     * @return string
     *
     * @throws \Illuminate\Session\TokenMismatchException
     */
    public function isAuthor($article_id, User $user): string
    {
        $isAuthor = Article::isAuthor($article_id, $user);

        if(is_null($isAuthor)) {
            return 'null';
        };

        return $isAuthor === true ? 'true' : 'false';
    }
}
