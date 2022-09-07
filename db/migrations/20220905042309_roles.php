<?php
declare(strict_types=1);

use Phinx\Migration\AbstractMigration;

final class Roles extends AbstractMigration
{
    public function change(): void
    {
        $roles = $this->table('roles', ['id' => false, 'primary_key' => ['id']]);
        $roles
            ->addColumn('id', 'string', ['limit' => 50, 'null' => false])
            ->addColumn('name', 'string', ['limit' => 50, 'null' => false])
            ->addColumn('description', 'text')
            ->create();
    }
}
