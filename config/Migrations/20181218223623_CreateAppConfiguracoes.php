<?php
use Migrations\AbstractMigration;

class CreateAppConfiguracoes extends AbstractMigration
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
        $table = $this->table('app_configuracoes');
        
        $table->addColumn('tokePagseguro', 'string',[
            'default' => null,
            'limit' => 255,
            'null' => true
        ]);
        
        $table->addColumn('emailPagseguro', 'string',[
            'default' => null,
            'limit' => 255,
            'null' => true
        ]);
        
        $table->addColumn('valorTaxa', 'float',[
            'default' => null,
            'null' => true
        ]);
        
        $table->addColumn('habilitarCobranca', 'boolean',[
            'default' => null,
            'limit' => null,
            'null' => false,
        ]);
        
        $table->create();
    }
}
