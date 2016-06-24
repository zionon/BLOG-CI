<?php $this->load->view('layout/topNav.php'); ?>

<div class="container">
    <ul class="breadcrumb">
    	<li><a href="">首页</a></li>
		<li><a href="">文章管理</a></li>
		<li class="active">新增文章</li>
	</ul>        

	<div class="post-create">
		<h1>新增文章</h1>
		<div class="post-form">
			<form id="w0" action="<?=site_url('PostController/postCreate')?>" method="post">
		<!-- 		<input type="hidden" name="_csrf" value="RDB0NmpwNUx1RjFmWxV9Hxx7Hkw6IHc9G14WTg01fykDZx8BHBJmFg==" /> -->
				<div class="form-group field-post-title required">
					<label class="control-label" for="post-title">标题</label>
					<input type="text" id="post-title" class="form-control" name="Post[title]" maxlength="128" value="<?=set_value('Post[title]')?>" />
					<?php $error = form_error('Post[title]'); ?>
			        <span style="color:#F00;font-weight:bold;"><?=$error?></span>

					<div class="help-block"></div>
				</div>

				<div class="form-group field-post-content required">
					<label class="control-label" for="post-content">内容</label>
					<textarea id="post-content" class="form-control" name="Post[content]" rows="6"><?=set_value('Post[content]')?></textarea>
					<?php $error = form_error('Post[content]'); ?>
					<span style="color:#F00;font-weight:bold;"><?=$error?></span>

					<div class="help-block"></div>
				</div>
		<!-- 		<div class="form-group field-post-tags">
				<label class="control-label" for="post-tags">标签</label>
				<textarea id="post-tags" class="form-control" name="Post[tags]" rows="6"></textarea>

				<div class="help-block"></div>
				</div> -->
		<!-- 		<div class="form-group field-post-status required">
				<label class="control-label" for="post-status">状态</label>
				<select id="post-status" class="form-control" name="Post[status]">
				<option value="1">草稿</option>
				<option value="2">已发布</option>
				<option value="3">已归档</option>
				</select>

				<div class="help-block"></div>
				</div> -->

				<div class="form-group">
				    <button type="submit" class="btn btn-success"> 新 增 </button>    
				</div>
			</form>
		</div>
	</div>
</div>



</div>
<?php $this->load->view('layout/foot'); ?>