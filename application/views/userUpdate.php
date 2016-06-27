<?php $this->load->view('layout/topNav.php'); ?>

<div class="container">
    <ul class="breadcrumb">
    	<li><a href="">首页</a></li>
		<li><a href="">文章管理</a></li>
		<li class="active">新增文章</li>
	</ul>        

	<div class="post-create">
		<h1>用户修改</h1>
		<div class="post-form">
			<form id="w0" action="<?=site_url('UserController/userUpdate/'.$id)?>" method="post">
				<input type="hidden" name="User[id]" value="<?=$id?>" />
				<div class="form-group field-post-title required">
					<label class="control-label" for="post-title">用户名</label>
					<input type="text" id="post-title" class="form-control" name="User[username]" maxlength="128" value="<?=set_value('User[username]',$username)?>" />
					<?php $error = form_error('User[username]'); ?>
			        <span style="color:#F00;font-weight:bold;"><?=$error?></span>

					<div class="help-block"></div>
				</div>

				<div class="form-group field-post-title required">
					<label class="control-label" for="post-title">密  码</label>
					<input type="text" id="post-title" class="form-control" name="User[password]" maxlength="128" value="<?=set_value('User[password]',$password)?>" />
					<?php $error = form_error('User[password]'); ?>
			        <span style="color:#F00;font-weight:bold;"><?=$error?></span>

					<div class="help-block"></div>
				</div>

				<div class="form-group field-post-title required">
					<label class="control-label" for="post-title">确认密码</label>
					<input type="text" id="post-title" class="form-control" name="User[passconf]" maxlength="128" value="<?=set_value('User[password]',$password)?>" />
					<?php $error = form_error('User[passconf]'); ?>
			        <span style="color:#F00;font-weight:bold;"><?=$error?></span>

					<div class="help-block"></div>
				</div>

				<div class="form-group field-post-title required">
					<label class="control-label" for="post-title">邮  箱</label>
					<input type="text" id="post-title" class="form-control" name="User[email]" maxlength="128" value="<?=set_value('User[email]',$email)?>" />
					<?php $error = form_error('User[email]'); ?>
			        <span style="color:#F00;font-weight:bold;"><?=$error?></span>

					<div class="help-block"></div>
				</div>				
		<!-- 		<div class="form-group field-post-tags">
				<label class="control-label" for="post-tags">标签</label>
				<textarea id="post-tags" class="form-control" name="Post[tags]" rows="6"></textarea>

				<div class="help-block"></div>
				</div> -->
		<!-- 		<div class="form-group field-post-status required">
				<label class="control-label" for="post-status">状态</label>
				<select id="post-status" class="form-control" name="Post[status]">
				<option value="1">草稿</option>
				<option value="2">已发布</option>
				<option value="3">已归档</option>
				</select>

				<div class="help-block"></div>
				</div> -->
                <div class="form-group field-contactform-verifycode">
                    <label class="control-label" for="contactform-verifycode">验证码:</label>
                    <div class="row">
                        <div class="col-lg-6"><input type="text" id="contactform-verifycode" class="form-control" name="User[code]">
                        </div>
                        <div class="col-lg-3"><img id="contactform-verifycode-image" src="<?=site_url('UserController/getCaptcha')?>" alt="" style="cursor: pointer" onclick="this.src='<?=site_url('UserController/getCaptcha')?>#'+Math.random()" />
                        </div>
                    </div>
                    <p class="help-block help-block-error">
                        <?php $error = form_error('User[code]'); ?>
                        <span style="color: #F00;font-weight:bold;"><?=$error?></span>
                    </p>
                </div>				
				
				<div class="form-group">
				    <button type="submit" class="btn btn-primary"> 修 改 </button>    
				</div>
			</form>
		</div>
	</div>
</div>



</div>
<?php $this->load->view('layout/foot'); ?>