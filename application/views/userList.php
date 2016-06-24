<?php $this->load->view('layout/topNav'); ?>

    <div class="container">
    	<div class="post-index">
    		<h1>文章管理</h1>
    
	    	<p>
	        <a class="btn btn-success" href="<?=site_url('postController/postCreate')?>">新建文章</a>
	        </p>

	    	<div id="w0" class="grid-view">
		    	<div class="summary">第<b>1-8</b>条，共<b>11</b>条数据.</div>
				<table class="table table-striped table-bordered">
					<thead>
						<tr>
							<th>
							<a <?php if($odby['key'] == 'id') echo $odby['odbyString']; else echo 'href="'.site_url('UserController/userList?sort=id').'" data-sort="id"'; ?> >ID</a>
							</th>
							<th>
							<a <?php if($odby['key'] == 'username') echo $odby['odbyString']; else echo 'href="'.site_url('UserController/userList?sort=username').'" data-sort="username"'; ?> >用户名</a>
							</th>
							<th>
							<a <?php if($odby['key'] == 'email') echo $odby['odbyString']; else echo 'href="'.site_url('UserController/userList?sort=email').'" data-sort="email"'; ?> >邮  箱</a>
							</th>
			<!-- 				<th><a href="" data-sort="tags">标签</a></th>
							<th><a href="" data-sort="status">状态</a></th> -->
							<th>
							<a <?php if($odby['key'] == 'update_time') echo $odby['odbyString']; else echo 'href="'.site_url('UserController/userList?sort=update_time').'" data-sort="update_time"'; ?>>修改时间</a>
							</th>							
							<th>注册时间</th>
							<!-- <th>作者</th> -->
							<th class="action-column">操作</th>
						</tr>

						<tr id="w0-filters" class="filters">
							<td><input type="text" class="form-control" name="UserSearch[id]" value="<?=$this->input->get('UserSearch[id]')?>"></td>
							<td><input type="text" class="form-control" name="UserSearch[username]" value="<?=$this->input->get('UserSearch[username]')?>"></td>
							<td><input type="text" class="form-control" name="UserSearch[email]" value="<?=$this->input->get('UserSearch[email]')?>"></td>
						<!-- 	<td><input type="text" class="form-control" name="PostSearch[tags]"></td>
							<td><input type="text" class="form-control" name="PostSearch[status]"></td> -->
							<td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><!-- <td>&nbsp;</td> -->
						</tr>
					</thead>
					<tbody>
 						<?php foreach ($data->result() as $key => $value): ?>
							<tr data-key="<?=$value->id?>">
								<td><?=$value->id?></td>
								<td><?=$value->username?></td>
							 	<td><?=$value->email?></td>
							 	<td><?=date('Y-m-d H:i:s',$value->update_time)?></td>
								<td><?=date('Y-m-d H:i:s',$value->register_time)?></td>
								<td>
								<a href="<?=site_url('UserController/UserDetail/'.$value->id)?>" title="查看" aria-label="查看" data-pjax="0"><span class="glyphicon glyphicon-eye-open"></span></a> 
								<a href="<?=site_url('UserController/UserUpdate/'.$value->id)?>" title="更新" aria-label="更新" data-pjax="0"><span class="glyphicon glyphicon-pencil"></span></a> 
								<a href="<?=site_url('UserController/UserDelete/'.$value->id)?>" title="删除" aria-label="删除" data-confirm="您确定要删除此项吗？" data-method="post" data-pjax="0"><span class="glyphicon glyphicon-trash"></span></a>
								</td>
							</tr>
						<?php endforeach; ?>					
					</tbody>
				</table>
				<ul class="pagination">
					<?=$page?>
<!-- 					<li class="prev disabled"><span>&laquo;</span></li>
					<li class="active"><a href="/blog2/web/index.php?r=post%2Findex&amp;page=1&amp;per-page=8" data-page="0">1</a></li>
					<li><a href="/blog2/web/index.php?r=post%2Findex&amp;page=2&amp;per-page=8" data-page="1">2</a></li>
					<li class="next"><a href="/blog2/web/index.php?r=post%2Findex&amp;page=2&amp;per-page=8" data-page="1">&raquo;</a></li> -->
				</ul>
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