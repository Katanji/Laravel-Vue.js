<?php
declare(strict_types = 1);

namespace App;

use Illuminate\Support\Collection;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'nickname',
        'surname',
        'avatar',
        'phone',
        'sex',
        'newsletter_agree',
        'experience',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * @return BelongsToMany
     */
    public function articles(): BelongsToMany
    {
        return $this->BelongsToMany(Article::class);
    }

    /**
     * @param User $user
     * @return Collection
     */
    public static function getArticles(User $user): Collection
    {
        return collect($user->articles);
    }
}
