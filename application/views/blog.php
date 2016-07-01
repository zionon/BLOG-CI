<?php $this->load->view('layout/topNav'); ?>

    <div class="container">
 		<div class="container">
			<div class="row">
				<div class="col-md-9">
					<ol class="breadcrumb">
					  <li><a href="<?=site_url('welcome')?>">首页</a></li>
					  <li>文章列表</li>
					</ol>
				
					<div id="postList" class="list-view">
<!-- 						<?php if($data->result()): ?>
							<?php foreach($data->result() as $key => $value): ?>
								<div class="post-id" data-key="<?=$value->id?>">
									<div class="post">
										<div class="title">
											<h2><a href="<?=site_url('Welcome/detail?id='.$value->id)?>"><?=$value->title?></a></h2>
											<div class="author">
												<span class="glyphicon glyphicon-time" aria-hidden="true"></span> <em><?=date('Y-m-d H:i:s',$value->create_time)?>&nbsp;&nbsp;&nbsp;&nbsp;</em>
												<span class="glyphicon glyphicon-user" aria-hidden="true"></span> <em><?=$value->username?></em>
											</div>
										</div>
									<br />
										<div class="content">
											<?=$value->content?>
										</div>
									<br />
										<div class="nav">
 											<?php foreach($value->tags as $tag): ?>
												<span class="glyphicon glyphicon-tag" aria-hidden="true"></span>
												<a href=""><?=$tag?></a>
											<?php endforeach; ?>		
											<br/>
											<a href="">评论 (<?=$num[$value->id]?>)</a> |
											最后修改于 <?=date('Y-m-d H:i:s',$value->update_time)?>
										</div>
									</div>
								<hr />
								</div>
							<?php endforeach; ?>
						<?php else: ?>
							<p>暂时还没有文章</p>
						<?php endif; ?>		 -->			
					</div>

					<ul class="pagination">

					</ul>
				</div>																

				<div class="col-md-3">
					<?php $this->load->view('layout/tags', $tags); ?>						
					<?php $this->load->view('layout/comment', $comments); ?>
				</div>
			</div>			
		</div>
	</div>
<!--     </div> -->
</div>


<?php $this->load->view('layout/foot'); ?>

<script type="text/javascript">
	//内容的缓存，每页内容的缓存:格式:[[页码，'内容数据','翻页'],[3,'xxxx','xxxxx']]
	//缓存到客户端浏览器的内容
	var cache = [];
	//获取某一页缓存
	function getCache(page) {
		for (var i = 0; i < cache.length; i++) {
			if (cache[i][0] == page) {
				return cache[i];
			}
		}
		return false;
	}
	function ajaxGetPost(page) {
		var c = getCache(page);
		console.log(c);
		if (c !== false) {
			$('#postList').html(c[1]);
			$('.pagination').html(c[2]);
			$(document.body).animate({'scrollTop':0},1000);
			return;
		}
		$.ajax({
			type : "GET",
			url : "<?=site_url('welcome/ajaxGetPost')?>?p="+page,
			dataType : "json",
			success : function(data){
				// console.log(data);
				var html ="";
				$(data.data).each(function(key,value){
					//拼标签
					var tagshtml = "";
					$(value.tags).each(function(key1,value1){
						tagshtml += '<span class="glyphicon glyphicon-tag" aria-hidden="true"></span><a href="">'+value1+'</a>';
					});
                    html += '<div class="post-id" data-key="'+value.id+'"><div class="post"><div class="title"><h2><a href="/index.php/welcome/detail?id='+value.id+'">'+value.title+'</a></h2><div class="author"><span class="glyphicon glyphicon-time" aria-hidden="true"></span> <em>'+value.create_time+'&nbsp;&nbsp;&nbsp;&nbsp;</em><span class="glyphicon glyphicon-user" aria-hidden="true"></span> <em>'+value.username+'</em></div></div><br /><div class="content">'+value.content+'</div><br /><div class="nav">'+tagshtml+'<br/><a href="">评论 ('+data.num[value.id]+')</a> |最后修改于 '+value.update_time+'</div></div><hr /></div>'
				});
				//放到页面中覆盖原数据
				$("#postList").html(html);

				//根据总的页数，拼出翻页字符串
				var pageString = data.page;

				$('.pagination').html(pageString);

				//放到缓存中
				cache.push([page, html, pageString]);
				$(document.body).animate({'scrollTop':0},1000);

			}
		});
	}
	ajaxGetPost(1);
</script>

















