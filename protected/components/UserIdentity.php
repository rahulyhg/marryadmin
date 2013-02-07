<?php

/**
 * UserIdentity represents the data needed to identity a user.
 * It contains the authentication method that checks if the provided
 * data can identity the user.
 */
class UserIdentity extends CUserIdentity
{
	/**
	 * Authenticates a user.
	 * The example implementation makes sure if the username and password
	 * are both 'demo'.
	 * In practical applications, this should be changed to authenticate
	 * against some persistent user identity storage (e.g. database).
	 * @return boolean whether authentication succeeds.
	 */
	public function authenticate()
	{
		$users=array(
			// username => password
			'demo'=>'demo',
			'admin'=>'admin',
		);
		if(isset($this->username) && isset($this->password))
		{
			$condition = " username = '{$this->username}' AND password = md5('{$this->password}') and status = 1";
			$record = AdminUsers::model()->find(array('condition' => $condition));
			if(isset($record) && $record['username'] == $this->username)
			{
				$this->setState('user', $record['username']);
				Yii::app()->session->add('username',$record['username']);
				Yii::app()->session->add('user',$record);
				$this->errorCode=self::ERROR_NONE;
				}
			else
			$this->errorCode=self::ERROR_USERNAME_INVALID;
			
			return !$this->errorCode;
		}	
		else if($users[$this->username]!==$this->password)
			$this->errorCode=self::ERROR_PASSWORD_INVALID;
		else
			$this->errorCode=self::ERROR_NONE;
		return !$this->errorCode;
	}
}