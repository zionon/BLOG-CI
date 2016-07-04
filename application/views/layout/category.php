<div class="comments">
	<ul class="list-group">
		<li class="list-group-item">
			<span aria-hidden="true"></span> 文档分类
		</li>
		
		<li class="list-group-item">
			<?php foreach($comment as $value): ?>
				<div class="title">
					<p style="color: #777777;font-style: italic;"><?=$value->content?></p>
					<p class="text-right"><span class="glyphicon glyphicon-user" aria-hidden="true"></span><?=$value->author?></p>
					<p style="font-size:8pt;color: blue;">《 <a href="<?=site_url('Welcome/detail?id='.$value->post_id)?>"><?=$value->title?></a>》</p>
					<hr />
				</div>
			<?php endforeach; ?>				
		</li>							
	</ul>
</div>