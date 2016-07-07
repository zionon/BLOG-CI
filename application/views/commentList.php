<?php $this->load->view('layout/topNav'); ?>

    <div class="container">
        <ul class="breadcrumb">
			<li><a href="<?=site_url('WelcomeController')?>">首页</a></li>
			<li class="active">评论管理</li>
		</ul> 
    	<div class="post-index">
    		<h1>评论管理</h1>
	    	<div id="w0" class="grid-view">
		    	<div class="summary"><?php if($count) echo $count; ?></div>
		    <form id="commentCheck" class="form-horizontal" action="<?=site_url('CommentController/commentCheck')?>" method="post">
				<table class="table table-striped table-bordered">
					<thead>
						<tr>
							<th style="width: 5%">
							<a <?php if($odby['key'] == 'id') echo $odby['odbyString']; else echo 'href="'.site_url('CommentController/commentList?sort=id').'" data-sort="id"'; ?> >ID</a>
							</th>
							<th>
							<a <?php if($odby['key'] == 'content') echo $odby['odbyString']; else echo 'href="'.site_url('CommentController/commentList?sort=content').'" data-sort="content"'; ?> >内容</a>
							</th>
							<th style="width: 10%">
							<a <?php if($odby['key'] == 'status') echo $odby['odbyString']; else echo 'href="'.site_url('CommentController/commentList?sort=status').'" data-sort="status"'; ?> >状态</a>
							</th>
							<th>
							<a <?php if($odby['key'] == 'create_time') echo $odby['odbyString']; else echo 'href="'.site_url('CommentController/commentList?sort=create_time').'" data-sort="create_time"'; ?> >发表时间</a>
							</th>						
							<th>作者</th>
							<th>标题</th>
							<th class="action-column">操作</th>
						</tr>

						<tr id="w0-filters" class="filters">
							<td><input type="text" class="form-control" name="CommentSearch[id]" value="<?=$this->input->get('CommentSearch[id]')?>"></td>
							<td><input type="text" class="form-control" name="CommentSearch[content]" value="<?=$this->input->get('CommentSearch[content]')?>"></td>
							<td>				
								<select id="comment-status" class="form-control" name="CommentSearch[status]">
								<?php $status=$this->input->get('CommentSearch[status]'); ?>
								<option value="0">全部</option>
								<option value="1" <?php if($status == 1) echo 'selected="selected"'; ?> >待审核</option>
								<option value="2" <?php if($status == 2) echo 'selected="selected"'; ?> >已审核</option>
								</select>
							</td>
<!-- 							<td><input type="text" name="CommentSearch[update_time]" class="form-control" value="<?=$this->input->get('CommentSearch[update_time]')?>"></td> -->
							<td>&nbsp;</td>
							<td>&nbsp;</td>
							<td>&nbsp;</td>
							<td>&nbsp;</td>
						</tr>
					</thead>
					<tbody>
						<?php if($data->result()): ?>
							<?php foreach ($data->result() as $key => $value): ?>
								<tr data-key="<?=$value->id?>">
									<td><?=$value->id?></td>
									<td><?=$value->content?></td>
								 	<td <?php if($value->status == 1) echo 'class="bg-danger"' ?>><?=$value->name?></td>
								 	<td><?=date('Y-m-d H:i:s',$value->create_time)?></td>
								 	<td><?=$value->author?></td>
								 	<td><?=$value->title?></td>
									<td>
										<a href="<?=site_url('CommentController/commentDetail/'.$value->id)?>" title="查看" aria-label="查看" data-pjax="0"><span class="glyphicon glyphicon-eye-open"></span></a> 
										<a href="<?=site_url('CommentController/commentDelete/'.$value->id)?>" title="删除" aria-label="删除" data-confirm="您确定要删除此项吗？" data-method="post" data-pjax="0"><span class="glyphicon glyphicon-trash"></span></a>
										<a href="<?=site_url('CommentController/commentChk/'.$value->id)?>" title="审核" aria-label="审核" data-pjax="0" data-confirm="确定要审核吗?"><span class="glyphicon glyphicon-check"></span></a>
										<input type="checkbox" name="CommentCheck[]" value="<?=$value->id?>" />
									</td>
								</tr>
							<?php endforeach; ?>
						<?php else : ?>
							<tr><td colspan="8"><div class="empty">没有找到数据。</div></td></tr>
						<?php endif; ?>
					</tbody>
				</table>
				<div>
					<input type="submit" value="确定审核"  class="comment_btn btn btn-success" data-confirm="确定要审核吗?" />
				</div>
			</form>
				<!-- <input type="button" value="提交评论"  class="comment_btn btn btn-success" />	    -->
				<ul class="pagination">
					<?=$page?>
				</ul>
			</div>
    	</div>
	</div>
</div>

<?php $this->load->view('layout/foot'); ?>
<script type="text/javascript">
	jQuery(document).ready(function () {
		jQuery('#w0').yiiGridView({"filterUrl":"\/index.php\/comment\/commentList?","filterSelector":"#w0-filters input, #w0-filters select"});
	});
	//抽时间要理解get上面url乱码
</script>