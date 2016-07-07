<?php $this->load->view('layout/topNav'); ?>

    <div class="container">
    	<ul class="breadcrumb">
			<li><a href="<?=site_url('welcomeController/index')?>">首页</a></li>
			<li class="active">文章管理</li>
		</ul>  
    	<div class="post-index">
    		<h1>文章管理</h1>
    
	    	<p>
	        <a class="btn btn-success" href="<?=site_url('postController/postCreate')?>">新建文章</a>
	        </p>

	    	<div id="w0" class="grid-view">
		    	<div class="summary"><?php if($count) echo $count; ?></div>
				<table class="table table-striped table-bordered">
					<thead>
						<tr>
							<th style="width: 5%">
							<a <?php if($odby['key'] == 'id') echo $odby['odbyString']; else echo 'href="'.site_url('PostController/postList?sort=id').'" data-sort="id"'; ?> >ID</a>
							</th>
							<th>
							<a <?php if($odby['key'] == 'title') echo $odby['odbyString']; else echo 'href="'.site_url('PostController/postList?sort=title').'" data-sort="title"'; ?> >标题</a>
							</th>
							<th style="width: 10%">
							<a <?php if($odby['key'] == 'username') echo $odby['odbyString']; else echo 'href="'.site_url('PostController/postList?sort=username').'" data-sort="username"'; ?> >作者</a>
							</th>
			<!-- 				<th><a href="" data-sort="tags">标签</a></th>
							<th><a href="" data-sort="status">状态</a></th> -->
							<th>
							<a <?php if($odby['key'] == 'update_time') echo $odby['odbyString']; else echo 'href="'.site_url('PostController/postList?sort=update_time').'" data-sort="update_time"'; ?> >修改时间</a>
							</th>
							<th>标签</th>
							<th>分类</th>							
							<th>状态</th>
							<th>添加时间</th>
							<!-- <th>作者</th> -->
							<th class="action-column">操作</th>
						</tr>

						<tr id="w0-filters" class="filters">
							<td><input type="text" class="form-control" name="PostSearch[id]" value="<?=$this->input->get('PostSearch[id]')?>"></td>
							<td><input type="text" class="form-control" name="PostSearch[title]" value="<?=$this->input->get('PostSearch[title]')?>"></td>
							<td><input type="text" class="form-control" name="PostSearch[content]" value="<?=$this->input->get('PostSearch[author_id]')?>"></td>
							<td><input type="" name="" class="form-control"></td>
							<td><input type="text" name="PostSearch[tags]" class="form-control" value="<?=$this->input->get('PostSearch[tags]')?>"></td>
							<td>
								<select class="form-control" name="PostSearch[cat_id]">
									<option value="0">全部</option>
				                    <?php foreach ($tree as $value): 
				                    	if ($value['id'] == $this->input->get('PostSearch[cat_id]')) {
				                    		$select = 'selected="selected"';
				                    	} else {
				                    		$select = '';
				                    	}
				                    ?>
				                        <option <?=$select?> value="<?=$value['id']?>"><?php echo str_repeat('-', 4*$value['level']) . $value['cat_name']; ?></option>
				                    <?php endforeach; ?>
                    			</select>
							</td>
							<td>				
								<select id="post-status" class="form-control" name="PostSearch[status]">
								<?php $status=$this->input->get('PostSearch[status]'); ?>
								<option value="0">全部</option>
								<option value="1" <?php if($status == 1) echo 'selected="selected"'; ?> >草稿</option>
								<option value="2" <?php if($status == 2) echo 'selected="selected"'; ?> >已发布</option>
								<option value="3" <?php if($status == 3) echo 'selected="selected"'; ?> >已归档</option>
								</select>
							</td>
						<!-- 	<td><input type="text" class="form-control" name="PostSearch[tags]"></td>
							<td><input type="text" class="form-control" name="PostSearch[status]"></td> -->
							<td>&nbsp;</td>
							<td>&nbsp;</td><!-- <td>&nbsp;</td><td>&nbsp;</td> --><!-- <td>&nbsp;</td> -->
						</tr>
					</thead>
					<tbody>
						<?php if($data->result()): ?>
							<?php foreach ($data->result() as $key => $value): ?>
								<tr data-key="<?=$value->id?>">
									<td><?=$value->id?></td>
									<td><?=$value->title?></td>
								 	<td><?=$value->username?></td>
								 	<td><?=date('Y-m-d H:i:s',$value->update_time)?></td>
								 	<td><?=$value->tags?></td>
								 	<td><?=$value->cat_name?></td>
								 	<td><?=$value->name?></td>
									<td><?=date('Y-m-d H:i:s',$value->create_time)?></td>
									<td>
									<a href="<?=site_url('PostController/postDetail/'.$value->id)?>" title="查看" aria-label="查看" data-pjax="0"><span class="glyphicon glyphicon-eye-open"></span></a> 
									<a href="<?=site_url('PostController/postUpdate/'.$value->id)?>" title="更新" aria-label="更新" data-pjax="0"><span class="glyphicon glyphicon-pencil"></span></a> 
									<a href="<?=site_url('PostController/postDelete/'.$value->id)?>" title="删除" aria-label="删除" data-confirm="您确定要删除此项吗？" data-method="post" data-pjax="0"><span class="glyphicon glyphicon-trash"></span></a>
									</td>
								</tr>
							<?php endforeach; ?>
						<?php else : ?>
							<tr><td colspan="9"><div class="empty">没有找到数据。</div></td></tr>
						<?php endif; ?>
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


<?php $this->load->view('layout/foot'); ?>

<script type="text/javascript">
	jQuery(document).ready(function () {
		jQuery('#w0').yiiGridView({"filterUrl":"\/index.php\/post\/postList?","filterSelector":"#w0-filters input, #w0-filters select"});

	});
	//抽时间要理解get上面url乱码	
</script>
