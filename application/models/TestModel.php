<?php
class TestModel extends MY_Model
{
	protected $_tableName = 'post';
	public function create() {
		$titleString = $this->title(4,10);
		$authorId = $this->authorId(1,7);
		$data = array();
		$data['title'] = $titleString;
		$data['content'] = '美国，人类的希望';
		$data['create_time'] = time();
		$data['update_time'] = time();
		$data['author_id'] = $authorId;
		$this->db->insert($this->_tableName, $data);
		return $data['id'] = $this->db->insert_id();
	}

	private function title($min, $max) {
		$titleTotal = rand($min, $max);
		$titleNum = array();
		$titleString = '';
		for ($i=0; $i < $titleTotal; $i++) { 
			$titleNum[$i] = rand(1, 23940);
		}
		$this->db->select('cjk');
		$this->db->where_in('id', $titleNum);
		$unicode = $this->db->get('ci_cp936');
		foreach ($unicode->result() as $value) {
			$titleString .= '&#x'.$value->cjk.';';
		}
		$titleString = html_entity_decode($titleString);
		return $titleString;
	}

	private function createTime() {

	}

	private function authorId($min, $max) {
		$authorId = rand($min, $max);
		return $authorId;
	}
}

















