<?php
use Migrations\AbstractMigration;

class CreateClubeFotos extends AbstractMigration
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
        $table = $this->table('clube_fotos');
        
        $table->addColumn('descricao', 'string', [
            'default' => null,
            'limit' => 255,
            'null' => true
        ]);
        
        $table->addColumn('urlImg', 'string', [
            'default' => null,
            'limit' => 255,
            'null' => false
        ]);
        
        $table->addColumn('clube_id', 'integer', [
            'default' => null,
            'limit' => 11,
            'null' => false
        ]);
        
        $table->addIndex(['clube_id']);
        
        $table->create();
    }
}
