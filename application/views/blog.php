<?php $this->load->view('layout/topNav'); ?>

    <div class="container">
 		<div class="container">
			<div class="row">
				<div class="col-md-9">
					<ol class="breadcrumb">
					  <li><a href="/blog2/web/index.php">首页</a></li>
					  <li>文章列表</li>
					</ol>
				
					<div id="postList" class="list-view">
						<?php if($data->result()): ?>
							<?php foreach($data->result() as $key => $value): ?>
								<div data-key="<?=$value->id?>">
									<div class="post">
										<div class="title">
											<h2><a href=""><?=$value->title?></a></h2>
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
										<!-- 	<span class="glyphicon glyphicon-tag" aria-hidden="true"></span> 
											<a href=""><?=$value->tags?></a> -->			
											<br/>
											<a href="">评论 (0)</a> |
											最后修改于 <?=date('Y-m-d H:i:s',$value->update_time)?>
										</div>
									</div>
								<hr />
								</div>
							<?php endforeach; ?>
						<?php else: ?>
							<p>暂时还没有文章</p>
						<?php endif; ?>

					
					</div>

					<ul class="pagination">
						<?=$page?>
					</ul>
				</div>																

				<div class="col-md-3">
					<div class="tags">					
						<ul class="list-group">
				    		<li class="list-group-item">
								<span class="glyphicon glyphicon-tags" aria-hidden="true"></span> 标签
							</li>

							<li class="list-group-item">
								<?php foreach($tags as $value): ?>
									<?=$value?>
								<?php endforeach; ?>
