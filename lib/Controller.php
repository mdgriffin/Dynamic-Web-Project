<?php

trait Controller {

	public function __call ($name, $arguments) {
		$this->before();

		$name = '_' . $name;

		if (method_exists($this, $name)) {
			return call_user_func_array (array($this, $name) , $arguments);
		} else {
			return null;
		}
	}

}

?>
