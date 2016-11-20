<?php

class View {
	public static $template_base = "templates/";
	public static $template_extension = ".php";
	public $vars = array();
	public $template_name;

	public function __construct ($template_name) {
		$this->template_name = $template_name;
	}

	public static function create ($template_name) {
		return new View($template_name);
	}

	public function with ($vars) {
		$this->vars = $vars;
		include self::$template_base . $this->template_name . self::$template_extension;
	}

	public function __get($key) {
		if (array_key_exists($key, $this->vars)) {
			return $this->vars[$key];
		} else {
			return null;
		}
	}

}

?>
