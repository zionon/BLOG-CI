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
					    <form id="w0" action="/blog2/web/index.php?r=post%2Fdetail&amp;id=37#comments" method="post">
							<input type="hidden" name="_csrf" value="QUtzV3M3N2cCGSASQxpPABQbGAUjdAIlBh5EHj97cFIKLEEtFF9HPg==">    
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
								<div class="col-md-4">
									<div class="form-group field-comment-url">
										<label class="control-label" for="comment-url">网址</label>
										<input type="text" id="comment-url" class="form-control" name="Comment[url]" maxlength="128">
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