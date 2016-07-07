<?php $this->load->view('layout/topNav'); ?>
    <div class="container">
		<ul class="breadcrumb">
			<li><a href="<?=site_url('WelcomeController')?>">首页</a></li>
			<li><a href="<?=site_url('ReplyController/replyList')?>">回复管理</a></li>
			<li>回复详情</li>
		</ul>        
		<div class="post-view">
			<p>
				<a class="btn btn-primary" href="<?=site_url('ReplyController/replyUpdate/'.$id)?>">修改</a> 
				<a class="btn btn-danger" href="" data-confirm="Are you sure you want to delete this item?" data-method="post">删除</a>    
			</p>

			<table id="w0" class="table table-striped table-bordered detail-view">
				<tr>
					<th style="width: 8%;">ID</th>
					<td><?=$id?></td>
				</tr>
				<tr>
					<th>评论内容</th>
					<td><?=$content?></td>
				</tr>
				<tr>
					<th>回复内容</th>
					<th><?=$contents?></th>
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