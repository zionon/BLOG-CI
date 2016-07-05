<?php
class TagModel extends MY_Model
{
	protected $_tableName = 'tag';
	protected $_insertFiles = array('name','frequency');

	public function search() {
		$tags = $this->tagArray();
		$tagString='';
    	//fontstyle 用来显示不同Tag的颜色，比如<h6>用"danger"的底色
    	$fontStyle=array("6"=>"danger","5"=>"info","4"=>"warning","3"=>"primary","2"=>"success");
     	foreach($tags as $tag => $value) {
     		$ajaxTag = "'".$tag."'";
     		$id = "'".$value['id']."'";
     		$tagString.='<a href="javascript:void(0)" onclick="ajaxGetTagPost(1,'.$ajaxTag.','.$id.')">  <h'.$value['style'].' style="display: inline-block;"><span class="label label-'.$fontStyle[$value['style']].'">'.$tag.'</span></h'.$value['style'].'></a>';
     	}		
		return $tagString;
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

	public function addFrequency($id) {
		$this->db->where('id', $id);
		$this->db->select('frequency');
		$oldFrequency = $this->db->get($this->_tableName, FALSE)->result()[0]->frequency;
		$newFrequency = $oldFrequency + 1;
		$data = array(
			'frequency' => $newFrequency
		);
		$this->db->where('id', $id);
		$this->db->update($this->_tableName ,$data);
	}

	private function tagArray() {
		$this->db->limit(20);
		$this->db->order_by('frequency','desc');
		$data = $this->db->get($this->_tableName)->result();
		$total = count($data);

    	$stepper=ceil($total/5); //把标签按个数，平均分组
    
    	$tags=array();
    	$counter=1;
    	
    	if($total>0) {
    		foreach($data as $model) {
    			$weight=ceil($counter/$stepper)+1;
    			$tags[$model->name]['style']=$weight;
    			$tags[$model->name]['id'] = $model->id;
    			$counter++;
	    	}

    		ksort($tags);
    	}
    	return $tags;
	}
}
