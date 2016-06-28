<?php
class TagModel extends MY_Model
{
	protected $_tableName = 'tag';

	public function search() {
		$data = $this->db->get($this->_tableName);
		return $data;
	}
}