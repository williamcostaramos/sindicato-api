<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * AppConfiguracoes Model
 *
 * @method \App\Model\Entity\AppConfiguraco get($primaryKey, $options = [])
 * @method \App\Model\Entity\AppConfiguraco newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\AppConfiguraco[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\AppConfiguraco|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\AppConfiguraco patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\AppConfiguraco[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\AppConfiguraco findOrCreate($search, callable $callback = null, $options = [])
 */
class AppConfiguracoesTable extends Table
{

    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config)
    {
        parent::initialize($config);

        $this->setTable('app_configuracoes');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');
    }

    /**
     * Default validation rules.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */
    public function validationDefault(Validator $validator)
    {
        $validator
            ->integer('id')
            ->allowEmpty('id', 'create');

        $validator
            ->scalar('tokePagseguro')
            ->maxLength('tokePagseguro', 255)
            ->allowEmpty('tokePagseguro');

        $validator
            ->scalar('emailPagseguro')
            ->maxLength('emailPagseguro', 255)
            ->allowEmpty('emailPagseguro');

        $validator
            ->numeric('valorTaxa')
            ->allowEmpty('valorTaxa');

        $validator
            ->boolean('habilitarCobranca')
            ->requirePresence('habilitarCobranca', 'create')
            ->notEmpty('habilitarCobranca');

        return $validator;
    }
}
