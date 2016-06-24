<?php $this->load->view('layout/topNav.php'); ?>

<div class="container">
    <ul class="breadcrumb">
        <li><a href="/Learn-YII/web/index.php">首页</a></li>
        <li class="active">Contact</li>
    </ul>        

    <div class="site-contact">
        <h2>注 册</h2>

        <div class="row">
            <div class="col-lg-5">

            <form id="contact-form" action="<?=site_url('UserController/register')?>" method="post" role="form">
                <div class="form-group field-contactform-name required">
                    <label class="control-label" for="contactform-name">用户名:</label>
                    <input type="text" id="contactform-name" class="form-control" name="User[username]" autofocus value="<?=set_value('User[username]')?>" />
                    <p class="help-block help-block-error">
                        <?php $error = form_error('User[username]'); ?>
                        <span style="color:#F00;font-weight:bold;"><?=$error?></span>
                    </p>
                </div>
                <div class="form-group field-contactform-name required">
                    <label class="control-label" for="contactform-name">密 码:</label>
                    <input type="password" id="contactform-name" class="form-control" name="User[password]" autofocus />
                    <p class="help-block help-block-error">
                        <?php $error = form_error('User[password]'); ?>
                        <span style="color: #F00;font-weight:bold;"><?=$error?></span>
                    </p>
                </div>
                <div class="form-group field-contactform-name required">
                    <label class="control-label" for="contactform-name">确认密码:</label>
                    <input type="password" id="contactform-name" class="form-control" name="User[passconf]" autofocus />
                    <p class="help-block help-block-error">
                        <?php $error = form_error('User[passconf]'); ?>
                        <span style="color: #F00;font-weight:bold;"><?=$error?></span>
                    </p>
                </div>
                <div class="form-group field-contactform-email required">
                    <label class="control-label" for="contactform-email">邮 箱:</label>
                    <input type="text" id="contactform-email" class="form-control" name="User[email]" value="<?=set_value('User[email]')?>" />
                    <p class="help-block help-block-error">
                        <?php $error = form_error('User[email]'); ?>
                        <span style="color: #F00;font-weight:bold;"><?=$error?></span>
                    </p>
                </div>
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
                    <button type="submit" class="btn btn-primary">提 交</button> 
                </div>
            </form>
            </div>
        </div>
    </div>
</div>


</div>
<?php $this->load->view('layout/foot'); ?>