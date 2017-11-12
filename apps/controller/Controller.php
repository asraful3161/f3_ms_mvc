<?php
class Controller extends \Prefab{
	
	protected function verify_user_login_token($token=null){
		if($token){
			$result=db()->exec("SELECT `name`, `email`, `uuid` FROM `users` WHERE `login_token`='$token' LIMIT 1");
			if($result) return current($result);
			return false;
		} return false;
	}

	protected function escape_validation($args=[]){
		if(in_array(f3()->get('PARAMS.Action'), $args)) return true;
		return false;
	}

	protected function automate_logout(){

		$interval=f3()->get('AUTOMATIC_LOGOUT_INTERVAL');
		db()->exec("UPDATE `users` SET `login_token`=null WHERE TIMESTAMPDIFF(MINUTE, `updated`, CURRENT_TIMESTAMP) > '$interval'");

	}

}