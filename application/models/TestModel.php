<?php
class TestModel extends MY_Model
{
	protected $_tableName = 'post';
	public function create() {
		$titleString = $this->randCjk(4,10);
		$contentString = $this->randCjk(50,100);
		$createTime = $this->createTime(1466800000,1467000000);
		$updateTime = $this->updateTime(1466800000,1467000000);
		$authorId = $this->authorId(1,7);
		$data = array();
		$data['title'] = $titleString;
		$data['content'] = $contentString;
		$data['create_time'] = $createTime;
		$data['update_time'] = $updateTime;
		$data['author_id'] = $authorId;
		$this->db->insert($this->_tableName, $data);
		return $data['id'] = $this->db->insert_id();
	}

	private function randCjk($min, $max) {
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

	private function createTime($min, $max) {
		$createTime = rand($min, $max);
		return $createTime;
	}

	private function updateTime($min, $max) {
		$updateTime = rand($min, $max);
		return $updateTime;
	}

	private function authorId($min, $max) {
		$authorId = rand($min, $max);
		return $authorId;
	}
}

















