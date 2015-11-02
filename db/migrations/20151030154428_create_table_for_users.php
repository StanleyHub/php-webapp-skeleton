<?php

use Phinx\Migration\AbstractMigration;

class CreateTableForUsers extends AbstractMigration
{
    /**
     * Change Method.
     *
     * Write your reversible migrations using this method.
     *
     * More information on writing migrations is available here:
     * http://docs.phinx.org/en/latest/migrations.html#the-abstractmigration-class
     *
     * The following commands can be used in this method and Phinx will
     * automatically reverse them when rolling back:
     *
     *    createTable
     *    renameTable
     *    addColumn
     *    renameColumn
     *    addIndex
     *    addForeignKey
     *
     * Remember to call "create()" or "update()" and NOT "save()" when working
     * with the Table class.
     */
    public function change()
    {
        $table = $this->table("users");
        $table->addColumn('username', 'string', array('limit' => 64))
            ->addColumn('password', 'string', array('limit' => 256))
            ->addColumn('email', 'string', array('limit' => 100))
            ->addColumn('created_at', 'datetime')
            ->addColumn('updated_at', 'datetime')
            ->addIndex(array('username', 'email'), array('unique' => true))
            ->create();
    }
}
