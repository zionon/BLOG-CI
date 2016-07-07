<?php $this->load->view('layout/topNav.php'); ?>

<div class="container">
    <ul class="breadcrumb">
    	<li><a href="">首页</a></li>
		<li><a href="<?=site_url('PostController/postList')?>">文章管理</a></li>
		<li class="active">新增文章</li>
	</ul>        

	<div class="post-create">
		<h1>新增文章</h1>
		<div class="post-form">
			<form id="w0" action="<?=site_url('PostController/postCreate')?>" method="post">
				<div class="form-group field-post-title required" style="width: 30%;">
					<label class="control-label" for="post-title">标题</label>
					<input type="text" id="post-title" class="form-control" name="Post[title]" maxlength="128" value="<?=set_value('Post[title]')?>" />
					<?php $error = form_error('Post[title]'); ?>
			        <span style="color:#F00;font-weight:bold;"><?=$error?></span>

					<div class="help-block"></div>
				</div>

 				<div class="form-group fiele-post-category required" style="width: 30%;">
					<label class="control-label" for="post-category">分类</label>
					<select name="Post[cat_id]" class="form-control">
						<option>请选择</option>
                        <?php foreach ($tree as $value): ?>
                            <option value="<?=$value['id']?>"><?php echo str_repeat('-', 4*$value['level']) . $value['cat_name']; ?></option>
                        <?php endforeach; ?>
					</select>
					<button class="btn btn-success"><a href="<?=site_url('CategoryController/categoryCreate')?>">增加分类</a></button>
				</div>

				<div class="form-group field-post-content required">
					<label class="control-label" for="post-content">内容</label>
					<!-- <textarea id="post-content" class="form-control" name="Post[content]" rows="6"><?=set_value('Post[content]')?></textarea> -->
					<!-- <textarea id="editor" name="Post[content]" placeholder="Hello world" autofocus></textarea> -->
					<textarea id="textarea1" name="Post[content]" style="height: 400px">
						<p>Hello World....</p>
					</textarea>
					<?php $error = form_error('Post[content]'); ?>
					<span style="color:#F00;font-weight:bold;"><?=$error?></span>

					<div class="help-block"></div>
				</div>

				<div class="form-group field-post-tags required">
					<label class="control-label" for="post-tags">标签</label>
					<input type="text" id="post-tags" class="form-control" name="Post[tags]" style="color: #F00;" placeholder="多个标签之间用,号隔开" />
					<?php $error = form_error('Post[tags]'); ?>
					<span style="color: #F00;font-weight: bold;"><?=$error?></span>
					<div class="help-block"></div>
				</div>
				<div class="form-group field-post-status required" style="width: 10%">
					<label class="control-label" for="post-status">状态</label>
					<select id="post-status" class="form-control" name="Post[status]">
					<option value="1">草稿</option>
					<option value="2">已发布</option>
					<option value="3">已归档</option>
					</select>
				<div class="help-block"></div>
				</div>

				<div class="form-group">
				    <button type="submit" class="btn btn-success"> 新 增 </button>    
				</div>
			</form>
		</div>
	</div>
</div>


</div>
<?php $this->load->view('layout/foot'); ?>
<!-- <link rel="stylesheet" type="text/css" href="<?=_PUBLIC?>/simditor-2.3.6/styles/simditor.css" />
<script type="text/javascript" src="<?=_PUBLIC?>/simditor-2.3.6/scripts/module.js"></script>
<script type="text/javascript" src="<?=_PUBLIC?>/simditor-2.3.6/scripts/hotkeys.js"></script>
<script type="text/javascript" src="<?=_PUBLIC?>/simditor-2.3.6/scripts/uploader.js"></script>
<script type="text/javascript" src="<?=_PUBLIC?>/simditor-2.3.6/scripts/simditor.js"></script>
<script type="text/javascript">
	var editor = new Simditor({
		textarea: $('#editor')
	});
</script> -->

<!--引入wangEditor.css-->
<link rel="stylesheet" type="text/css" href="<?=_PUBLIC?>/wangEditor-2.1.13/dist/css/wangEditor.min.css">

<!--引入jquery和wangEditor.js-->   <!--注意：javascript必须放在body最后，否则可能会出现问题-->
<script type="text/javascript" src="<?=_PUBLIC?>/wangEditor-2.1.13/dist/js/wangEditor.min.js"></script>
<script type="text/javascript">
	var editor = new wangEditor('textarea1');
	editor.config.uploadImgUrl = 'http://www.blog.com/public/wangEditor-2.1.13/uploadfiles/upload.php';
	editor.config.uploadImgFileName = 'file'
	editor.create();
</script>

<script type="text/javascript" src="<?=_PUBLIC?>/js/yii.activeForm.js"></script>
<script type="text/javascript" src="<?=_PUBLIC?>/js/yii.validation.js"></script>
<script type="text/javascript">
jQuery(document).ready(function () {
jQuery('#w0').yiiActiveForm([{"id":"post-title","name":"title","container":".field-post-title","input":"#post-title","validate":function (attribute, value, messages, deferred, $form) {yii.validation.required(value, messages, {"message":"标题不能为空。"});yii.validation.string(value, messages, {"message":"标题必须是一条字符串。","max":128,"tooLong":"标题只能包含至多128个字符。","skipOnEmpty":1});}},{"id":"post-content","name":"content","container":".field-post-content","input":"#post-content","validate":function (attribute, value, messages, deferred, $form) {yii.validation.required(value, messages, {"message":"内容不能为空。"});yii.validation.string(value, messages, {"message":"内容必须是一条字符串。","skipOnEmpty":1});}},{"id":"post-tags","name":"tags","container":".field-post-tags","input":"#post-tags","validate":function (attribute, value, messages, deferred, $form) {yii.validation.string(value, messages, {"message":"标签必须是一条字符串。","skipOnEmpty":1});}},{"id":"post-status","name":"status","container":".field-post-status","input":"#post-status","validate":function (attribute, value, messages, deferred, $form) {yii.validation.required(value, messages, {"message":"状态不能为空。"});yii.validation.number(value, messages, {"pattern":/^\s*[+-]?\d+\s*$/,"message":"状态必须是整数。","skipOnEmpty":1});}}], []);

});
</script>





















