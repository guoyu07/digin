<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "userreview".
 *
 * @property integer $urid
 * @property integer $userid
 * @property integer $vid
 * @property integer $questionid
 * @property integer $answer
 * @property string $crtdt
 * @property integer $crtby
 * @property string $upddt
 * @property integer $updby
 */
class Userreview extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'userreview';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['userid', 'vid', 'questionid', 'answer', 'crtdt', 'crtby', 'upddt', 'updby'], 'required'],
            [['userid', 'vid', 'questionid', 'answer', 'crtby', 'updby'], 'integer'],
            [['crtdt', 'upddt'], 'safe']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'urid' => 'Urid',
            'userid' => 'Userid',
            'vid' => 'Vid',
            'questionid' => 'Questionid',
            'answer' => 'Answer',
            'crtdt' => 'Crtdt',
            'crtby' => 'Crtby',
            'upddt' => 'Upddt',
            'updby' => 'Updby',
        ];
    }
}
