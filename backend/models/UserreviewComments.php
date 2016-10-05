<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "userreview_comments".
 *
 * @property integer $ucid
 * @property integer $userid
 * @property integer $vid
 * @property string $comments
 * @property string $crtdt
 * @property integer $crtby
 * @property string $upddt
 * @property integer $updby
 */
class UserreviewComments extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'userreview_comments';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['userid', 'vid', 'comments', 'crtdt', 'crtby', 'upddt', 'updby'], 'required'],
            [['userid', 'vid', 'crtby', 'updby'], 'integer'],
            [['comments'], 'string'],
            [['crtdt', 'upddt'], 'safe']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'ucid' => 'Ucid',
            'userid' => 'Userid',
            'vid' => 'Vid',
            'comments' => 'Comments',
            'crtdt' => 'Crtdt',
            'crtby' => 'Crtby',
            'upddt' => 'Upddt',
            'updby' => 'Updby',
        ];
    }
}
