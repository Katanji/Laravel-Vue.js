<?php
declare(strict_types = 1);

namespace App\Http\Controllers;

use App\Article;
use App\Http\Requests\UserRequest;
use App\Jobs\UpdateUserExperience;
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
     * @return int
     */
    public function getExperience(): int
    {
        $userExperience = User::find(1)->experience;

        UpdateUserExperienceJob::dispatch('');

//        \Artisan::call('update:userexperience');

        return $userExperience;
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
     * @param User $user
     * @return User
     */
    public function show(User $user): User
    {
        return $user;
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
