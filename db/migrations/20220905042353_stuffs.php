<?php
declare(strict_types=1);

use Phinx\Migration\AbstractMigration;

final class Stuffs extends AbstractMigration
{
    public function change(): void
    {
        $stuffs = $this->table('stuffs', ['id' => false, 'primary_key' => ['id']]);
        $stuffs
            ->addColumn('id', 'string', ['limit' => 50, 'null' => false])
            ->addColumn('category_id', 'string', ['limit' => 50, 'null' => true])
            ->addForeignKey('category_id', 'categories', 'id', ['delete' => 'SET_NULL', 'update' => 'NO_ACTION'])
            ->addColumn('user_id', 'string', ['limit' => 50, 'null' => true])
            ->addForeignKey('user_id', 'users', 'id', ['delete' => 'SET_NULL', 'update' => 'NO_ACTION'])
            ->addColumn('name', 'text', ['null' => false])
            ->addColumn('description', 'text')
            ->addColumn('is_allow_borrowed', 'boolean', ['null' => false, 'default' => false])
            ->addColumn('created_at', 'text', ['null' => 'false'])
            ->addColumn('updated_at', 'text', ['null' => 'false'])
            ->create();
    }
}
