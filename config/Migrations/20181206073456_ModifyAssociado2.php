<?php
use Migrations\AbstractMigration;

class ModifyAssociado2 extends AbstractMigration
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
        $table = $this->table('associado');
        
        $table->addColumn('freelancer', 'boolean', [
            'default' => null,
            'limit' => null,
            'null' => true,
        ]);
        
        $table->update();
    }
}
