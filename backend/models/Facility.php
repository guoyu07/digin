<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "facility".
 *
 * @property integer $id
 * @property string $name
 * @property integer $crtby
 * @property string $crtdt
 * @property integer $updtby
 * @property string $upddt
 */
class Facility extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'facility';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            //[['id', 'name', 'crtby', 'crtdt', 'updtby', 'upddt'], 'required'],
            [['name', 'description'], 'required'],
            [['id', 'crtby', 'updtby'], 'integer'],
            [['crtdt', 'upddt'], 'safe'],
            [['name', 'description'], 'string', 'max' => 100],
            
            ['crtdt', 'default', 'value' => date('Y-m-d H:i:s')],
            ['upddt', 'default', 'value' => date('Y-m-d H:i:s')],
            ['crtby', 'default', 'value' =>isset(Yii::$app->user->identity->id) ? Yii::$app->user->identity->id :'1'],
            ['updtby', 'default', 'value' =>isset(Yii::$app->user->identity->id) ? Yii::$app->user->identity->id :'1']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'description' => 'Description',
            'crtby' => 'Crtby',
            'crtdt' => 'Crtdt',
            'updtby' => 'Updtby',
            'upddt' => 'Upddt',
        ];
    }
}
