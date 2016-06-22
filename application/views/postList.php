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
							<th><a href="" data-sort="id">ID</a></th>
							<th><a href="" data-sort="title">标题</a></th>
							<th><a href="" data-sort="content">内容</a></th>
							<th><a href="" data-sort="tags">标签</a></th>
							<th><a href="" data-sort="status">状态</a></th>
							<th>作者</th>
							<th class="action-column">操作</th>
						</tr>

						<tr id="w0-filters" class="filters">
							<td><input type="text" class="form-control" name="PostSearch[id]"></td>
							<td><input type="text" class="form-control" name="PostSearch[title]"></td>
							<td><input type="text" class="form-control" name="PostSearch[content]"></td>
							<td><input type="text" class="form-control" name="PostSearch[tags]"></td>
							<td><input type="text" class="form-control" name="PostSearch[status]"></td>
							<td>&nbsp;</td><td>&nbsp;</td>
						</tr>
					</thead>
					<tbody>
						<tr data-key="42">
							<td>42</td>
							<td>Yii2.0视频教程</td>
							<td>这是内容</td>
							<td>Yii2,视频教程</td>
							<td>已发布</td>
							<td>魏曦</td>
							<td>
								<a href="" title="查看" aria-label="查看" data-pjax="0"><span class="glyphicon glyphicon-eye-open"></span></a> 
								<a href="" title="更新" aria-label="更新" data-pjax="0"><span class="glyphicon glyphicon-pencil"></span></a> 
								<a href="" title="删除" aria-label="删除" data-confirm="您确定要删除此项吗？" data-method="post" data-pjax="0"><span class="glyphicon glyphicon-trash"></span></a>
							</td>
						</tr>
					</tbody>
				</table>
			</div>
    	</div>
	</div>
</div>

<?php $this->load->view('layout/foot'); ?>