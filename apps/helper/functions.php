<?php

function f3(){
	return \Base::instance();
}

function pr($args=null){
	echo '<pre>'; print_r($args); echo '<pre>';
}

function db(){
	return DB::instance()->get();
}

function mapper($table){
	return new \DB\SQL\Mapper(db(), $table);
}

function json($data=null, $response_code=200){
	if(isset($data['status_code'])) $response_code=$data['status_code'];
	header('Content-Type: application/json', true, $response_code);
	//http_response_code($response_code);
	echo json_encode($data);
}

function verify_method($args=[]){
	if(!in_array(\Base::instance()->VERB, $args)) die(json(['msg'=>'method not allowed', 'status_code'=>405], 405));
}

function timestamp($timestamps=null, $format='Y-m-d H:i:s'){
	if($timestamps) return date($format, strtotime($timestamps));
	return date($format);
}

function matrix_exists($cell=null, $value=null, $full_rows=false){
	$matrix=explode('.', $cell);
	if(count($matrix)!=2) return null;
	list($table, $field)=$matrix;
	$result=db()->exec("SELECT * FROM `$table` WHERE `$field`='$value'");
	if($full_rows) return $result;
	return db()->count();
}

function matrix_uid($cell=null){
	$matrix=explode('.', $cell);
	if(count($matrix)!=2) return null;
	list($table, $field)=$matrix;
	$uid=uniqid();
	$result=db()->exec("SELECT * FROM `$table` WHERE `$field`='$uid'");
	if(db()->count()!=0) matrix_uid($cell);
	return $uid;
}

function validate_app_key(){
	if(f3()->APP_KEY && f3()->APP_KEY===f3()->get('HEADERS.App-Key')) return true;
	die(json(['msg'=>'app key miss match error', 'status_code'=>401]));
}