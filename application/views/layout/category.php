<div class="comments">
	<ul class="list-group">
		<li class="list-group-item">
			<span aria-hidden="true"></span> 分类目录
		</li>
		
		<li class="list-group-item">
			<?php foreach($tree as $value): ?>
				<div class="title">
					<?=$value?>
				</div>
			<?php endforeach; ?>
		</li>							
	</ul>
</div>