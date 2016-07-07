<?php $this->load->view('layout/topNav'); ?>
    <div class="container">
		<ul class="breadcrumb">
			<li><a href="<?=site_url('WelcomeController')?>">首页</a></li>
			<li><a href="<?=site_url('UserController/userList')?>">用户管理</a></li>
			<li class="active"><?=$username?></li>
		</ul>        
		<div class="post-view">
			<h1><?=$username?></h1>
			<p>
				<a class="btn btn-primary" href="<?=site_url('UserController/userUpdate/'.$id)?>">修改</a> 
				<a class="btn btn-danger" href="<?=site_url('UserController/userDelete/'.$id)?>" data-confirm="Are you sure you want to delete this item?" data-method="post">删除</a>    
			</p>

			<table id="w0" class="table table-striped table-bordered detail-view">
				<tr>
					<th>ID</th>
					<td><?=$id?></td>
				</tr>
				<tr>
					<th>用户名</th>
					<td><?=$username?></td>
				</tr>
				<tr>
					<th>密  码</th>
					<td><?=$password?></td>
				</tr>
				<tr>
					<th>邮  箱</th>
					<td><?=$email?></td>
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
					<th>注册时间</th>
					<td><?=date('Y-m-d H:i:s',$register_time)?></td>
				</tr>
				<tr>
					<th>修改时间</th>
					<td><?=date('Y-m-d H:i:s',$update_time)?></td>
				</tr>
			</table>
		</div>
    </div>

</div>

<?php $this->load->view('layout/foot'); ?>