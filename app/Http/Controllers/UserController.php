<?php
declare(strict_types = 1);

namespace App\Http\Controllers;

use App\Article;
use App\Http\Requests\UserRequest;
use App\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Collection;
use Intervention\Image\Facades\Image;

/**
 * Class UserController
 * @package App\Http\Controllers
 */
class UserController extends Controller
{
    /**
     * @param $user_id
     * @return void
     */
    public function experience($user_id)
    {
        $user = User::find($user_id);

        return ;
    }

    /**
     * @param Article $article
     * @return Collection
     */
    public function getArticleUsers(Article $article): Collection
    {
        return Article::getUsers($article);
    }

    /**
     * @return Collection
     */
    public function index(): Collection
    {
        return User::with('articles')->get();
    }

    /**
     * @param UserRequest $request
     *
     * @return RedirectResponse
     */
    public function store(UserRequest $request)
    {
        $avatar = time() . '.' . $request->image->getClientOriginalExtension();
        $location = public_path('images/' . $avatar);
        Image::make($request->image)->resize(300, 200)->save($location);

        $request['sex'] = $request['male'] ?  'male' : 'female';
        $request['avatar'] = $avatar;

        $user = User::create($request->all());

        return view('index', compact('user'));
    }
}
