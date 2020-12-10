<?php
use Migrations\AbstractMigration;

class CreateEmpresaPagamentos extends AbstractMigration
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
        $table = $this->table('empresa_pagamentos');
        
        $table->addColumn('dataPagamento', 'datetime', [
            'default' => null,
            'null' => false,
        ]);
        
        $table->addColumn('dataModificada', 'datetime', [
            'default' => null,
            'null' => true
        ]);
        
        $table->addColumn('codTransacao', 'string',[
            'default' => null,
            'limit' => 255,
            'null' => false
        ]);
        
        $table->addColumn('status', 'string', [
            'default' => null,
            'limit' => 255,
            'null' => false
        ]);
        
        $table->addColumn('valor', 'float', [
            'default' => null,
            'null' => false
        ]);
        
        $table->addColumn('empresa_id', 'integer', [
            'default' => null,
            'limit' => 11,
            'null' => false
        ]);
        
        $table->addIndex([
                    'empresa_id',
                ]);
        
        $table->create();
    }
}
