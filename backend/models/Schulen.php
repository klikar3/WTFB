<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "schulen".
 *
 * @property int $SchulId
 * @property string $Schulname
 * @property int $sort
 * @property int $Disziplin
 * @property int $swmInteressentenListe
 * @property int $swmInteressentenForm
 * @property int $swmMitgliederListe
 * @property int $swmMitgliederForm
 *
 * @property Anwesenheitsliste[] $anwesenheitslistes
 * @property Disziplinen $disziplin
 * @property Mitgliederschulen[] $mitgliederschulens
 * @property Schulleiterschulen[] $schulleiterschulens
 * @property Texte[] $textes
 */
class Schulen extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'schulen';
    }

    public static function find()
    { 
			if ((!Yii::$app->user->identity->isAdmin /*role == 10*/) /*and (Yii::$app->controller->action->id != 'schuelerzahlen')*/) {
    			$schulleiter = Schulleiter::find()->where(['LeiterId' => Yii::$app->user->identity->LeiterId])->one();
    	    $schulleiterschulen = Schulleiterschulen::find()->select('SchulId')->where(['LeiterId' => $schulleiter->LeiterId])->all();
//					Yii::warning( Vardumper::dumpAsString($schulleiterschulen));
          $schulen = array_map(function ($v) { return $v->SchulId; },$schulleiterschulen );
//					Yii::warning("-----schulen: ". Vardumper::dumpAsString($schulen));
          if ((Yii::$app->user->identity->username == 'evastgt') and ((Yii::$app->controller->action->id == 'schuelerzahlen') or (Yii::$app->controller->action->id == 'sektionsliste'))) {
            if (!in_array(18, $schulen)) {
              $schulen = array_merge([18], $schulen);
//              Yii::warning("-----eva:18 ");
            }  
            if (!in_array(33, $schulen)) {
              $schulen = [33] + $schulen;
//              Yii::warning("-----eva:33 ");
            }  

//            $schulen = [18 => "Stuttgart K"] + $schulen;
//Vardumper::dumpAsString($schulen);
          }
//					Yii::warning("-----PRINT: ". Vardumper::dumpAsString($schulleiterschulen));
	//				Yii::warning("-----PRINT: ". Vardumper::dumpAsString($schulen));
//					Yii::error("-----PRINT: ". Vardumper::dumpAsString(array_map(function ($v) { return $v->SchulId; },$schulleiterschulen )));
//					Yii::error("-----PRINT: ". Vardumper::dumpAsString(parent::find()->where( ['SchulId' => array_map(function ($v) { return $v->SchulId; },$schulleiterschulen )])->all()));
		    	return parent::find()->where( ['schulen.SchulId' => $schulen]);
		  }
		  return parent::find();
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['Schulname', 'sort', 'Disziplin'], 'required'],
            [['sort', 'Disziplin', 'swmInteressentenListe', 'swmInteressentenForm', 'swmMitgliederListe', 'swmMitgliederForm'], 'integer'],
            [['Schulname'], 'string', 'max' => 50],
            [['Schulname', 'Disziplin'], 'unique', 'targetAttribute' => ['Schulname', 'Disziplin']],
            [['Disziplin'], 'exist', 'skipOnError' => true, 'targetClass' => Disziplinen::className(), 'targetAttribute' => ['Disziplin' => 'DispId']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'SchulId' => Yii::t('app', 'Schul ID'),
            'Schulname' => Yii::t('app', 'Schulname'),
            'sort' => Yii::t('app', 'Sort'),
            'Disziplin' => Yii::t('app', 'Disziplin'),
            'swmInteressentenListe' => Yii::t('app', 'Swm Interessenten Liste'),
            'swmInteressentenForm' => Yii::t('app', 'Swm Interessenten Form'),
            'swmMitgliederListe' => Yii::t('app', 'Swm Mitglieder Liste'),
            'swmMitgliederForm' => Yii::t('app', 'Swm Mitglieder Form'),
        ];
    }

    /**
     * Gets query for [[Anwesenheitslistes]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getAnwesenheitslistes()
    {
        return $this->hasMany(Anwesenheitsliste::className(), ['schule' => 'SchulId']);
    }

    /**
     * Gets query for [[Disziplin]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getDisziplin()
    {
        return $this->hasOne(Disziplinen::className(), ['DispId' => 'Disziplin']);
    }

     public function getDisziplinen()
    {
        return $this->hasOne(Disziplinen::className(), ['DispId' => 'Disziplin']);
    }

    public function getSchulDisp() {
//            $disp = $this->getDisziplinen();
            $disp = $this->disziplinen;
		    return $this->Schulname . ' ' . $disp->DispKurz; // assuming you have a relation called profile
		}

   /**
     * Gets query for [[Mitgliederschulens]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getMitgliederschulens()
    {
        return $this->hasMany(Mitgliederschulen::className(), ['SchulId' => 'SchulId']);
    }

    /**
     * Gets query for [[Schulleiterschulens]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getSchulleiterschulens()
    {
        return $this->hasMany(Schulleiterschulen::className(), ['SchulId' => 'SchulId']);
    }

    /**
     * Gets query for [[Textes]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTextes()
    {
        return $this->hasMany(Texte::className(), ['SchulId' => 'SchulId']);
    }


}
