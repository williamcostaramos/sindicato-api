<?php
use Migrations\AbstractMigration;

class ModifyAssociado extends AbstractMigration
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
        
        $table->addColumn('senha', 'string', [
            'default' => null,
            'limit' => 255,
            'null' => true
        ]);
        
        $table->addColumn('dataExpiracao', 'datetime', [
            'default' => null,
            'limit' => null,
            'null' => true
        ]);
        
        $table->addColumn('avaliado', 'boolean', [
            'default' => null,
            'limit' => null,
            'null' => true,
        ]);
        
        $table->addColumn('termoAceito', 'boolean', [
            'default' => null,
            'limit' => null,
            'null' => true
        ]);
        
        $table->addColumn('tokenFirebase', 'string', [
            'default' => null,
            'limit' => 255,
            'null' => true,
        ]);
        
        $table->update();
    }
}
