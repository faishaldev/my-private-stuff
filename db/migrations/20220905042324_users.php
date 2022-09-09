<?php
declare(strict_types=1);

use Phinx\Migration\AbstractMigration;

final class Users extends AbstractMigration
{
    public function change(): void
    {
        $users = $this->table('users', ['id' => false, 'primary_key' => ['id']]);
        $users
            ->addColumn('id', 'string', ['limit' => 50, 'null' => false])
            ->addColumn('role_id', 'string', ['limit' => 50, 'null' => true])
            ->addForeignKey('role_id', 'roles', 'id', ['delete' => 'SET_NULL', 'update' => 'NO_ACTION'])
            ->addColumn('username', 'string', ['limit' => 50, 'null' => false])
            ->addColumn('fullname', 'text', ['null' => false])
            ->addColumn('email', 'string', ['limit' => 50, 'null' => false])
            ->addIndex(['username', 'email'], ['unique' => true])
            ->addColumn('password', 'text', ['null' => false])
            ->addColumn('phonenumber', 'string', ['limit' => 12, 'null' => false])
            ->addColumn('address', 'text', ['null' => false])
            ->addColumn('is_active', 'boolean', ['null' => false, 'default' => false])
            ->addColumn('created_at', 'text', ['null' => false])
            ->addColumn('updated_at', 'text', ['null' => false])
            ->addColumn('is_deleted', 'boolean', ['null' => false, 'default' => false])
            ->create();
    }
}
