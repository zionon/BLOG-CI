<footer class="footer">
	<div class="container">
		<p class="pull-left">Page rendered in <strong>{elapsed_time}</strong> seconds.&nbsp&nbsp&nbsp&nbsp</p>
		<?php echo  (ENVIRONMENT === 'development') ?  'CodeIgniter Version <strong>' . CI_VERSION . '</strong>' : '' ?>
        <p class="pull-right">Powered by <a href="http://www.codeigniter.com" rel="external">CodeIgniter Framework</a></p>
	</div>
</footer>

</body>
</html>

<script type="text/javascript">
	jQuery(document).ready(function () {
		jQuery.ajax({
			type : "GET",
			url : "<?=site_url('CommentController/commentStatus')?>",
			dataType : "json",
			success : function(data){
				jQuery('#comment-status-num').text(data);
			}
		});

		jQuery.ajax({
			type : "GET",
			url : "<?=site_url('ReplyController/replyStatus')?>",
			dataType : "json",
			success : function(data){
				jQuery('#reply-status-num').text(data);
			}
		});

	});
	//抽时间要理解get上面url乱码	
</script>