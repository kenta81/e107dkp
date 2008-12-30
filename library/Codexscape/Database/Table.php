<?php
abstract class Codexscape_Database_Table
{
	
	private $_sql;
	private $_validColumns;
	
	public function __construct()
	{
		if (isset($this->_rowClass) && !is_subclass_of($this->_rowClass, 'Codexscape_Database_Row'))
			throw new Exception("Any class being used as a custom row class must extend the Codexscape_Database_Row class.");
		
		global $sql;
		if (!$sql)
		{
			$sql = new Db();
			if (!$sql)
				throw new Exception("Unable to obtain e107 database connection.");
		}
		
		$this->_sql = $sql;
		
		$this->_getValidColumns();
		
		if (!in_array("id", $this->_validColumns))
			throw new Exception("The 'id' column must exist in the {$this->_name} database table.");
	}
	
	public function createRow()
	{
		if (isset($this->_rowClass))
			return new $this->_rowClass(array(), $this);
		
		return new Codexscape_Database_Row(array(), $this);
	}
	
	public function fetchAll()
	{
		$this->_sql->db_Select($this->_name);
		return new Codexscape_Database_Rowset($this->_sql->db_getList(), $this);
	}
	
	public function __call($function, $args)
	{
		if (preg_match("/^fetchAllBy/", $function))
		{
			$field = strtolower(preg_replace("/fetchAllBy/", "", $function));
			if (in_array($field, $this->_validColumns))
			{
				$this->_sql->db_Select_gen("SELECT * FROM #{$this->_name} WHERE $field = '{$args[0]}';");
				return new Codexscape_Database_Rowset($this->_sql->db_getList(), $this);
			}
			else
			{
				throw new Exception("The field $field is not specified in the table {$this->_name}.");
			}
		}
		else if (preg_match("/^fetchBy/", $function))
		{
			$field = strtolower(preg_replace("/fetchBy/", "", $function));
			if (in_array($field, $this->_validColumns))
			{
				$this->_sql->db_Select_gen("SELECT * FROM #{$this->_name} WHERE $field = '{$args[0]}';");
				
				if (isset($this->_rowClass))
					return new $this->_rowClass($this->_sql->db_Fetch(MYSQL_ASSOC), $this);
					
				return new Codexscape_Database_Row($this->_sql->db_Fetch(MYSQL_ASSOC), $this);
			}
			else
			{
				throw new Exception("The field $field is not specified in the table {$this->_name}.");
			}
		}
	}
	
	public function __get($key)
	{
		if ($key == "ValidColumns")
			return $this->_validColumns;
		if ($key == "TableName")
			return $this->_name;
		if ($key == "RowClass")
			return $this->_rowClass;
			
		throw new Exception("The requested property, $key, cannot be accessed.");
	}
	
	/**
	 * _getValidColumns() - This function will fetch all of the valid column headers from the table.
	 *
	 * @author Marcus Ramsden <cuscus1986@gmail.com>
	 */
	private function _getValidColumns()
	{
		$this->_sql->db_Select_gen("DESCRIBE #{$this->_name};");
		while ($row = $this->_sql->db_Fetch()) 
		{
			$this->_validColumns[] = $row['Field'];
		}
	}
	
}