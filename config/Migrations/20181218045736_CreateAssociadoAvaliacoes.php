<?php
use Migrations\AbstractMigration;

class CreateAssociadoAvaliacoes extends AbstractMigration
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
        $table = $this->table('associado_avaliacoes', ['id' => false, 'primary_key' => ['associado_id', 'empresa_id']]);
        
        $table->addColumn('associado_id', 'integer', [
                        'default' => null,
                        'limit' => 11,
                        'null' => false
        ]);
        
        $table->addColumn('empresa_id', 'integer', [
                        'default' => null,
                        'limit' => 11,
                        'null' => false
        ]);
        
        $table->addColumn('avaliacao', 'integer', [
            'default' => null,
            'limit' => 11,
            'null' => false,
        ]);
        
        $table->addIndex([
                    'associado_id',
                    'empresa_id'
        ]);
        
        $table->create();
    }
}
