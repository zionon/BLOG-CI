<?php $this->load->view('layout/topNav'); ?>
<div class="container">
	<div class="container">
		<div class="row">
			<div class="col-md-9">		
				<ol class="breadcrumb">
				  <li><a href="/blog2/web/index.php">首页</a></li>
				  <li><a href="/blog2/web/index.php?r=post/home">文章列表</a></li>
				  <li class="active"><?=$title?></li>
				</ol>

				<div class="post">
					<div class="title">
						<h2><a href=""><?=$title?></a></h2>					
						<div class="author">
							<span class="glyphicon glyphicon-time" aria-hidden="true"></span> <em><?=date('Y-m-d H:i:s', $create_time)?>&nbsp;&nbsp;&nbsp;&nbsp;</em>
							<span class="glyphicon glyphicon-user" aria-hidden="true"></span> <em><?=$username?></em>
						</div>
					</div>
					<br>
					<div class="content">
						<?=$content?>
					</div>
					<br>					
					<div class="nav">
						<span class="glyphicon glyphicon-tag" aria-hidden="true"></span> 
						<a href=""><?=$tags?></a>
						<!-- <a href="">ListView</a>	 -->			
						<br/>
						<a href="">评论 (0)</a> |
						最后修改于 <?=date('Y-m-d H:i:s', $update_time)?>	
					</div>
				</div>
	
				<div id="comments">
					<h5>发表评论</h5>						
					<div class="comment-form">
					    <form id="w0" action="<?=site_url('CommentController/commentCreate')?>" method="post">
							<input type="hidden" name="Comment[post_id]" value=<?=$id?> />    
							<div class="row"> 
								<div class="col-md-4">
									<div class="form-group field-comment-author required">
										<label class="control-label" for="comment-author">作者</label>
										<input type="text" id="comment-author" class="form-control" name="Comment[author]" maxlength="128">
										<div class="help-block"></div>
									</div>			
								</div>
								<div class="col-md-4">
									<div class="form-group field-comment-email required">
										<label class="control-label" for="comment-email">邮箱</label>
										<input type="text" id="comment-email" class="form-control" name="Comment[email]" maxlength="128">
										<div class="help-block"></div>
									</div>			
								</div>
							</div>
							<div class="row">
								<div class="col-md-12">
									<div class="form-group field-comment-content required">
										<label class="control-label" for="comment-content">内容</label>
										<textarea id="comment-content" class="form-control" name="Comment[content]" rows="6"></textarea>
										<div class="help-block"></div>
									</div>			
								</div>
							</div>							
					    <div class="form-group">
					        <button type="submit" class="btn btn-success">发 布</button>    
					    </div>
					    
					    </form>
					</div>
				</div>				
			</div>

			<div class="col-md-3">
				<?php $this->load->view('layout/tags', $tag); ?>
				<?php $this->load->view('layout/comment'); ?>
			</div>
		</div>
	</div>
</div>


</div>

<?php $this->load->view('layout/foot'); ?>

<script type="text/javascript" src="<?=_PUBLIC?>/js/yii.activeForm.js"></script>
<script type="text/javascript" src="<?=_PUBLIC?>/js/yii.validation.js"></script>
<script type="text/javascript">
jQuery(document).ready(function () {
jQuery('#w0').yiiActiveForm([{"id":"comment-author","name":"author","container":".field-comment-author","input":"#comment-author","validate":function (attribute, value, messages, deferred, $form) {yii.validation.required(value, messages, {"message":"作者不能为空。"});yii.validation.string(value, messages, {"message":"作者必须是一条字符串。","max":128,"tooLong":"作者只能包含至多128个字符。","skipOnEmpty":1});}},{"id":"comment-email","name":"email","container":".field-comment-email","input":"#comment-email","validate":function (attribute, value, messages, deferred, $form) {yii.validation.required(value, messages, {"message":"邮箱不能为空。"});yii.validation.string(value, messages, {"message":"邮箱必须是一条字符串。","max":128,"tooLong":"邮箱只能包含至多128个字符。","skipOnEmpty":1});}},{"id":"comment-url","name":"url","container":".field-comment-url","input":"#comment-url","validate":function (attribute, value, messages, deferred, $form) {yii.validation.string(value, messages, {"message":"网址必须是一条字符串。","max":128,"tooLong":"网址只能包含至多128个字符。","skipOnEmpty":1});}},{"id":"comment-content","name":"content","container":".field-comment-content","input":"#comment-content","validate":function (attribute, value, messages, deferred, $form) {yii.validation.required(value, messages, {"message":"内容不能为空。"});yii.validation.string(value, messages, {"message":"内容必须是一条字符串。","skipOnEmpty":1});}}], []);
});
</script>