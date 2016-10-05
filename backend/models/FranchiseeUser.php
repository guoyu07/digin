<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "franchisee_user".
 *
 * @property integer $id
 * @property integer $userid
 * @property string $crtdt
 * @property integer $crtby
 * @property string $upddt
 * @property integer $updby
 */
class FranchiseeUser extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'franchisee_user';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['frid', 'userid'], 'required'],
            [['userid', 'crtby', 'updby'], 'integer'],
            [['crtdt', 'upddt'], 'safe'],
            
            ['crtdt', 'default', 'value' => date('Y-m-d H:i:s')],
            ['upddt', 'default', 'value' => date('Y-m-d H:i:s')],
           // ['crtby', 'default', 'value' =>Yii::$app->user->identity->id],
           // ['updby', 'default', 'value' =>Yii::$app->user->identity->id]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'frid' => 'Frid',
            'userid' => 'Userid',
            'crtdt' => 'Crtdt',
            'crtby' => 'Crtby',
            'upddt' => 'Upddt',
            'updby' => 'Updby',
        ];
    }
}
