<?php
use Migrations\AbstractMigration;

class ModifyEmpresa extends AbstractMigration
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
        $table = $this->table('empresa');
        
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
        
        $table->addColumn('tokenFirebase', 'string', [
            'default' => null,
            'limit' => 255,
            'null' => true,
        ]);
        
        $table->update();
    }
}
