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
					<br />
					<div class="content">
						<?=$content?>
					</div>
					<br />					
					<div class="nav">
						<span class="glyphicon glyphicon-tag" aria-hidden="true"></span> 
						<a href=""><?=$tags?></a>			
						<br/>
						<a href="">评论 (<?=$num?>)</a> |
						最后修改于 <?=date('Y-m-d H:i:s', $update_time)?>	
					</div>
				</div>
					
				<hr />

				<div id="comments">
					<div id="comments-list"></div>
<!-- 					<div class="alert alert-danger alert-dismissible fade in" role="alert">
				      <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
				      <h4>谢谢您的回复，我会尽快审核后将其展现出来！</h4>
						<span class="glyphicon glyphicon-user" aria-hidden="true"></span> <em>hj:</em>
						<p>u 很健康很健康</p>
						<span class="glyphicon glyphicon-time" aria-hidden="true"></span> <em>2016-06-28 23:37:32</em>	
				    </div> -->
					<!-- <h5><?=count($comment)?>条评论</h5> -->
<!-- 					<?php foreach ($comment as $value): ?>
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
					<?php endforeach ?> -->

					<ul class="pagination" id="comment-pagination">

					</ul>

					<hr />
					<h5>发表评论</h5>						
					<div class="comment-form">
					    <form id="w0">
							<input type="hidden" name="Comment[post_id]" value="<?=$id?>" />    
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
<!-- 						        <button type="submit" class="comment_btn btn btn-success">发 布</button>  -->  
						    </div>					    
					    </form>
					</div>
				</div>
				<ul class="pagination" id="post-pagination"></ul>
						
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

	//内容的缓存，每页内容的缓存:格式:[[页码,标示,'内容数据','翻页'],[3,'xxxx','xxxxx']]
	//缓存到客户端浏览器的内容
	var cache = [];
	var post_id = <?php echo $id ?>;
	//获取某一页缓存
	function getCache(page,name) {
		for (var i = 0; i < cache.length; i++) {
			if (cache[i][0] == page && cache[i][1] == name) {
				return cache[i];
			}
		}
		return false;
	}

	//ajax获取所有评论
	function ajaxGetComment(page) {
		var c = getCache(page,'comment');
		console.log(c);
		if (c !== false && c[1] == 'comment') {
			$('#comments-list').html(c[2]);
			$('.pagination').html(c[3]);
			$(document.body).animate({'scrollTop':0},1000);
			// console.log(c);
			return;
		}
		$.ajax({
			type : "GET",
			url : "<?=site_url('welcome/ajaxGetComment')?>?p="+page+"&post_id="+post_id,
			dataType : "json",
			success : function(data){
				createPost(data,page,'comment');
			}
		});
	}
	ajaxGetComment(1);

	//接收服务器返回后拼接字符串,并显示
	function createPost(data,page,mark){
		// console.log(data);
		var html ="";
		var name = mark;
		var replyHtml = "";
		$(data.data).each(function(key,value){
			if (!$.isEmptyObject(data.reply[key])) {
				if (data.reply[key][0].comment_id == value.id) {
					$(data.reply[key]).each(function(key1,value1){
						replyHtml += '<div class="comment"><div class="row"><div class="col-md-11" style="float: right"><div class="comment_detail"><p class="bg-info"><span class="glyphicon glyphicon-user" aria-hidden="true"></span> <em>'+value1.author+':</em><br>'+value1.contents+'<br><span class="glyphicon glyphicon-time" aria-hidden="true"></span> <em>'+value1.create_time+'</em></p></div></div></div></div>';
					})
				}
			}
            html += '<div class="comment" id="comment-id-'+value.id+'"><div class="row"><div class="col-md-12"><div class="comment_detail"><p class="bg-info"><span>#'+key+'</span><span class="glyphicon glyphicon-user" aria-hidden="true"></span> <em>'+value.author+':</em><br>'+value.content+'<br><span class="glyphicon glyphicon-time" aria-hidden="true"></span> <em>'+value.create_time+'</em><a onclick="reply('+value.id+')" href="javascript:void(0)">回复</a></p></div></div></div></div>'+replyHtml;
            replyHtml = "";
		});
		//放到页面中覆盖原数据
		$("#comments-list").html(html);

		//根据总的页数，拼出翻页字符串
		var pageString = data.page;

		$('#comment-pagination').html(pageString);
		//放到缓存中
		// console.log(html);
		cache.push([page, mark, html, pageString]);
		console.log(cache);
		$(document.body).animate({'scrollTop':0},1000);
	}

