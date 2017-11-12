<?php
class WellcomeController extends Controller{

	public function beforeRoute(){
		
	}

	public function index(){
		json(['msg'=>'Wellcome to f3 microservices mvc framework']);
	}

}