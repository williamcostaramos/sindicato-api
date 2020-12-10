<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * EmpresaPagamentos Model
 *
 * @property \App\Model\Table\EmpresasTable|\Cake\ORM\Association\BelongsTo $Empresas
 * @property \App\Model\Table\AssociadosTable|\Cake\ORM\Association\BelongsTo $Associados
 *
 * @method \App\Model\Entity\EmpresaPagamento get($primaryKey, $options = [])
 * @method \App\Model\Entity\EmpresaPagamento newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\EmpresaPagamento[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\EmpresaPagamento|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\EmpresaPagamento patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\EmpresaPagamento[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\EmpresaPagamento findOrCreate($search, callable $callback = null, $options = [])
 */
class EmpresaPagamentosTable extends Table
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

        $this->setTable('empresa_pagamentos');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->belongsTo('Empresas', [
            'foreignKey' => 'empresa_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('Associados', [
            'foreignKey' => 'associado_id',
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
            ->dateTime('dataPagamento')
            ->requirePresence('dataPagamento', 'create')
            ->notEmpty('dataPagamento');

        $validator
            ->dateTime('dataModificada')
            ->allowEmpty('dataModificada');

        $validator
            ->scalar('codTransacao')
            ->maxLength('codTransacao', 255)
            ->requirePresence('codTransacao', 'create')
            ->notEmpty('codTransacao');

        $validator
            ->scalar('status')
            ->maxLength('status', 255)
            ->requirePresence('status', 'create')
            ->notEmpty('status');

        $validator
            ->numeric('valor')
            ->requirePresence('valor', 'create')
            ->notEmpty('valor');

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
        $rules->add($rules->existsIn(['empresa_id'], 'Empresas'));
        $rules->add($rules->existsIn(['associado_id'], 'Associados'));

        return $rules;
    }
}
