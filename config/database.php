<?php

	class Database {

		private $db_name;
		private $db_user;
		private $db_pass;
		private $db_host;
		private $pdo;

		public function __construct($db_name, $db_user = 'root', $db_pass = 'root', $db_host = 'localhost') {

			$this->db_name = $db_name;
			$this->db_user = $db_user;
			$this->db_pass = $db_pass;
			$this->db_host = $db_host;

		}

		public function getPDO() {

			if ($this->pdo === null) {
				$pdo = new PDO('mysql:dbname=camagru;host=localhost', 'root', 'root');
				$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
				$this->pdo = $pdo;
			}
			return $this->pdo;

		}

		public function sql_select($statement) {

			$req = $this->getPDO()->query($statement);
			$res = $req->fetchAll(PDO::FETCH_OBJ);
			return $res;

		}

		public function user_exists($username) {
			$req = $this->pdo->prepare("SELECT id FROM users WHERE username = ?");
			$req->execute($username);
			$res = $req->fetchALL(PDO::FETCH_OBJ);
			return $res;
		}

		public function mail_exists($mail) {
			$req = $this->pdo->prepare("SELECT id FROM users WHERE mail = ?");
			$req->execute($mail);
			$res = $req->fetchALL(PDO::FETCH_OBJ);
			return $res;
		}
	}
	
?>