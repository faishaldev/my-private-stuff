<?php


use Phinx\Seed\AbstractSeed;

class Users extends AbstractSeed
{
    public function run()
    {
        $data = array(
            array(
                'id' => 'user-123',
                'role_id' => 'role-123',
                'username' => 'admin',
                'email' => 'admin@mail.com',
                'password' => 'password-123',
                'fullname' => 'Admin',
                'phonenumber' => '81234567891',
                'address' => 'Semarang',
                'is_active' => true,
                'created_at' => '2022',
                'updated_at' => '2022'
            ),
            array(
                'id' => 'user-234',
                'role_id' => 'role-234',
                'username' => 'musshal',
                'email' => 'musshal@mail.com',
                'password' => 'password-234',
                'fullname' => 'Musthafa Faishal',
                'phonenumber' => '82345678910',
                'address' => 'Semarang',
                'is_active' => true,
                'created_at' => '2022',
                'updated_at' => '2022'
            ),
            array(
                'id' => 'user-345',
                'role_id' => 'role-234',
                'username' => 'fadkim',
                'email' => 'fadkim@mail.com',
                'password' => 'password-345',
                'fullname' => 'Fadlil Khakim',
                'phonenumber' => '83456789101',
                'address' => 'Semarang',
                'is_active' => true,
                'created_at' => '2022',
                'updated_at' => '2022'
            ),
            array(
                'id' => 'user-456',
                'role_id' => 'role-234',
                'username' => 'erriz',
                'email' => 'erriz@mail.com',
                'password' => 'password-456',
                'fullname' => 'Erwin Rizqi',
                'phonenumber' => '84567891012',
                'address' => 'Semarang',
                'created_at' => '2022',
                'updated_at' => '2022'
            )
        );

        $users = $this->table('users');
        $users->insert($data)->save();
    }
}
