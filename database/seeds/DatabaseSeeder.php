<?php

use Illuminate\Database\Seeder;
use Illuminate\Foundation\Auth\User;
class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      $this->call('UserTableSeeder');
      //   $this->call(UsersTableSeeder::class);
    }
}
class UserTableSeeder extends Seeder
{

public function run()
{
    DB::table('users')->delete();
    User::create(array(
        'name'     => 'test',
      //  'username' => 'asdf',
        'email'    => 'test@test.com',
        'password' => Hash::make('test'),
    ));
}

}