<!-- 								<a href="/blog2/web/index.php?r=post/home&PostSearch[tags]=ActiveRecord"> 
									<h2 style="display: inline-block;"><span class="label label-success">ActiveRecord</span></h2>
								</a>

								<a href="/blog2/web/index.php?r=post/home&PostSearch[tags]=Composer"> 
									<h5 style="display: inline-block;"><span class="label label-info">Composer</span></h5>
								</a>

								<a href="/blog2/web/index.php?r=post/home&PostSearch[tags]=DAO"> 
									<h3 style="display: inline-block;"><span class="label label-primary">DAO</span></h3>
								</a>

								<a href="/blog2/web/index.php?r=post/home&PostSearch[tags]=DetailView"> 
									<h3 style="display: inline-block;"><span class="label label-primary">DetailView</span></h3>
								</a>

								<a href="/blog2/web/index.php?r=post/home&PostSearch[tags]=Gii"> 
									<h4 style="display: inline-block;"><span class="label label-warning">Gii</span></h4>
								</a>

								<a href="/blog2/web/index.php?r=post/home&PostSearch[tags]=GridView"> 
									<h2 style="display: inline-block;"><span class="label label-success">GridView</span></h2>
								</a>

								<a href="/blog2/web/index.php?r=post/home&PostSearch[tags]=ListView"> 
									<h3 style="display: inline-block;"><span class="label label-primary">ListView</span></h3>
								</a>

								<a href="/blog2/web/index.php?r=post/home&PostSearch[tags]=RESTful Web服务"> 
									<h4 style="display: inline-block;"><span class="label label-warning">RESTful Web服务</span></h4>
								</a>

								<a href="/blog2/web/index.php?r=post/home&PostSearch[tags]=Yii"> 
									<h2 style="display: inline-block;"><span class="label label-success">Yii</span></h2>
								</a>

								<a href="/blog2/web/index.php?r=post/home&PostSearch[tags]=Yii2"> 
									<h2 style="display: inline-block;"><span class="label label-success">Yii2</span></h2>
								</a>

								<a href="/blog2/web/index.php?r=post/home&PostSearch[tags]=widget"> <h5 style="display: inline-block;"><span class="label label-info">widget</span></h5></a>

								<a href="/blog2/web/index.php?r=post/home&PostSearch[tags]=安装"> <h5 style="display: inline-block;"><span class="label label-info">安装</span></h5></a>

								<a href="/blog2/web/index.php?r=post/home&PostSearch[tags]=小部件"> <h5 style="display: inline-block;"><span class="label label-info">小部件</span></h5></a>

								<a href="/blog2/web/index.php?r=post/home&PostSearch[tags]=教程"> <h4 style="display: inline-block;"><span class="label label-warning">教程</span></h4></a>

								<a href="/blog2/web/index.php?r=post/home&PostSearch[tags]=查询构建器"> <h3 style="display: inline-block;"><span class="label label-primary">查询构建器</span></h3></a>

								<a href="/blog2/web/index.php?r=post/home&PostSearch[tags]=视频教程"> <h4 style="display: inline-block;"><span class="label label-warning">视频教程</span></h4></a>

								<a href="/blog2/web/index.php?r=post/home&PostSearch[tags]=33"> <h6 style="display: inline-block;"><span class="label label-danger">33</span></h6></a>											 -->
							</li>
						</ul>					
					</div>
						
					<div class="comments">
				
				    	<ul class="list-group">
				    			<li class="list-group-item">
							<span class="glyphicon glyphicon-comment" aria-hidden="true"></span> 最新回复
							</li>
							
							<li class="list-group-item">
							
					
							<div class="post"><div class="title"><p style="color:#777777;font-style:italic;">适合用常规格式显示一个模型（例如在一个表格的一行中显示模型的每个属性）。</p><p class="text-right"><span class="glyphicon glyphicon-user" aria-hidden="true"></span>testing</p><p style="font-size:8pt;color:blue">《 <a href="/blog2/web/index.php?r=post%2Fdetail&id=36&title=DetailView">DetailView</a>》</p><hr></div></div><div class="post"><div class="title"><p style="color:#777777;font-style:italic;">yii\db\Query::one() 方法只返回查询结果当中的第一条数据， 条件语句中不会加上 LIMIT 1 条</p><p class="text-right"><span class="glyphicon glyphicon-user" aria-hidden="true"></span>csc</p><p style="font-size:8pt;color:blue">《 <a href="/blog2/web/index.php?r=post%2Fdetail&id=39&title=%E6%9F%A5%E8%AF%A2%E6%9E%84%E5%BB%BA%E5%99%A8">查询构建器</a>》</p><hr></div></div><div class="post"><div class="title"><p style="color:#777777;font-style:italic;">如需使用表达式的值做为索引，那么只需要传递一个匿名函数给 yii\db\Query::indexBy() 方法即可</p><p class="text-right"><span class="glyphicon glyphicon-user" aria-hidden="true"></span>kiki</p><p style="font-size:8pt;color:blue">《 <a href="/blog2/web/index.php?r=post%2Fdetail&id=39&title=%E6%9F%A5%E8%AF%A2%E6%9E%84%E5%BB%BA%E5%99%A8">查询构建器</a>》</p><hr></div></div><div class="post"><div class="title"><p style="color:#777777;font-style:italic;">当你在调用 yii\db\Query::all() 方法时，它将返回一个以连续的整型数值为索引的数组。 而有时候你可能希望使用一个特定的字段或者表达式的值来作为索引结果集数组。那么你可以在调用 yii\db\Query::all() 之前使用 yii\db\Query::indexBy() 方法来达到这个目的。</p><p class="text-right"><span class="glyphicon glyphicon-user" aria-hidden="true"></span>陈天桥</p><p style="font-size:8pt;color:blue">《 <a href="/blog2/web/index.php?r=post%2Fdetail&id=39&title=%E6%9F%A5%E8%AF%A2%E6%9E%84%E5%BB%BA%E5%99%A8">查询构建器</a>》</p><hr></div></div><div class="post"><div class="title"><p style="color:#777777;font-style:italic;">传说中的沙发。</p><p class="text-right"><span class="glyphicon glyphicon-user" aria-hidden="true"></span>萨芬</p><p style="font-size:8pt;color:blue">《 <a href="/blog2/web/index.php?r=post%2Fdetail&id=34&title=ActiveRecord+%E8%AF%A6%E8%A7%A3%EF%BC%88%E4%B8%8A%EF%BC%89">ActiveRecord 详解（上）</a>》</p><hr></div></div><div class="post"><div class="title"><p style="color:#777777;font-style:italic;">yii\db\Query::one() 方法只返回查询结果当中的第一条数据， 条件语句中不会加上 LIMIT 1 条件。如果你清楚的知道查询将会只返回一行或几行数据 （例如， 如果你是通过某些主键来查询的），这很好也提倡这样做。但是，如果查询结果 有机会返回大量的数据时，那么你应该显示调用 limit(1) 方法，以改善性能。 例如， (new \yii\db\Query())->from('user')->limit(1)->one()。</p><p class="text-right"><span class="glyphicon glyphicon-user" aria-hidden="true"></span>马奇芳</p><p style="font-size:8pt;color:blue">《 <a href="/blog2/web/index.php?r=post%2Fdetail&id=39&title=%E6%9F%A5%E8%AF%A2%E6%9E%84%E5%BB%BA%E5%99%A8">查询构建器</a>》</p><hr></div></div>					
							</li>
												
						</ul>
					</div>
				</div>
			</div>			
		</div>
	</div>
<!--     </div> -->
</div>


<?php $this->load->view('layout/foot'); ?>