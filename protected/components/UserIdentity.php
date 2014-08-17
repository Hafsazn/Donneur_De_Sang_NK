<?php

class UserIdentity extends CUserIdentity {


    public function authenticate() {
        $user = User::model()
                ->findByAttributes(array(
            'username' => $this->username,
        ));
         
        if ($user === null)
            $this->errorCode = self::ERROR_USERNAME_INVALID;
        else
        if ($user->check($this->password)) {
            $this->errorCode = self::ERROR_NONE;
        }
        else
            $this->errorCode = self::ERROR_PASSWORD_INVALID;
        return !$this->errorCode;
    }

}