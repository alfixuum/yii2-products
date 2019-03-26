<?php

use yii\db\Migration;


class m190322_063040_create_products extends Migration
{

    public function Up()
    {
        $this->createTable('products', [
            'id' => $this->primaryKey(),
            'title' => $this->string(),
            'category' => $this->string(),
            'price' => $this->decimal(5),
            'description' => $this->text(),
            'image' => $this->string(),
            'user_id' => $this->integer()
        ]);
    }


    public function Down()
    {
        $this->dropTable('products');
    }
};

