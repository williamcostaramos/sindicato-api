<?php
use Migrations\AbstractMigration;

class CreateInformacao extends AbstractMigration
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
        $table = $this->table('informacao');
        
        $table->addColumn('titulo', 'string', [
            'default' => null,
            'limit' => 255,
            'null' => false,
        ]);
        
        $table->addColumn('texto', 'text', [
            'default' => null,
            'null' => false,
        ]);
        
        $table->addColumn('anexo', 'string', [
            'default' => null,
            'limit' => 255,
            'null' => true,
        ]);
        
        $table->addColumn('created', 'datetime', [
            'default' => null,
            'null' => false,
        ]);
        
        $table->create();
    }
}
