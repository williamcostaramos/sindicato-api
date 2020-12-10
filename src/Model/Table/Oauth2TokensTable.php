<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Oauth2Tokens Model
 *
 * @method \App\Model\Entity\Oauth2Token get($primaryKey, $options = [])
 * @method \App\Model\Entity\Oauth2Token newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Oauth2Token[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Oauth2Token|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Oauth2Token patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Oauth2Token[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Oauth2Token findOrCreate($search, callable $callback = null, $options = [])
 */
class Oauth2TokensTable extends Table
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

        $this->setTable('oauth2_tokens');
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
            ->scalar('token')
            ->maxLength('token', 256)
            ->requirePresence('token', 'create')
            ->notEmpty('token');

        $validator
            ->dateTime('expiration_date')
            ->requirePresence('expiration_date', 'create')
            ->notEmpty('expiration_date');

        $validator
            ->boolean('auth_token')
            ->requirePresence('auth_token', 'create')
            ->notEmpty('auth_token');

        return $validator;
    }
}
