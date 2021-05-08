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
        $limeGreen = '#32cd32';
        $user1 = [
            'username' => 'nellyt',
            'password' => password_hash('password', PASSWORD_DEFAULT),
            'email' => 'nialltiernan93@gmail.com',
            'color' => '' . $limeGreen . '',
        ];

        $user2 = [
            'username' => 'john',
            'password' => password_hash('johndoe', PASSWORD_DEFAULT),
            'email' => 'johndoe@gmail.com',
            'color' => '#ff0000',

        ];

        $data = [$user1, $user2];

        $table = $this->table('users');

        $table->insert($data)->save();
    }
}
