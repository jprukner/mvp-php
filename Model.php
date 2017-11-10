<?
// class Model offers basic database abstraction.
class Model {
	protected $db;
	public function __construct(){
		$host		= getenv('DB_HOST');
		$database   = getenv('DB_DATABASE');
		$user     	= getenv('DB_USER');
		$password 	= getenv('DB_PASSWORD');
		try{
			$this->db = new PDO("mysql:host=$host;dbname=$database;charset=utf8", $user, $password);
		}catch(PDOException $e){
			die($e);
		}
	}
	protected function selectFrom(string $table, string $columns): SelectQuery {
		return new SelectQuery($this->db, $table, $columns);
	}
	// insert inserts data into given table.
	protected function insert(string $table, array $data) {
		$values = array_values($data);
		$columns = array_keys($data);
		$placeHolders = implode(',', array_fill(0, count($values), '?'));
		$queryString = 'INSERT INTO '.$table.'('.implode(',', $columns).') VALUES ('.$placeHolders.')';
		$query = $this->db->prepare($queryString);
		try{
			$query->execute($values);
		}catch (PDOException $e) {
            die($e);
        }
	}
	// update updates data. A condition could be specified.
	protected function update(string $table, array $data, string $condition = "", array $conditionData = []){
		// $this->update("user", ['name' => 'steve'], "id = ?", [2]);
		$values  = array_merge(array_values($data), $conditionData);
		$columns = array_keys($data);
		array_map(function(string $v): string {
			return $v . '= ?';
		}, $columns);
		$queryString = 'UPDATE '.$table.' SET '.implode(',', $columns);
		if ($condition != "") {
			$queryString .= ' WHERE '.$condition;
		}
		$query = $this->db->prepare($queryString);
		try{
			$query->execute($values);
		}catch (PDOException $e) {
            die($e);
        }
	}
}
