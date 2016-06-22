
<!DOCTYPE html>
<html lang="zh-CN">


<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-param" content="_csrf">
    <meta name="csrf-token" content="XzBCeE5fM0puRgcofzp7GQd7KAIeD3E7AF4gACkaeS8YZylPOD1gEA==">
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
	<script type="text/javascript">
		jQuery(document).ready(function () {
		jQuery('#w0').yiiGridView({"filterUrl":"\/blog2\/web\/index.php?r=post%2Findex","filterSelector":"#w0-filters input, #w0-filters select"});
		});
	</script>   	
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
				<a class="navbar-brand" href="/blog2/web/index.php">CodeIgniter博客</a>
			</div>
			<div id="w1-collapse" class="collapse navbar-collapse">
				<ul id="w2" class="navbar-nav navbar-right nav">
					<li><a href="<?=site_url('PostController/postList')?>">首页</a></li>
					<li class="active"><a href="/blog2/web/index.php?r=post%2Findex">文章管理</a></li>
					<li><a href="/blog2/web/index.php?r=comment%2Findex">评论管理</a></li>
					<li><span class="badge badge-inverse">1</span></li>
					<li><a href="/blog2/web/index.php?r=comment%2Findex">博客参数</a></li>
					<li><a href="/blog2/web/index.php?r=site%2Fabout">关于博主</a></li>
					<li><a href="/blog2/web/index.php?r=site%2Flogout" data-method="post">退出 (admin)</a></li>
				</ul>
			</div>
		</div>
	</nav>