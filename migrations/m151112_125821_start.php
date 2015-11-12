<?php

use yii\db\Schema;
use yii\db\Migration;

class m151112_125821_start extends Migration
{
    public function up()
    {
        $this->createTable('content', [
            'id' => Schema::TYPE_PK,
            'title' => Schema::TYPE_TEXT . ' NOT NULL',
            'body' => Schema::TYPE_TEXT . ' NOT NULL',
            'surl_id' => Schema::TYPE_INTEGER . ' NOT NULL'
        ]);
        $this->createTable('surl', [
            'id' => Schema::TYPE_PK,
            'name' => Schema::TYPE_TEXT . ' NOT NULL',
            'content_id' => Schema::TYPE_INTEGER . ' NOT NULL'
        ]);
    }

    public function down()
    {
        $this->dropTable('content');
        $this->dropTable('surl');
    }

    /*
    // Use safeUp/safeDown to run migration code within a transaction
    public function safeUp()
    {
    }

    public function safeDown()
    {
    }
    */
}
