<?php


use Phinx\Seed\AbstractSeed;

class UserSeeder extends AbstractSeed
{
    /**
     * Run Method.
     *
     * Write your database seeder using this method.
     *
     * More information on writing seeders is available here:
     * https://book.cakephp.org/phinx/0/en/seeding.html
     */
    public function run()
    {
        $user1 = [
            'username' => 'nellyt',
            'password' => 'pass',
            'email' => 'nialltiernan93@gmail.com',
        ];

        $user2 = [
            'username' => 'john',
            'password' => 'johndoe',
            'email' => 'johndoe@gmail.com',
        ];

        $data = [$user1, $user2];

        $table = $this->table('users');

        $table->insert($data)->save();
    }
}
