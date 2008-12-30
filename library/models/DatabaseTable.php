<?php
class DatabaseTable extends Codexscape_Database_Table 
{

	public function save()
	{
		global $sql;
		if ($this->_id) {
			$sql->db_Update("e107dkp_databases", "name='".$this->_name."' WHERE id=".$this->_id);	
		} else {
			$sql->db_Insert("e107dkp_databases", array('name' => $this->_name));
			$sql->db_Select("e107dkp_databases", "*", "name='".$this->_name."'");
			$row = $sql->db_Fetch();
			$this->_id = $row['id'];
		}
	}

}
