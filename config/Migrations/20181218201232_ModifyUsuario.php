<?php
use Migrations\AbstractMigration;

class ModifyUsuario extends AbstractMigration
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
        $table = $this->table('usuario');
        
        $table->addColumn('role', 'string', [
            'default' => null,
            'limit' => 100,
            'null' => true,
        ]);
        
        $table->update();
    }
}