//AJAX发表评论
$(".comment_btn").click(function(){
	//先接收表单中的数据，并拼成这样格式的字符串:name=tom&age=231
	var form = $("#w0");
	var formData = form.serialize();
	$.ajax({
		type : "POST",
		url : "<?=site_url('WelcomeController/ajaxPushComment');?>",
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

//ajax获取tag标签日志
function ajaxGetTagPost(page,tag,id){
	// console.log(cache);
	var c = getCache(page,tag);
	console.log(c);
	if (c !== false && c[1] == tag) {
		$('#postList').html(c[2]);
		$('.pagination').html(c[3]);
		$(document.body).animate({'scrollTop':0},1000);
		return;
	}		
	$.ajax({
		type : "GET",
		url : "<?=site_url('welcome/ajaxGetTagPost')?>?p="+page+"&PostSearch[tags]="+tag,
		dataType : "json",
		success : function(data){
			// console.log(data);
			var html ="";
			var name = tag;
			$(data.data).each(function(key,value){
				//拼标签
				var tagshtml = "";
				$(value.tags).each(function(key1,value1){
					tagshtml += '<span class="glyphicon glyphicon-tag" aria-hidden="true"></span><a href="">'+value1+'</a>';
				});
		        html += '<div class="post-id" data-key="'+value.id+'"><div class="post"><div class="title"><h2><a href="/index.php/welcome/detail?id='+value.id+'">'+value.title+'</a></h2><div class="author"><span class="glyphicon glyphicon-time" aria-hidden="true"></span> <em>'+value.create_time+'&nbsp;&nbsp;&nbsp;&nbsp;</em><span class="glyphicon glyphicon-user" aria-hidden="true"></span> <em>'+value.username+'</em></div></div><br /><div class="content">'+value.content+'</div><br /><div class="nav">'+tagshtml+'<br/><a href="/index.php/welcome/detail?id='+value.id+'">评论 ('+data.num[value.id]+')</a> |最后修改于 '+value.update_time+'</div></div><hr /></div>'
			});
			//放到页面中覆盖原数据
			$(".post").html(html);

			$(".breadcrumb li:last").remove();
			$(".breadcrumb li:last a").remove();
			$(".breadcrumb li:last").text('文章列表');
			$(".col-md-9 > hr").remove();
			$("#comments").remove();

			//根据总的页数，拼出翻页字符串
			var pageString = data.page;

			$('#post-pagination').html(pageString);

			//放到缓存中
			cache.push([page, tag, html, pageString]);
			$(document.body).animate({'scrollTop':0},1000);
		}
	});
}

function reply(id) {
	$(".comment-form").hide();
	$("h5").hide();
	var comId = "#comment-id-"+id;
	var html = '<h5>发表回复</h5>	<div class="comment-form"><form id="w0"><input type="hidden" name="Reply[comment_id]" value="'+id+'" /><div class="row"><div class="col-md-4"><div class="form-group field-comment-author required"><label class="control-label" for="comment-author">作者</label><input type="text" id="comment-author" class="form-control" name="Reply[author]" maxlength="128"><div class="help-block"></div></div></div><div class="col-md-4"><div class="form-group field-comment-email required"><label class="control-label" for="comment-email">邮箱</label><input type="text" id="comment-email" class="form-control" name="Reply[email]" maxlength="128"><div class="help-block"></div></div></div></div><div class="row"><div class="col-md-12"><div class="form-group field-comment-content required"><label class="control-label" for="comment-content">内容</label><textarea id="comment-content" class="form-control" name="Reply[contents]" rows="6"></textarea><div class="help-block"></div></div></div></div><div><input type="button" value="提交评论"  class="btn btn-success" onclick="pushReply()" /></div></form></div><hr />';
	$(comId).after(html);
}

function pushReply() {
		//先接收表单中的数据，并拼成这样格式的字符串:name=tom&age=231
	var form = $("#w0");
	var formData = form.serialize();
	$.ajax({
		type : "POST",
		url : "<?=site_url('WelcomeController/ajaxPushReply');?>",
		data : formData,	//表单中要提交的数据
		dataType : "json",	//服务器返回的数据格式
		success : function(data){
			$("#comments-list h5 + div").remove();
			$("#comments-list h5").remove();
			$("#comments-list hr:first").remove();
			//清空表单
			form.trigger("reset");	//触发表单的reset事件
			var html = '<div id="alert-comment" class="alert alert-danger alert-dismissible fade in" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close" onclick="closeReplay"><span aria-hidden="true">×</span></button><h4>谢谢您的回复，我会尽快审核后将其展现出来</h4><span class="glyphicon glyphicon-user" aria-hidden="true"></span> <em>'+data.author+':</em><p>'+data.contents+'</p><span class="glyphicon glyphicon-time" aria-hidden="true"></span> <em>'+data.create_time+'</em></div>';
			//把整个评论的字符串转化成jq的对象
			html = $(html);
			//把拼好的评论放到页面中
			$("#comments").prepend(html);

			//动画滚动
			$('html, body').animate({scrollTop: $("#comments").offset().top-$("#alert-comment").height()}, 500);

			$(".comment-form").show();
			$("h5").show();
		}
	});
}

$(".reply_btn").click(function(){
	//先接收表单中的数据，并拼成这样格式的字符串:name=tom&age=231
	var form = $("#w0");
	var formData = form.serialize();
	$.ajax({
		type : "POST",
		url : "<?=site_url('WelcomeController/ajaxPushReply');?>",
		data : formData,	//表单中要提交的数据
		dataType : "json",	//服务器返回的数据格式
		success : function(data){
			//清空表单
			console.log(data);
			form.trigger("reset");	//触发表单的reset事件
			var html = '<div id="alert-comment" class="alert alert-danger alert-dismissible fade in" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close" onclick="closeReplay"><span aria-hidden="true">×</span></button><h4>谢谢您的回复，我会尽快审核后将其展现出来</h4><span class="glyphicon glyphicon-user" aria-hidden="true"></span> <em>'+data.author+':</em><p>'+data.content+'</p><span class="glyphicon glyphicon-time" aria-hidden="true"></span> <em>'+data.create_time+'</em></div>';
			//把整个评论的字符串转化成jq的对象
			html = $(html);
			//把拼好的评论放到页面中
			$("#comments").prepend(html);

			//动画滚动
			$('html, body').animate({scrollTop: $("#comments").offset().top-$("#alert-comment").height()}, 500); 
		}
	});
});

function closeReplay() {
	$(".comment-form").show();
	$("h5").show();
}

</script>















