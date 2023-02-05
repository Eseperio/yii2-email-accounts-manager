<?php

use yii\db\Migration;

/**
 * Class m230131_101948_add_email_accounts_table
 */
class m230131_101948_add_email_accounts_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {

//        Create a table with all the fields that you need to store the email accounts
        $this->createTable('{{%email_account}}', [
            'id' => $this->primaryKey(),
            'address' => $this->string(255)->notNull(),
            'user' => $this->string(255)->notNull(),
            'password' => $this->string(255)->notNull(),
            'outgoing_server' => $this->string(255)->notNull()->comment('Outgoing server'),
            'incoming_server' => $this->string(255)->notNull()->comment('Incoming server'),
            'imap_port' => $this->integer()->notNull()->defaultValue(993)->comment('IMAP port'),
            'smtp_port' => $this->integer()->notNull()->defaultValue(465)->comment('SMTP port'),
            'smtp_encryption' => $this->string(255)->notNull()->defaultValue('SSL'),
            'imap_encryption' => $this->string(255)->notNull()->defaultValue('SSL'),
            'smtp_validate_cert' => $this->boolean()->notNull()->defaultValue(1),
            'imap_validate_cert' => $this->boolean()->notNull()->defaultValue(1),
            'sent_folder' => $this->string(255)->defaultValue('Sent')->comment('Sent folder'),
            'inbox_folder' => $this->string(255)->defaultValue('INBOX')->comment('Inbox folder'),
            'draft_folder' => $this->string(255)->defaultValue('Drafts')->comment('Draft folder'),
            'trash_folder' => $this->string(255)->defaultValue('Trash')->comment('Trash folder'),
        ]);


    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%email_account}}');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m230131_101948_add_email_accounts_table cannot be reverted.\n";

        return false;
    }
    */
}
