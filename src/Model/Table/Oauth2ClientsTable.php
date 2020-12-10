<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Oauth2Clients Model
 *
 * @property \App\Model\Table\ClientsTable|\Cake\ORM\Association\BelongsTo $Clients
 *
 * @method \App\Model\Entity\Oauth2Client get($primaryKey, $options = [])
 * @method \App\Model\Entity\Oauth2Client newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Oauth2Client[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Oauth2Client|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Oauth2Client patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Oauth2Client[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Oauth2Client findOrCreate($search, callable $callback = null, $options = [])
 */
class Oauth2ClientsTable extends Table
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

        $this->setTable('oauth2_clients');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->belongsTo('Clients', [
            'foreignKey' => 'client_id',
            'joinType' => 'INNER'
        ]);
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
            ->scalar('secret')
            ->maxLength('secret', 256)
            ->requirePresence('secret', 'create')
            ->notEmpty('secret');

        return $validator;
    }

    /**
     * Returns a rules checker object that will be used for validating
     * application integrity.
     *
     * @param \Cake\ORM\RulesChecker $rules The rules object to be modified.
     * @return \Cake\ORM\RulesChecker
     */
    public function buildRules(RulesChecker $rules)
    {
        $rules->add($rules->existsIn(['client_id'], 'Clients'));

        return $rules;
    }
}
