<?
class SelectQuery{
	private $queryString;
	private $db; 
	function __construct(PDO $db, string $table, string $columns){
		$this->queryString = "SELECT $columns FROM $table";
		$this->db = $db;
	}
	public function join($table, $joinType="INNER"): SelectQuery {
		$this->queryString .= " $joinType JOIN $table";
		return $this;
	}
	public function on(string $condition): SelectQuery {
		$this->queryString .= " ON $condition";
		return $this;
	}
	public function where(string $condition): SelectQuery {
		$this->queryString .= " WHERE $condition";
		return $this;
	}
	public function orderBy(string $column, string $order = "ASC"){
		$this->queryString .= " ORDER BY $column $order";
		return $this;
	}
	public function execute(array $data, bool $fetchAll = True, int $fetchStyle = PDO::FETCH_ASSOC) {
		echo $this->queryString;
		$query = $this->db->prepare($this->queryString);
		try{
			$query->execute($data);
		}catch (PDOException $e) {
            die($e);
        }
        if($fetchAll){
        	return $query->fetchAll($fetchStyle);
        }
        return $query->fetch($fetchStyle);
	}
}