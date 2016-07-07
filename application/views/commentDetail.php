<?php $this->load->view('layout/topNav'); ?>
    <div class="container">
		<ul class="breadcrumb">
			<li><a href="<?=site_url('WelcomeController')?>">首页</a></li>
			<li><a href="<?=site_url('CommentController/commentList')?>">评论管理</a></li>
			<li class="active"><?=$title?></li>
		</ul>        
		<div class="post-view">
			<h1><?=$title?></h1>
			<p>
				<a class="btn btn-primary" href="<?=site_url('CommentController/commentUpdate/'.$id)?>">修改</a> 
				<a class="btn btn-danger" href="" data-confirm="Are you sure you want to delete this item?" data-method="post">删除</a>    
			</p>

			<table id="w0" class="table table-striped table-bordered detail-view">
				<tr>
					<th style="width: 8%;">ID</th>
					<td><?=$id?></td>
				</tr>
				<tr>
					<th>内容</th>
					<td><?=$content?></td>
				</tr>
				<tr>
					<th>文章标题</th>
					<th><?=$title?></th>
				</tr>
				<tr>
					<th>作者</th>
					<th><?=$author?></th>
				</tr>
				<tr>
					<th>邮箱</th>
					<th><?=$email?></th>
				</tr>
				<tr>
					<th>状态</th>
					<td><?=$name?></td>
				</tr>
				<tr>
					<th>发布时间</th>
					<td><?=date('Y-m-d H:i:s', $create_time)?></td>
				</tr>
			</table>
		</div>
    </div>

</div>

<?php $this->load->view('layout/foot'); ?>