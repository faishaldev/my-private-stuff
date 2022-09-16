<?php


use Phinx\Seed\AbstractSeed;

class Stuffs extends AbstractSeed
{
    public function run()
    {
        $data = array(
            array(
                'id' => 'stuff-123',
                'category_id' => 'category-123',
                'user_id' => 'user-234',
                'name' => 'Amazing You!',
                'description' => 'Resep Rahasia Kehidupan Luar Biasa',
                'created_at' => date('c'),
                'updated_at' => date('c')
            ),
            array(
                'id' => 'stuff-234',
                'category_id' => 'category-234',
                'user_id' => 'user-345',
                'name' => 'Fan',
                'description' => 'Mini Stand Cosmos Fan',
                'created_at' => date('c'),
                'updated_at' => date('c')
            ),
            array(
                'id' => 'stuff-345',
                'category_id' => 'category-345',
                'user_id' => 'user-345',
                'name' => 'Stove',
                'description' => 'E-lux Induction Stove',
                'created_at' => date('c'),
                'updated_at' => date('c')
            ),
            array(
                'id' => 'stuff-456',
                'category_id' => 'category-456',
                'user_id' => 'user-456',
                'name' => 'Clothes',
                'description' => 'Flanel Cloth',
                'created_at' => date('c'),
                'updated_at' => date('c')
            ),
            array(
                'id' => 'stuff-567',
                'category_id' => 'category-567',
                'user_id' => 'user-456',
                'name' => 'Pen',
                'description' => 'Standard Pen',
                'created_at' => date('c'),
                'updated_at' => date('c')
            ),
            array(
                'id' => 'stuff-678',
                'category_id' => 'category-678',
                'user_id' => 'user-456',
                'name' => "Laptop's Bag",
                'description' => "Lenovo Laptop's Bag",
                'created_at' => date('c'),
                'updated_at' => date('c')
            )
        );

        $stuffs = $this->table('stuffs');
        
        $stuffs->insert($data)->save();
    }
}
