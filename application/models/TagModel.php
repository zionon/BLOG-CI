<?php
class TagModel extends MY_Model
{
	protected $_tableName = 'tag';
	protected $_insertFiles = array('name','frequency');

	public function search() {
		$this->db->order_by('frequency','desc');
		$data = $this->db->get($this->_tableName)->result();
		// static $oldCount = '';
		$count = count($data)/5 + 1;
		$tagsArray = array_chunk($data, $count);
		foreach ($tagsArray[0] as $key => $value) {
			$tagsH2[$key] = '<a href="'.site_url('Welcome/index?PostSearch[tags]='.$value->name).'"><h2 style="display: inline-block;"><span class="label label-success">'.$value->name.'</span></h2></a>';
		}
		foreach ($tagsArray[1] as $key => $value) {
			$tagsH3[$key] = '<a href="'.site_url('Welcome/index?PostSearch[tags]='.$value->name).'"><h3 style="display: inline-block;"><span class="label label-primary">'.$value->name.'</span></h3></a>';
		}
		foreach ($tagsArray[2] as $key => $value) {
			$tagsH4[$key] = '<a href="'.site_url('Welcome/index?PostSearch[tags]='.$value->name).'"><h4 style="display: inline-block;"><span class="label label-warning">'.$value->name.'</span></h4></a>';
		}
		foreach ($tagsArray[3] as $key => $value) {
			$tagsH5[$key] = '<a href="'.site_url('Welcome/index?PostSearch[tags]='.$value->name).'"><h5 style="display: inline-block;"><span class="label label-info">'.$value->name.'</span></h5></a>';
		}
		foreach ($tagsArray[4] as $key => $value) {
			$tagsH6[$key] = '<a href="'.site_url('Welcome/index?PostSearch[tags]='.$value->name).'"><h6 style="display: inline-block;"><span class="label label-danger">'.$value->name.'</span></h6></a>';
		}
		$tags = array_merge($tagsH2, $tagsH3, $tagsH4, $tagsH5, $tagsH6);
		shuffle($tags);
		// var_dump($tags);
		// echo "<br />";
		// var_dump($data);die;
		return $tags;
	}

	public function add() {
		$tagsArray = array("PHP","Composer","教程","安装","查询构建器","模型","Laravel","CI3","Controller","Linux","数组","字符串","转换");
		foreach ($tagsArray as $value) {
			$data = array(
				'name' => $value,
				'frequency' => rand(1,200),
			);
			$this->db->insert($this->_tableName, $data);
			echo "插入成功，值为$value";
		}
	}

	private function tags($array) {

	}
}