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
						<?php if($data->result()): ?>
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
						<?php endif; ?>					
					</div>

					<ul class="pagination">
						<?=$page?>
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

















