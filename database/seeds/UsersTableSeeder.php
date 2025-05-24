<?php

use App\Thread;
use App\User;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(User::class, 5)->create()->each(function($user) {
            $thread = factory(Thread::class, 3)->make();
            $user->threads()->saveMany($thread);
        });
    }
}
