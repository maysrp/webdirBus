<?php
	class Aria2{
    	protected $ch;
    	function __construct($server='http://127.0.0.1:6800/jsonrpc'){
        	$this->ch = curl_init($server);
        	curl_setopt_array($this->ch, [
            	CURLOPT_POST=>true,
            	CURLOPT_RETURNTRANSFER=>true,
            	CURLOPT_HEADER=>false
        	]);
    	}
    	function __destruct(){
        	curl_close($this->ch);
    	}
    	protected function req($data){
        	curl_setopt($this->ch, CURLOPT_POSTFIELDS, $data);        
        	return curl_exec($this->ch);
    	}
    	function __call($name, $arg){
        	$data = [
            	'jsonrpc'=>'2.0',
            	'id'=>'1',
            	'method'=>'aria2.'.$name,
            	'params'=>$arg
        	];
        	$data = json_encode($data);
        	$response = $this->req($data);
        	if($response===false) {
            	trigger_error(curl_error($this->ch));
        	}
        	return json_decode($response, 1);
    	}
	}
    function remove($info){
        $data=$info['result'];
        foreach ($data as $key => $value) {
            $aria2 = new Aria2('http://127.0.0.1:6800/jsonrpc');
            $x=$aria2->remove($value['gid']);
                var_dump($x);
        }
    }
    $aria2 = new Aria2('http://127.0.0.1:6800/jsonrpc');
    $active=$aria2->tellActive();
    remove($active);
    $waiting=$aria2->tellWaiting(0,100);
    remove($waiting);
