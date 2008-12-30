<?php
class Codexscape_Database_Row
{
	
	private $_data;
	private $_parentTable;
	
	public function __construct($data, $parentTable)
	{
		if (!is_array($data))
			throw new Exception("Data being passed to a CodexscapeDatabaseRow object must be an array.");
			
		$this->_data = $data;
		$this->_parentTable = $parentTable;
	}
	
	public function getParentTable()
	{
		return $this->_parentTable;
	}
	
	public function __get($key)
	{
		return $this->_data[$key];
	}
	
	public function __set($key, $value)
	{
		if (in_array($key, $this->_parentTable->ValidColumns))
			$this->_data[$key] = $value;
	}
	
	public function save()
	{
		global $sql;
		
		if (isset($this->_data['id']))
		{
			$i = 0;
			foreach (array_keys($this->_data) as $key)
			{
				$i++;
				if ($key == "id")
					continue;
				
				$updatestring .= "$key = '{$this->_data[$key]}'";
				
				if ($i != count($this->_data))
					$updatestring .= ", ";
				else
					$updatestring .= " ";
			}
			$updatestring .= "WHERE id = {$this->_data['id']}";
			
			$sql->db_Update($this->_parentTable->TableName, $updatestring);
			
			if (method_exists($this->_parentTable, "onUpdate"))
				call_user_func(array($this->_parentTable, "onUpdate"));
		}
		else
		{
			$this->_data['id'] = $sql->db_Insert($this->_parentTable->TableName, $this->_data);
		}
	}
	
	public function delete()
	{
		global $sql;
		if (isset($this->_data['id']))
		{
			$sql->db_Delete($this->_parentTable->TableName, "id = {$this->_data['id']}");
			
			if (method_exists($this->_parentTable, "onDelete"))
				call_user_func(array($this->_parentTable, "onDelete"));
		}
	}
	
}
?>