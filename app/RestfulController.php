<?php

interface RestfulController {

	public function before ();
	public function after ();
	public function index ();
	public function create ($data);
	public function read ($id);
	public function update ($id, $data);
	public function delete ($id);

}

?>
