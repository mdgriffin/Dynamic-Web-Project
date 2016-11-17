<?php
class	Venue {
	use Model;

	private $id;
	private $venue_id;
	private $source;
	private $title;

	public function __construct ($venue_id, $source, $title) {
		$this->setTitle($title);
		$this->setSource($source);
		$this->setVenue_id($venue_id);
	}

	public function errors () {
		$errors = array();

		return $errors;
	}

	private function _save () {

		$insert_stmt = self::$db->prepare("INSERT INTO Packages (venue_id, source, title) VALUES(:venue_id, :source, :title)");

		$insert_stmt->execute(array(
			':venue_id' => $this->venue_id,
			':source' => $this->source,
			':title' => $this->title
		));

		$this->id = self::$db->lastInsertId("venue_id");
	}

	private function _update () {

	}

	private static function _getAll () {
		$select_stmt = self::$db->prepare("SELECT * FROM Packages");
		$select_stmt->execute();
		return $select_stmt->fetchAll(PDO::FETCH_ASSOC);
	}

	private static function _get($id) {
		$select_stmt = self::$db->prepare("SELECT FROM Packages WHERE package_id=?");
		$select_stmt->execute(array($id));
		return $select_stmt->fetch(PDO::FETCH_ASSOC);
	}

}

?>
