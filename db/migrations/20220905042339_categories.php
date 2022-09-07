<?php
declare(strict_types=1);

use Phinx\Migration\AbstractMigration;

final class Categories extends AbstractMigration
{
    public function change(): void
    {
        $categories = $this->table('categories', ['id' => false, 'primary_key' => ['id']]);
        $categories
            ->addColumn('id', 'string', ['limit' => 50, 'null' => false])
            ->addColumn('user_id', 'string', ['limit' => 50, 'null' => true])
            ->addForeignKey('user_id', 'users', 'id', ['delete' => 'SET_NULL', 'update' => 'NO_ACTION'])
            ->addColumn('name', 'text', ['null' => false])
            ->addColumn('description', 'text')
            ->addColumn('created_at', 'text', ['null' => false])
            ->addColumn('updated_at', 'text', ['null' => false])
            ->create();
    }
}
