<?php
use Migrations\AbstractMigration;

class CreatePublicidade extends AbstractMigration
{
    /**
     * Change Method.
     *
     * More information on this method is available here:
     * http://docs.phinx.org/en/latest/migrations.html#the-change-method
     * @return void
     */
    public function change()
    {
        $table = $this->table('publicidade');
        
        $table->addColumn('urlImg', 'string', [
            'default' => null,
            'limit' => 255,
            'null' => false,
        ]);
        
        $table->addColumn('created', 'datetime', [
            'default' => null,
            'null' => false,
        ]);
        
        $table->create();
    }
}
