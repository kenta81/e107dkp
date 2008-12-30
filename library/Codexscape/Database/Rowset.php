<?php
class Codexscape_Database_Rowset implements Iterator
{
	
	private $_data;
	private $_parentTable;
	
	public function __construct($data, $parentTable)
	{
		if (!is_array($data))
			throw new Exception("Codex_Database_Rowset requires that the data passed in be an array.");
			
		$this->_data = $data;
		$this->_parentTable = $parentTable;
	}
	
	public function getParentTable()
	{
		return $this->_parentTable;
	}
	
	public function rewind() 
	{
		reset($this->_data);
	}
	
	public function current()
	{
		$current = current($this->_data);
		if ($current)
		{
			if (isset($this->_parentTable->RowClass))
				return new $this->_parentTable->RowClass(current($this->_data, $this->_parentTable));
				
			return new Codexscape_Database_Row(current($this->_data), $this->_parentTable);
		}
		else
			return false;
	}
	
	public function next()
	{
		return next($this->_data);
	}
	
	public function key()
	{
		return key($this->_data);
	}
	
	public function valid()
	{
		return (bool)$this->current();
	}
	
	public function count()
	{
		$count = 0;
		
		foreach ($this as $elem)
			$count++;
			
		$this->rewind();
		
		return $count;
	}
	
}