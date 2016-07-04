<?php
//无限级分类模型
class CategoryModel extends MY_Model
{
	protected $_tableName = 'category';
	protected $_insertFields = array('cat_name','parent_id');

	public function categoryString() {
		$tree = $this->getTree();
		$caArray = array();
		foreach ($tree as $value) {
			$name = str_repeat('-',8*$value['level']).$value['cat_name'];
			$cat = "'".$value['id']."'";
			$caArray[] = '<p><a onclick="ajaxGetCatPost(1,'.$cat.')" href="javascript:void(0)">'.$name.'</a></p>';
		}
		return $caArray;
	}

	//找一个分类所有子分类的ID
	public function getChildren($catId) {
		$this->db->from($this->_tableName);
		//取出所有的分类
		$data = $this->db->get();
		//递归从所有的分类中挑出子分类的ID
		return $this->_getChildren($data, $catId, TRUE);
	}

	private function _getChildren($data, $catId, $isClear = FALSE) {
		static $_ret = array();		//保存找到的子分类的ID
		if ($isClear) {
			$_ret = array();
		}
		//循环所有的分类找子分类
		foreach ($data->result('array') as $k => $v) {
			if ($v['parent_id'] == $catId) {
				$_ret[] = $v['id'];
				//再找这个$v的子分类
				$this->_getChildren($data,$v['id']);
			}
		}
		return $_ret;
	}

	public function getTree() {
		$this->db->from($this->_tableName);
		$data = $this->db->get();
		return $this->_getTree($data);
	}

	private function _getTree($data, $parent_id=0, $level=0) {
		static $_ret = array();
		foreach ($data->result('array') as $k => $v) {
			if ($v['parent_id'] == $parent_id) {
				$v['level'] = $level;	//用来标记这个分类是第几级的
				$_ret[] = $v;
				//找子类
				$this->_getTree($data,$v['id'],$level+1);
			}
		}
		return $_ret;
	}

	protected function _before_delete($id) {
		$children = $this->getChildren($id);
		if ($children) {
			$this->db->where_in('id', $children);
			if($this->db->delete($this->_tableName)){
				return TRUE;
			} else {
				return FALSE;
			}
		} else {
			return TRUE;
		}
	}
}