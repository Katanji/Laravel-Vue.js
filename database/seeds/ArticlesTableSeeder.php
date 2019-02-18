<?php

use Illuminate\Database\Seeder;

class ArticlesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = App\User::all()->pluck('id')->toArray();

        factory(App\Article::class, 10)->create()->each(function ($article) use ($users) {
            $article->users()->attach(array_random($users, rand(1, 3)));
        });
    }
}
