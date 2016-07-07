<?php $this->load->view('layout/topNav'); ?>

    <div class="container">
    	<ul class="breadcrumb">
			<li><a href="<?=site_url('WelcomeController')?>">首页</a></li>
			<li class="active">分类管理</li>
		</ul>  
    	<div class="post-index">
    		<h1>分类管理</h1>

	    	<div id="w0" class="grid-view">
				<table class="table table-striped table-bordered">
					<thead>
						<tr>
							<th>分类名称</th>
							<th>操作</th>
						</tr>
					</thead>
					<tbody>
						<?php foreach ($tree as $value): ?>
							<tr>
							<td><?php echo str_repeat('-',8*$value['level']) . $value['cat_name']; ?></td>
							<td>
								<a href="<?=site_url('CategoryController/categoryUpdate/'.$value['id'])?>" title="更新" aria-label="更新" data-pjax="0"><span class="glyphicon glyphicon-pencil"></span></a> 
								<a href="<?=site_url('CategoryController/categoryDelete/'.$value['id'])?>" title="删除" aria-label="删除" data-confirm="您确定要删除此项吗？" data-method="post" data-pjax="0"><span class="glyphicon glyphicon-trash"></span></a>
							</td>
							</tr>
						<?php endforeach; ?>				
					</tbody>
				</table>
			</div>

			<p>
	        <a class="btn btn-success" href="<?=site_url('CategoryController/categoryCreate')?>">增加分类</a>
	        </p>
    	</div>
	</div>
</div>

<?php $this->load->view('layout/foot'); ?>