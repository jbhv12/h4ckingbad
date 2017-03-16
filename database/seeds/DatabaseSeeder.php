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
      $this->call('ProblemsTableSeeder');
      $this->call('CategoriesTableSeeder');
    }
}
class UserTableSeeder extends Seeder
{
public function run()
{
    DB::table('users')->delete();
    User::create(array(
        'name'     => 'test',
        'email'    => 'test@test.com',
        'password' => Hash::make('test'),
    ));
}
}
class ProblemsTableSeeder extends Seeder
{
public function run()
{
  $sampleHintArray = array(10,20);
    DB::table('problems')->delete();
    DB::table('problems')->insert([
        'id'     => 1,
        'name'    => 'pname',
        'categoryid' => 1,
        'abstract' => 'varta',
        'hintArray' => serialize($sampleHintArray),
        'flag' => 'xxx',
        'points' => 100,
        'problemPageUrl' => '/',
        'downloadableFilePath' => '/tmp'
    ]);
}
}
class CategoriesTableSeeder extends Seeder
{
public function run()
{
    DB::table('categories')->delete();
    DB::table('categories')->insert([
        'id'     => 1,
        'name'    => 'web',
    ]);
}
}
