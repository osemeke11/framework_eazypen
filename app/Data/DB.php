<?php

namespace App\Data;

class DB extends DBInteractor {

	// Get all Data
	public function getAllData($tableName)
    {
    	// GET TOTAL DATA
        $sql = "SELECT * from " . $tableName;

        return $this->executeQuery($sql);
    }

    // Get all Data
    public function getAllDataOrder($tableName, $order)
    {
        // GET TOTAL DATA
        $sql = "SELECT * from " . $tableName . " ORDER BY " . $order;

        return $this->executeQuery($sql);
    }

    public function getTotalData($tableName)
    {
        $sql = "SELECT COUNT(*) as total FROM $tableName";

        return $this->executeQuery($sql)[0]['total'];
    }

    public function getTotalDataWhere($tableName, $key)
    {
        $sql = "SELECT COUNT(*) as total FROM $tableName WHERE $key";

        return $this->executeQuery($sql)[0]['total'];
    }

    public function getAllDataWhere($tableName, $condition)
    {
    	// SELECT ALL DATA FROM TABLENAME WHERE CONDITION
        $sql = "SELECT * FROM " . $tableName ." WHERE " . $condition;

        return $this->executeQuery($sql);
    }

    public function getAllDataWhereOrder($tableName, $condition, $order)
    {
    	// SELECT * FROM country WHERE country_name like '" . $_POST["keyword"] . "%' ORDER BY country_name LIMIT 0,6
    	$sql = "SELECT * FROM " . $tableName . " WHERE " . $condition . "ORDER BY " . $order;

        return $this->executeQuery($sql);
    }

	public function getDataTotalJoin($tableName, $otherTableName, $condition, $key)
	{
		// SELECT FOUND_ROWS() AS TOTAL FROM TABLE NAME JOIN WITH ANOTHER TABLE
		// ON TABLENAME_ID = OTHERTABLE_ID WHERE COLUMN = COLUMNNAME
		$sql = "SELECT COUNT(*) as total FROM $tableName
		 		INNER JOIN $otherTableName ON
		 		$condition
		 		WHERE $key";

		return $this->executeQuery($sql)[0]['total'];
	}

	public function getPaginatedArticles($tableName, $order, $start, $perPage)
	{
		// GET PAGINATION
		$sql = "SELECT * FROM $tableName ORDER BY $order LIMIT {$start}, {$perPage};";

		return $this->executeQuery($sql);

	}

    public function getPaginatedArticlesJoin($tableName, $otherTable, $condition, $where, $order, $start, $perPage)
    {
        // SELECT $field FROM TABLE JOIN OTHER_TABLE

        $sql = "SELECT * FROM " . $tableName . " JOIN " . $otherTable . " ON " . $condition . " WHERE " . $where . "ORDER BY " . $order . " LIMIT {$start}, {$perPage}";

        return $this->executeQuery($sql);
    }

    public function getAllDataInnerJoin($tableName, $otherTable, $condition)
    {
        // SELECT $field FROM TABLE JOIN OTHER_TABLE

        $sql = "SELECT * FROM " . $tableName . " JOIN " . $otherTable . " ON " . $condition;

        return $this->executeQuery($sql);
    }

    public function getAllDataInnerJoinWhere($tableName, $otherTable, $condition, $where)
    {
        // SELECT $field FROM TABLE JOIN OTHER_TABLE

        $sql = "SELECT * FROM " . $tableName . " JOIN " . $otherTable . " ON " . $condition . " WHERE " . $where;

        return $this->executeQuery($sql);
    }

    public function getAllDataInnerJoinOrder($tableName, $otherTable, $condition, $order)
    {
        // SELECT $field FROM TABLE JOIN OTHER_TABLE

        $sql = "SELECT * FROM " . $tableName . " JOIN " . $otherTable . " ON " . $condition . " ORDER BY " . $order;

        return $this->executeQuery($sql);
    }

    public function getAllDataInnerJoinWhereOrder($tableName, $otherTable, $condition, $where, $order)
    {
        // SELECT $field FROM TABLE JOIN OTHER_TABLE

        $sql = "SELECT * FROM " . $tableName . " JOIN " . $otherTable . " ON " . $condition . " WHERE " . $where . " ORDER BY " . $order;

        return $this->executeQuery($sql);
    }

	public function getAllDataInnerJoinGroupBy($tableName, $otherTable, $condition, array $fields = ['*'], $groupBy)
    {
    	// SELECT $field FROM TABLE JOIN OTHER_TABLE
        $fields = convertToCommaSeparatedString($fields);

        $sql = "SELECT $fields FROM " . $tableName . " JOIN " . $otherTable . " ON " . $condition . ' GROUP BY ' . $groupBy;

        return $this->executeQuery($sql);
    }

    public function getAllDataInnerJoinWhereGroupBy($tableName, $otherTable, $condition, array $fields = ['*'], $where, $groupBy)
    {
        $fields = convertToCommaSeparatedString($fields);

        $sql = "SELECT $fields FROM " . $tableName . " JOIN " . $otherTable . " ON " . $condition . " WHERE " . $where . " GROUP BY " . $groupBy;

        return $this->executeQuery($sql);
    }

    // Get Sum of Data From tableName
    public function getSumData($tableName, $column)
    {
        $sql = "SELECT SUM($column) as total from " . $tableName;

        return $this->executeQuery($sql)[0]['total'];
    }

    // Extract Date For Chart
    public function getCountDate($date, $tableName)
    {
        $sql = "SELECT COUNT(EXTRACT(YEAR_MONTH FROM $date)) AS total, EXTRACT(YEAR FROM $date) AS year,
                EXTRACT(MONTH FROM $date) AS month FROM $tableName GROUP by month ORDER BY month DESC LIMIT 10";

        return $this->executeQuery($sql);
    }

    // Select Distinct and grouped Data
    public function getDistinctTotalGroup($tableName, $columnName)
    {
        $sql = "SELECT DISTINCT $columnName, COUNT($columnName) as total FROM $tableName GROUP BY $columnName";

        return $this->executeQuery($sql);
    }

	/*****************************UPDATE INSERT AND DELETE *********************/
	// Insert Data Into Database
	public function addData($tableName, $data)
	{
		$fieldNames = array_keys($data);

        $fields = convertToCommaSeparatedString($fieldNames);

        $boundNames = array_map(function($name){
            return ":" . $name;
        }, $fieldNames);

        $fieldsValue = convertToCommaSeparatedString($boundNames);

        $sql = "INSERT INTO $tableName ($fields) value ($fieldsValue)";

        return $this->executeAction($sql, $data);
	}

  // Insert Data into database from another
  public function insertSelectFromData($toTable, $fromTable, $toTableColumns, $fromTableColumns, $condition)
  {
      $sql = "INSERT INTO $toTable ($toTableColumns)
              SELECT $fromTableColumns
              FROM $fromTable
              WHERE $condition";

      return $this->executeAction($sql);
  }

	// Insert Data INTO a Sales Table From Session
	public function insertFromCart($columns, $values)
	{
		$sql = "INSERT INTO sales($columns) VALUES ($values)";

		return $this->executeAction($sql);
	}

	// Edit or Update SQL INTO DATABASE
	 public function updateData($tableName, $condition, $key)
    {

        $sql = "UPDATE $tableName SET $condition WHERE $key";

        return $this->executeAction($sql);
    }

    // Delete Data From Database
    public function deleteData($tableName, $key)
    {
    	$sql = "DELETE FROM $tableName WHERE $key";
    	return $this->executeAction($sql);
    }

}
