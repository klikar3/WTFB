<?php

namespace frontend\models;

/**
 * This is the ActiveQuery class for [[Pruefungen]].
 *
 * @see Pruefungen
 */
class PruefungenQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return Pruefungen[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return Pruefungen|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
