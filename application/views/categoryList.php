<?php $this->load->view('layout/topNav'); ?>

    <div class="container">
    	<div class="post-index">
    		<h1>文章管理</h1>
    
	    	<p>
	        <a class="btn btn-success" href="<?=site_url('UserController/userCreate')?>">增加会员</a>
	        </p>

	    	<div id="w0" class="grid-view">
		    	<div class="summary">第<b>1-8</b>条，共<b>11</b>条数据.</div>
				<table class="table table-striped table-bordered">
					<thead>
						<tr>
							<th>分类名称</th>
							<th>操作</th>
						</tr>
					</thead>
					<tbody>
						<?php foreach ($data as $value): ?>
							<tr>
							<td><?php echo str_repeat('-',8*$value['level']) . $value['cat_name']; ?></td>
							<td>
								<a href="" title="查看" aria-label="查看" data-pjax="0"><span class="glyphicon glyphicon-eye-open"></span></a> 
								<a href="" title="更新" aria-label="更新" data-pjax="0"><span class="glyphicon glyphicon-pencil"></span></a> 
								<a href="" title="删除" aria-label="删除" data-confirm="您确定要删除此项吗？" data-method="post" data-pjax="0"><span class="glyphicon glyphicon-trash"></span></a>
							</td>
							</tr>
						<?php endforeach; ?>				
					</tbody>
				</table>
			</div>
    	</div>
	</div>
</div>

<script type="text/javascript">
	jQuery(document).ready(function () {
		jQuery('#w0').yiiGridView({"filterUrl":"\/index.php\/UserController\/userList?","filterSelector":"#w0-filters input, #w0-filters select"});
	});
	//抽时间要理解get上面url乱码
</script>

<?php $this->load->view('layout/foot'); ?>