<?php


use Phinx\Seed\AbstractSeed;

class Roles extends AbstractSeed
{
    public function run()
    {
        $data = array(
            array(
                'id' => 'role-123',
                'name' => 'Admin',
                'description' => 'Full access user'
            ),
            array(
                'id' => 'role-234',
                'name' => 'User',
                'description' => 'Restricted access user'
            )
        );

        $roles = $this->table('roles');
        
        $roles->insert($data)->save();
    }
}
