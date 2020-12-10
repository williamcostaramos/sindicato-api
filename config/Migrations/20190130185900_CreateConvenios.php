<?php
use Migrations\AbstractMigration;

class CreateConvenios extends AbstractMigration
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
        $table = $this->table('convenios');
        
        $table->addColumn('texto', 'text', [
            'default' => null,
            'null' => false,
        ]);
        
        $table->addColumn('urlImg', 'string', [
            'default' => null,
            'limit' => 255,
            'null' => false
        ]);
        
        $table->create();
    }
}
