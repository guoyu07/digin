<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "govern_document_type".
 *
 * @property integer $id
 * @property string $doc_name
 * @property string $crtdt
 * @property integer $crtby
 * @property string $upddt
 * @property integer $updby
 */
class GovernDocumentType extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'govern_document_type';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            //[['doc_name'], 'required'],
            [['crtdt', 'upddt'], 'safe'],
            [['crtby', 'updby', 'Is_approved'], 'integer'],
            [['doc_name'], 'string', 'max' => 30],
            
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
            'id' => 'ID',
            'doc_name' => 'Document Name',
            'crtdt' => 'Crtdt',
            'crtby' => 'Crtby',
            'upddt' => 'Upddt',
            'updby' => 'Updby',
            'Is_approved' => 'Approved',
        ];
    }
     public function getIsApproved($id)
    {
         if($this->findOne($id)!=null)
         {
             return $this->findOne($id)->Is_approved;
             
         }
    }
}
