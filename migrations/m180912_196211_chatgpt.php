<?php

/**
 * Generation migrate by PIXELION CMS
 * @author PIXELION CMS development team <dev@pixelion.com.ua>
 *
 * Class m180912_196211_chatgpt
 */

use panix\mod\chatgpt\models\ChatGPT;
use panix\engine\db\Migration;

class m180912_196211_chatgpt extends Migration
{

    /**
     * {@inheritdoc}
     */
    public function up()
    {
        $this->createTable(ChatGPT::tableName(), [
            'id' => $this->primaryKey()->unsigned(),
            'user_id' => $this->integer()->unsigned(),
            'prompt' => $this->text(),
            'temperature' => $this->float(2)->null(),
            'max_tokens' => $this->integer()->null(),
            'n' => $this->integer()->null()->defaultValue(1),
            'frequency_penalty' => $this->float(2)->null(),
            'presence_penalty' => $this->float(2)->null(),
            'result' => $this->text(),
            'created_at' => $this->integer(11)->null(),
        ]);


        $this->createIndex('user_id', ChatGPT::tableName(), 'user_id');
    }

    /**
     * {@inheritdoc}
     */
    public function down()
    {
        $this->dropTable(ChatGPT::tableName());
    }

}
