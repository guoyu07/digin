<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "skills_testimonials".
 *
 * @property integer $testid
 * @property integer $userid
 * @property string $quotes
 * @property string $name
 * @property string $image
 * @property string $crtdt
 * @property integer $crtby
 * @property string $upddt
 * @property integer $updby
 */
class SkillsTestimonials extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'skills_testimonials';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['userid', 'quotes', 'name'], 'required'],
            [['userid', 'crtby', 'updby'], 'integer'],
            [['image'], 'file', 'skipOnEmpty' => true],
            [['quotes'], 'string'],
            [['crtdt', 'upddt'], 'safe'],
            [['name'], 'string', 'max' => 50],
            //[['image'], 'string', 'max' => 100],
            
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
            'testid' => 'Testid',
            'userid' => 'Userid',
            'quotes' => 'Quotes',
            'name' => 'Name',
            'image' => 'Image',
            'crtdt' => 'Crtdt',
            'crtby' => 'Crtby',
            'upddt' => 'Upddt',
            'updby' => 'Updby',
        ];
    }
}
