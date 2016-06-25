<?php
class TestModel extends MY_Model
{
	protected $_tableName = 'post';
	public function create() {
		$titleTotal = rand(4,10);
		$titleNum = array();
		$titleString = '';
		for ($i=0; $i < $titleTotal; $i++) { 
			// $ds = rand(1,23940);
			// $hex = dechex($ds);
			$titleNum[$i] = rand(1,23940);
		}

		// $titleString = "&#x8FD9;&#x662F;&#x6807;&#x9898;&#xFF0C;&#x8FD9;&#x662F;&#x5185;&#x5BB9;";
		var_dump($titleNum);die;
		$titleString = html_entity_decode($titleString); 
		var_dump($titleString);die;
		// $test = 0b111001001011100010100101;
		// $test = utf8_decode($test);
		// var_dump($titleString);die;
		$data = array();
		$data['title'] = $titleString;
		$data['content'] = '美国，人类的希望';
		$data['create_time'] = time();
		$data['update_time'] = time();
		$data['author_id'] = 3;
		$this->db->insert($this->_tableName, $data);
		return $data['id'] = $this->db->insert_id();
	}
}