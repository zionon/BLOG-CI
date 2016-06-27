<?php
class TestController extends CI_Controller
{
	public function add() {
		$this->load->model('TestModel','tm');
		if ($this->tm->create()) {
			echo "插入成功";
		} else {
			echo "插入失败";
		}
	}

	public function begin($row) {
		if ($row) {
			$this->load->model('TestModel','tm');
			for ($i=0; $i < (int)$row; $i++) {
				$num = $i + 1; 
				if ($this->tm->create()) {
					$num = $i + 1;
					echo "插入成功,行数{$num}";
					echo "<br />";
				} else {
					echo "插入失败,行数{$num}";
					echo "<br />";
				}
			}
		} else {
			echo "需要插入的行数";
		}
	}
}