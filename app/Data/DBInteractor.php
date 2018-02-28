<?php

namespace App\Data;
use PDO;

abstract class DBInteractor {
	
	/*
	* Database Setting 
	*/
	

	protected $db;

	function __construct()
	{
		$this->db = $this->connect();
	}

	protected function connect()
	{

		$dsn = "mysql:host=". getenv('DB_HOST') . ";dbname=" . getenv('DB_NAME') . ";";


		try {

			$pdo = new PDO($dsn, getenv('DB_USER'), getenv('DB_PASS'));
			$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

			return $pdo;

		}
		catch (PDOException $e) {
			return $e->getMessage();
		}

	}


	protected function executeQuery($sql) // SELECT
	{

		try {

			$sth = $this->db->query($sql);

			$sth->setFetchMode(PDO::FETCH_ASSOC);

			$results = $sth->fetchAll();

			// return count($results) > 1 ? $results : $results[0];

			return $results;
		}
		catch (PDOException $e) {
			return $e->getMessage();
		}


	}

	protected function executeAction($sql, $data = null) // INSERT/UPDATE/DELETE
	{
		try {
            $sth = $this->db->prepare($sql);

            if ($data === null)
            {
                $sth->execute();
            }
            else
            {
                $sth->execute($data);
            }

            return true;
        } catch (PDOException $e) {
            return $e->getMessage();
        }
	}
}