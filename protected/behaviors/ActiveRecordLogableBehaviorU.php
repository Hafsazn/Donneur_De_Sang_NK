<?php


/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
class ActiveRecordLogableBehaviorU extends CActiveRecordBehavior
{
    private $_oldattributes = array();
    private $_primarykeys;
    public function afterSave($event)
    {   
        /*if(is_array($this->Owner->getPrimaryKey()))
        $_primarykeys = implode(',', $this->Owner->getPrimaryKey()) ;
        else*/
          $_primarykeys = $this->Owner->getPrimaryKey();  
        if (!$this->Owner->isNewRecord) {
                
            // new attributes
            $newattributes = $this->Owner->getAttributes();
            $oldattributes = $this->getOldAttributes();
            
            // compare old and new
            foreach ($newattributes as $name => $value) {
                if (!empty($oldattributes)) {
                    $old = $oldattributes[$name];
                } else {
                    $old = '';
                }
 
                if ($value != $old) {
                    
                     $log=new UserLog;
                    $log->details = 'Utilisateur ' . Yii::app()->user->name 
                                            . ' a changé le (la) ' . $name . ' de l\'utilisateur ' 
                                             . $this->Owner->username.'.';
                   // $log->action = 'Update';
                    $log->username = Yii::app()->user->Name;
                   $log->ipaddress = $_SERVER['REMOTE_ADDR'];
                    $log->logtime = date("Y-m-d H:i:s");
                    //$log->controller = get_class($this->Owner);
                    
                    $log->save();
                }
            }
        } else {
            $log=new UserLog;
                    $log->details = 'Utilisateur ' . Yii::app()->user->name 
                                            . ' a creé un nouveau utilisateur => ' 
                                             . $this->Owner->username.'.';
                   // $log->action = 'Update';
                    $log->username = Yii::app()->user->Name;
                   $log->ipaddress = $_SERVER['REMOTE_ADDR'];
                    $log->logtime = date("Y-m-d H:i:s");
                    //$log->controller = get_class($this->Owner);
                    
                    $log->save();
        }
    }
 
    public function afterDelete($event)
    {
         if(is_array($this->Owner->getPrimaryKey()))
        $_primarykeys = implode(',', $this->Owner->getPrimaryKey()) ;
        else
          $_primarykeys = $this->Owner->getPrimaryKey();
        $log=new UserLog;
                    $log->details = 'Utilisateur ' . Yii::app()->user->name 
                                            . ' a supprimé utilisateur ' 
                                             . $this->Owner->username.'.';
                   // $log->action = 'Update';
                    $log->username = Yii::app()->user->Name;
                   $log->ipaddress = $_SERVER['REMOTE_ADDR'];
                    $log->logtime = date("Y-m-d H:i:s");
                    //$log->controller = get_class($this->Owner);
                    
                    $log->save();
    }
 
    public function afterFind($event)
    {
        // Save old values
        $this->setOldAttributes($this->Owner->getAttributes());
    }
 
    public function getOldAttributes()
    {
        return $this->_oldattributes;
    }
 
    public function setOldAttributes($value)
    {
        $this->_oldattributes=$value;
    }
}
?>
