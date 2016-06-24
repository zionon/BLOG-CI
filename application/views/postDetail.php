<?php $this->load->view('layout/topNav'); ?>
    <div class="container">
		<ul class="breadcrumb">
			<li><a href="/blog2/web/index.php">首页</a></li>
			<li><a href="/blog2/web/index.php?r=post%2Findex">文章管理</a></li>
			<li class="active"><?=$title?></li>
		</ul>        
		<div class="post-view">
			<h1><?=$title?></h1>
			<p>
				<a class="btn btn-primary" href="">修改</a> 
				<a class="btn btn-danger" href="" data-confirm="Are you sure you want to delete this item?" data-method="post">删除</a>    
			</p>

			<table id="w0" class="table table-striped table-bordered detail-view">
				<tr>
					<th>ID</th>
					<td><?=$id?></td>
				</tr>
				<tr>
					<th>标题</th>
					<td><?=$title?></td>
				</tr>
				<tr>
					<th>内容</th>
					<td><?=$content?></td>
				</tr>
<!-- 				<tr>
					<th>标签</th>
					<td>Yii2,视频教程,教程</td>
				</tr>
				<tr>
					<th>状态</th>
					<td>草稿</td>
				</tr> -->
				<tr>
					<th>创建时间</th>
					<td><?=date('Y-m-d H:i:s',$create_time)?></td>
				</tr>
				<tr>
					<th>修改时间</th>
					<td><?=date('Y-m-d H:i:s',$update_time)?></td>
				</tr>
<!-- 				<tr>
					<th>作者</th>
					<td>魏曦</td>
				</tr> -->
			</table>
		</div>
    </div>

</div>

<?php $this->load->view('layout/foot'); ?>