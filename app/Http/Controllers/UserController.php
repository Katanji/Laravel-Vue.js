<?php
declare(strict_types = 1);

namespace App\Http\Controllers;

use App\Article;
use App\Http\Requests\UserRequest;
use App\Jobs\UpdateUserExperienceJob;
use App\User;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Collection;
use Intervention\Image\Facades\Image;

/**
 * Class UserController
 * @package App\Http\Controllers
 */
class UserController extends Controller
{
    /**
     * @return array
     */
    public function getExperience(): array
    {
        $user = User::find(request()->get('user_id'));

        request()->get('repeatRequest') === 'true' ?: UpdateUserExperienceJob::dispatch($user);

        return ['experience' => $user->experience];
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
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function store(UserRequest $request): View
    {
        $avatar = time() . '.' . $request->image->getClientOriginalExtension();
        $location = public_path('images/' . $avatar);
        Image::make($request->image)->resize(300, 200)->save($location);

        $request['sex'] = $request['male'] ?  'male' : 'female';
        $request['avatar'] = $avatar;

        $user = User::create($request->all());

        return view('profile', compact('user'));
    }
}
