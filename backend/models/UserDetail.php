<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "user_detail".
 *
 * @property integer $uid
 * @property string $firstname
 * @property string $lastname
 * @property string $city
 * @property string $country
 * @property string $crtdt
 * @property integer $crtby
 * @property string $upddt
 * @property integer $updby
 */
class UserDetail extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'user_detail';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            //[['firstname', 'lastname', 'city', 'country', 'crtdt', 'crtby', 'upddt', 'updby'], 'required'],
            [['firstname', 'lastname','address1', 'city', 'state', 'country'], 'required'],
            //[['crtdt', 'upddt'], 'safe'],
            [['firstname', 'lastname', 'city', 'country'], 'safe'],
            [['crtby', 'updby', 'user_id'], 'integer'],
            [['firstname', 'lastname', 'city', 'state', 'country', 'role'], 'string', 'max' => 30],
            [['middlename', 'address1', 'address2'], 'string', 'max'=> 50],
            
            ['crtdt', 'default', 'value' => date('Y-m-d H:i:s')],
            ['upddt', 'default', 'value' => date('Y-m-d H:i:s')],
            ['crtby', 'default', 'value' =>  isset(Yii::$app->user->identity->id) ? Yii::$app->user->identity->id :1],
            ['updby', 'default', 'value' =>isset(Yii::$app->user->identity->id) ? Yii::$app->user->identity->id :1]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'uid' => 'Uid',
            'firstname' => 'First name',
            'lastname' => 'Last name',
            'middlename' => 'Middle name',
            'address1' => 'Address1',
            'address2' => 'Address2',
            'city'     => 'City',
            'state'    => 'State',
            'country'  => 'Country',
            'role'     => 'Role',
            /*'crtdt' => 'Crtdt',
            'crtby' => 'Crtby',
            'upddt' => 'Upddt',
            'updby' => 'Updby',*/
        ];
    }
    
    public function getUser()
    {
        return $this->hasOne(\dektrium\user\models\User::className(), ['id' => 'user_id']);
    }
    public function getUsername()
    {
        return $this->user ? $this->user->username : 'Username';
    }
    public function getEmail()
    {
        return $this->user ? $this->user->email : 'Email';
    }
    public function getPhone()
    {        
        return $this->user ? $this->user->phone : 'Phone';
    }
    
   /* public function getRole()
    {        
        if($this->user){
         $roles = \Yii::$app->authManager->getRolesByUser($this->user->id);
         if ($roles) {                   
                $this->user->role=implode(', ', array_keys($roles));
                return $this->user->role;
          } else {
                 return 'no role';
          }
        }
        else {
            return '-';
        } 
        
    }*/
   
}
