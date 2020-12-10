<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * AssociadoAvaliacoes Model
 *
 * @property \App\Model\Table\AssociadosTable|\Cake\ORM\Association\BelongsTo $Associados
 * @property \App\Model\Table\EmpresasTable|\Cake\ORM\Association\BelongsTo $Empresas
 *
 * @method \App\Model\Entity\AssociadoAvaliaco get($primaryKey, $options = [])
 * @method \App\Model\Entity\AssociadoAvaliaco newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\AssociadoAvaliaco[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\AssociadoAvaliaco|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\AssociadoAvaliaco patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\AssociadoAvaliaco[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\AssociadoAvaliaco findOrCreate($search, callable $callback = null, $options = [])
 */
class AssociadoAvaliacoesTable extends Table
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

        $this->setTable('associado_avaliacoes');
        $this->setDisplayField('associado_id');
        $this->setPrimaryKey(['associado_id', 'empresa_id']);

        $this->belongsTo('Associados', [
            'foreignKey' => 'associado_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('Empresas', [
            'foreignKey' => 'empresa_id',
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
            ->integer('avaliacao')
            ->requirePresence('avaliacao', 'create')
            ->notEmpty('avaliacao');

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
        $rules->add($rules->existsIn(['associado_id'], 'Associados'));
        $rules->add($rules->existsIn(['empresa_id'], 'Empresas'));

        return $rules;
    }
}
