<?php $this->load->view('layout/topNav.php'); ?>

<div class="container">
    <ul class="breadcrumb">
        <li><a href="<?=site_url('welcome')?>">首页</a></li>
        <li class="active">注册</li>
    </ul>        

    <div class="site-contact">
        <h2>注 册</h2>

        <div class="row">
            <div class="col-lg-5">

            <form id="contact-form" action="<?=site_url('WelcomeController/register')?>" method="post" role="form">
                <div class="form-group field-contactform-username required">
                    <label class="control-label" for="contactform-name">用户名:</label>
                    <input type="text" id="contactform-username" class="form-control" name="User[username]" autofocus value="<?=set_value('User[username]')?>" />
                    <p class="help-block help-block-error">
                        <?php $error = form_error('User[username]'); ?>
                        <span style="color:#F00;font-weight:bold;"><?=$error?></span>
                    </p>
                </div>
                <div class="form-group field-contactform-password required">
                    <label class="control-label" for="contactform-password">密 码:</label>
                    <input type="password" id="contactform-password" class="form-control" name="User[password]" />
                    <p class="help-block help-block-error">
                        <?php $error = form_error('User[password]'); ?>
                        <span style="color: #F00;font-weight:bold;"><?=$error?></span>
                    </p>
                </div>
                <div class="form-group field-contactform-passconf required">
                    <label class="control-label" for="contactform-passconf">确认密码:</label>
                    <input type="password" id="contactform-passconf" class="form-control" name="User[passconf]" />
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
                        <div class="col-lg-3"><img id="contactform-verifycode-image" src="<?=site_url('WelcomeController/getCaptcha')?>" alt="" style="cursor: pointer" onclick="this.src='<?=site_url('WelcomeController/getCaptcha')?>#'+Math.random()" />
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

<script type="text/javascript" src="<?=_PUBLIC?>/js/yii.activeForm.js"></script>
<script type="text/javascript" src="<?=_PUBLIC?>/js/yii.validation.js"></script>
<script type="text/javascript">
jQuery(document).ready(function () {
jQuery('#contact-form').yiiActiveForm([{"id":"contactform-name","name":"username","container":".field-contactform-username","input":"#contactform-username","error":".help-block.help-block-error","validate":function (attribute, value, messages, deferred, $form) {yii.validation.required(value, messages, {"message":"用户名不能为空。"});}},{"id":"contactform-password","name":"password","container":".field-contactform-password","input":"#contactform-password","error":".help-block.help-block-error","validate":function (attribute, value, messages, deferred, $form) {yii.validation.required(value, messages, {"message":"密码不能为空。"});}},{"id":"contactform-passconf","name":"passconf","container":".field-contactform-passconf","input":"#contactform-passconf","error":".help-block.help-block-error","validate":function (attribute, value, messages, deferred, $form) {yii.validation.required(value, messages, {"message":"确认密码不能为空。"});}},{"id":"contactform-email","name":"email","container":".field-contactform-email","input":"#contactform-email","error":".help-block.help-block-error","validate":function (attribute, value, messages, deferred, $form) {yii.validation.required(value, messages, {"message":"邮箱不能为空。"});}},{"id":"contactform-verifycode","name":"code","container":".field-contactform-verifycode","input":"#contactform-verifycode","error":".help-block.help-block-error","validate":function (attribute, value, messages, deferred, $form) {yii.validation.required(value, messages, {"message":"验证码不能为空。"});}}], []);
});
</script>