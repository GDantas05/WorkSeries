<?php 
	/**
	* 
	*/
	class Create extends Conn
	{
		private $tabela;
		private $dados;
		private $result;

		private $create;

		private $conn;

		/**
		 * @param STRING $tabela nome da tabela do banco de dados
		 * @param ARRAY $dados array com os dados que serão inseridos na tabela
		 */
		public function exeCreate($tabela, array $dados)
		{
			$this->tabela = $tabela;
			$this->dados  = $dados;

			$this->getSyntax();
			$this->execute();
		}

		/**
		 * Retorna null caso algum erro ocorra ou retorna o ID do último dado inserido na tabela
		 */
		public function getResult()
		{
			return $this->result;
		}

		private function connect()
		{
			$this->conn   = parent::getConn();
			$this->create = $this->conn->prepare($this->create);
		}

		private function getSyntax()
		{
			$fields = implode(', ', array_keys($this->dados));
			$places = ':'.implode(', :', array_keys($this->dados));
			$this->create = "INSERT INTO {$this->tabela} ({$fields}) VALUES ({$places})";
		}

		private function execute()
		{
			$this->connect();

			try {
				$this->create->execute($this->dados);
				$this->result = $this->conn->lastInsertId();
			} catch (PDOException $e) {
				$this->result = null;
				WSErro("<b>Erro ao cadastrar: </b> {$e->getMessage()}", $e->getCode());
			}
		}
	}