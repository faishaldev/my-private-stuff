<?php


use Phinx\Seed\AbstractSeed;

class Categories extends AbstractSeed
{
    public function run()
    {
        $data = array(
            array(
                'id' => 'category-123',
                'user_id' => 'user-234',
                'name' => 'Books',
                'description' => 'My favorite books list',
                'created_at' => '2022',
                'updated_at' => '2022'
            ),
            array(
                'id' => 'category-234',
                'user_id' => 'user-345',
                'name' => 'Electronics',
                'description' => 'My favorite electronics list',
                'created_at' => '2022',
                'updated_at' => '2022'
            ),
            array(
                'id' => 'category-345',
                'user_id' => 'user-345',
                'name' => 'Kitchenware',
                'description' => 'My favorite kitchenware list',
                'created_at' => '2022',
                'updated_at' => '2022'
            ),
            array(
                'id' => 'category-456',
                'user_id' => 'user-456',
                'name' => 'Clothes',
                'description' => 'My favorite clothes list',
                'created_at' => '2022',
                'updated_at' => '2022'
            ),
            array(
                'id' => 'category-567',
                'user_id' => 'user-456',
                'name' => 'Offices',
                'description' => 'My favorite offices list',
                'created_at' => '2022',
                'updated_at' => '2022'
            ),
            array(
                'id' => 'category-678',
                'user_id' => 'user-456',
                'name' => 'Bags',
                'description' => 'My favorite bags list',
                'created_at' => '2022',
                'updated_at' => '2022'
            )
        );
        
        $categories = $this->table('categories');
        
        $categories->insert($data)->save();
    }
}
