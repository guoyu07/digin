<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "skills_government_ids".
 *
 * @property integer $gid
 * @property integer $userid
 * @property integer $governdoc_type
 * @property integer $govern_no
 * @property string $crtdt
 * @property integer $crtby
 * @property string $upddt
 * @property integer $updby
 */
class SkillsGovernmentIds extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'skills_government_ids';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['userid',  'govern_no'], 'required'],
            [['userid', 'governdoc_type', 'govern_no', 'crtby', 'updby'], 'integer'],
            [['crtdt', 'upddt'], 'safe'],
            
            ['crtdt', 'default', 'value' => date('Y-m-d H:i:s')],
            ['upddt', 'default', 'value' => date('Y-m-d H:i:s')],
            ['crtby', 'default', 'value' =>isset(Yii::$app->user->identity->id) ? Yii::$app->user->identity->id :'1'],
            ['updby', 'default', 'value' =>isset(Yii::$app->user->identity->id) ? Yii::$app->user->identity->id :'1']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'gid' => 'Gid',
            'userid' => 'Userid',
            'governdoc_type' => 'Government document Type',
            'govern_no' => 'Government No',
            'crtdt' => 'Crtdt',
            'crtby' => 'Crtby',
            'upddt' => 'Upddt',
            'updby' => 'Updby',
        ];
    }
}
