<?php
declare(strict_types = 1);

namespace App;

use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use Illuminate\Session\TokenMismatchException;
use Illuminate\Support\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Article
 * @package App
 */
class Article extends Model
{
    use Notifiable, SoftDeletes;

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['deleted_at'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['text'];

    /**
     * @return BelongsToMany
     */
    public function users(): BelongsToMany
    {
        return $this->BelongsToMany(User::class);
    }

    /**
     * @param Article $article
     * @return Collection
     */
    public static function getUsers(Article $article): Collection
    {
        return collect($article->users);
    }

    /**
     * @param $article_id
     * @param User $user
     * @return bool|null
     *
     * @throws TokenMismatchException
     */
    public static function isAuthor($article_id, $user)
    {
        if (!is_a($user, 'App\User')) {
            throw new TokenMismatchException;
        }

        if (Article::withTrashed()->find($article_id) === null || Article::withTrashed()->find($article_id)->trashed()) {
            $isAuthor = null;
        } else {
            $isAuthor = $user->articles->contains('id', $article_id);
        }

        if (!is_bool($isAuthor) && !is_null($isAuthor)) {
            throw new TokenMismatchException;
        } else {
            return $isAuthor;
        }
    }
}
