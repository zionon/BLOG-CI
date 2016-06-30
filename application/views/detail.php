<?php $this->load->view('layout/topNav'); ?>
<div class="container">
	<div class="container">
		<div class="row">
			<div class="col-md-9">		
				<ol class="breadcrumb">
				  <li><a href="<?=site_url('welcome')?>">首页</a></li>
				  <li><a href="<?=site_url('welcome')?>">文章列表</a></li>
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
						<a href="">评论 (<?=count($comment)?>)</a> |
						最后修改于 <?=date('Y-m-d H:i:s', $update_time)?>	
					</div>
				</div>
				<div id="comments">
<!-- 					<div class="alert alert-danger alert-dismissible fade in" role="alert">
				      <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
				      <h4>谢谢您的回复，我会尽快审核后将其展现出来！</h4>
						<span class="glyphicon glyphicon-user" aria-hidden="true"></span> <em>hj:</em>
						<p>u 很健康很健康</p>
						<span class="glyphicon glyphicon-time" aria-hidden="true"></span> <em>2016-06-28 23:37:32</em>	
				    </div> -->
					<h5><?=count($comment)?>条评论</h5>
					<?php foreach ($comment as $value): ?>
						<div class="comment">
							<div class="row">
							  <div class="col-md-12">
								  <div class="comment_detail">
								  <p class="bg-info">						  
								  	<span class="glyphicon glyphicon-user" aria-hidden="true"></span> <em><?=$value['author']?>:</em>							
								    <br><?=$value['content']?><br>
								  	<span class="glyphicon glyphicon-time" aria-hidden="true"></span> <em><?=date('Y-m-d H:i:s', $value['create_time'])?></em>	
								  </p>
								  </div>
							  </div>
							</div>
						</div>
					<?php endforeach ?>
	
					<h5>发表评论</h5>						
					<div class="comment-form">
					    <form id="w0">
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
						    <div>
						        <input type="button" value="提交评论"  class="comment_btn btn btn-success" />	   
						    </div>					    
					    </form>
					</div>
				</div>				
			</div>

			<div class="col-md-3">
				<?php $this->load->view('layout/tags', $tag); ?>
				<?php $this->load->view('layout/comment', $comments); ?>
			</div>
		</div>
	</div>
</div>


</div>

<?php $this->load->view('layout/foot'); ?>

<script type="text/javascript" src="<?=_PUBLIC?>/js/yii.activeForm.js"></script>
<script type="text/javascript" src="<?=_PUBLIC?>/js/yii.validation.js"></script>
<script type="text/javascript">
$(document).ready(function () {
$('#w0').yiiActiveForm([{"id":"comment-author","name":"author","container":".field-comment-author","input":"#comment-author","validate":function (attribute, value, messages, deferred, $form) {yii.validation.required(value, messages, {"message":"作者不能为空。"});yii.validation.string(value, messages, {"message":"作者必须是一条字符串。","max":128,"tooLong":"作者只能包含至多128个字符。","skipOnEmpty":1});}},{"id":"comment-email","name":"email","container":".field-comment-email","input":"#comment-email","validate":function (attribute, value, messages, deferred, $form) {yii.validation.required(value, messages, {"message":"邮箱不能为空。"});yii.validation.string(value, messages, {"message":"邮箱必须是一条字符串。","max":128,"tooLong":"邮箱只能包含至多128个字符。","skipOnEmpty":1});}},{"id":"comment-url","name":"url","container":".field-comment-url","input":"#comment-url","validate":function (attribute, value, messages, deferred, $form) {yii.validation.string(value, messages, {"message":"网址必须是一条字符串。","max":128,"tooLong":"网址只能包含至多128个字符。","skipOnEmpty":1});}},{"id":"comment-content","name":"content","container":".field-comment-content","input":"#comment-content","validate":function (attribute, value, messages, deferred, $form) {yii.validation.required(value, messages, {"message":"内容不能为空。"});yii.validation.string(value, messages, {"message":"内容必须是一条字符串。","skipOnEmpty":1});}}], []);
});
//AJAX发表评论
$(".comment_btn").click(function(){
	//先接收表单中的数据，并拼成这样格式的字符串:name=tom&age=231
	var form = $("#w0");
	var formData = form.serialize();
	$.ajax({
		type : "POST",
		url : "<?=site_url('CommentController/commentCreate');?>",
		data : formData,	//表单中要提交的数据
		dataType : "json",	//服务器返回的数据格式
		success : function(data){
			//清空表单
			form.trigger("reset");	//触发表单的reset事件
			var html = '<div id="alert-comment" class="alert alert-danger alert-dismissible fade in" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button><h4>谢谢您的回复，我会尽快审核后将其展现出来</h4><span class="glyphicon glyphicon-user" aria-hidden="true"></span> <em>'+data.author+':</em><p>'+data.content+'</p><span class="glyphicon glyphicon-time" aria-hidden="true"></span> <em>'+data.create_time+'</em></div>';
			//把整个评论的字符串转化成jq的对象
			html = $(html);
			//把拼好的评论放到页面中
			$("#comments").prepend(html);

			//动画滚动
			$('html, body').animate({scrollTop: $("#comments").offset().top-$("#alert-comment").height()}, 500); 
		}
	});
});
</script>















