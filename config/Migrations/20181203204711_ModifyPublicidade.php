<?php
use Migrations\AbstractMigration;

class ModifyPublicidade extends AbstractMigration
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
        $table = $this->table('publicidade');
                
        $table->renameColumn('urlImg', 'url');
        
        $table->addColumn('codigo_video', 'string', [
            'default' => null,
            'limit' => 255,
            'null' => true
        ]);
        
        $table->update();
    }
}
