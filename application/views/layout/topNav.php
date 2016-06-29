
<!DOCTYPE html>
<html lang="zh-CN">


<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-param" content="_csrf">
<!--     <meta name="csrf-token" content="XzBCeE5fM0puRgcofzp7GQd7KAIeD3E7AF4gACkaeS8YZylPOD1gEA=="> -->
    <title>文章管理</title>
    <link href="<?=_PUBLIC?>/css/bootstrap.css" rel="stylesheet">
	<link href="<?=_PUBLIC?>/css/site.css" rel="stylesheet">    
	<style type="text/css">
		.navbar-inverse .navbar-brand {color: #fff;}
	</style>
	<script src="<?=_PUBLIC?>/js/jquery.js"></script>
	<script src="<?=_PUBLIC?>/js/yii.js"></script>
	<script src="<?=_PUBLIC?>/js/yii.gridView.js"></script>
	<script src="<?=_PUBLIC?>/js/bootstrap.js"></script>	
</head>
<body>

<div class="wrap">
    <nav id="w1" class="navbar-inverse navbar-fixed-top navbar" role="navigation">
	    <div class="container">
		    <div class="navbar-header">
			    <!-- <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#w1-collapse"><span class="sr-only">Toggle navigation</span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span></button> -->
				<a class="navbar-brand" href="<?site_url('Welcome/index')?>">CodeIgniter博客</a>
			</div>
			<div id="w1-collapse" class="collapse navbar-collapse">
				<ul id="w2" class="navbar-nav navbar-right nav">
					<li><a href="<?=site_url('welcome/index')?>">首页</a></li>
					<?php if(count($_SESSION) == 5): ?>
						<li><a href="<?=site_url('PostController/postList')?>">文章管理</a></li>
						<li><a href="<?=site_url('CommentController/commentList')?>">评论管理</a></li>
						<li><a href="<?=site_url('UserController/userList')?>">会员管理</a></li>
						<li><a href="<?=site_url('UserController/logout')?>">退出(<?=$_SESSION['username'];?>)</a></li>
					<?php elseif(count($_SESSION) == 4): ?>
						<li><a href="">我的收藏</a></li>
						<li><a href="">我的评论</a></li>
						<li><a href="">我的提问</a></li>
						<li><a href="<?=site_url('UserController/logout')?>">退出(<?=$_SESSION['username'];?>)</a></li>
					<?php else: ?>
						<li><a href="">关于博主</a></li>
						<li><a href="<?=site_url('UserController/register')?>">注册</a></li>
						<li><a href="<?=site_url('UserController/login')?>">登录</a></li>
					<?php endif; ?>
				</ul>
			</div>
		</div>
	</nav>