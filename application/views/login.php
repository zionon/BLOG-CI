<?php $this->load->view('layout/topNav.php'); ?>

<div class="container">
    <ul class="breadcrumb">
        <li><a href="<?=site_url('PostController/postList')?>">首页</a></li>
        <li class="active">登录</li>
    </ul>

    <div class="site-login">
        <h2>登  录</h2>

        <form id="login-form" class="form-horizontal" action="<?=site_url('UserController/login')?>" method="post">
    <!--         <input type="hidden" name="_csrf" value="R3RlbnIwVW8VWQc8E0M6MHQ/IiQteyM5KD4QXAoAAAAWRC8AEAQsNg=="> -->
            <div class="form-group field-loginform-username required">
                <label class="col-lg-1 control-label" for="loginform-username">用户名:</label>
                <div class="col-lg-3">
                    <input type="text" id="loginform-username" class="form-control" name="LoginForm[username]" autofocus>
                </div>
                <div class="col-lg-8">
                    <p class="help-block help-block-error">
                        <?php $error = form_error('LoginForm[username]'); ?>
                        <span style="color: #F00;font-weight:bold;"><?=$error?></span>
                    </p>
                </div>
            </div>
            <div class="form-group field-loginform-password required">
                <label class="col-lg-1 control-label" for="loginform-password">密码:</label>
                <div class="col-lg-3">
                    <input type="password" id="loginform-password" class="form-control" name="LoginForm[password]">
                </div>
                <div class="col-lg-8">
                    <p class="help-block help-block-error">
                        
                        <span style="color: #F00;font-weight:bold;"><?=$confError?></span>
                    </p>
                </div>
            </div>
            <div class="form-group field-contactform-verifycode">
                <label class="col-lg-1 control-label" for="contactform-verifycode">验证码:</label>
                <div class="col-lg-3"><input type="text" id="contactform-verifycode" class="form-control" name="LoginForm[code]">
                </div>
                <div class="col-lg-3"><img id="contactform-verifycode-image" src="<?=site_url('UserController/getCaptcha')?>" alt="" style="cursor: pointer" onclick="this.src='<?=site_url('UserController/getCaptcha')?>#'+Math.random()" />                        
                </div>
                <div class="col-lg-8">
                    <p class="help-block help-block-error">
                        <?php $error = form_error('LoginForm[code]'); ?>
                        <span style="color: #F00;font-weight:bold;"><?=$error?></span>
                    </p>
                </div>
            </div>
<!--             <div class="form-group field-loginform-rememberme">
                <div class="col-lg-offset-1 col-lg-3"><input type="hidden" name="LoginForm[rememberMe]" value="0"><input type="checkbox" id="loginform-rememberme" name="LoginForm[rememberMe]" value="1" checked> <label for="loginform-rememberme">Remember Me</label></div>
                <div class="col-lg-8"><p class="help-block help-block-error"></p></div>
            </div> -->
            <div class="form-group">
                <div class="col-lg-offset-1 col-lg-11">
                    <button type="submit" class="btn btn-primary">Login</button>            
                </div>
            </div>
        </form>
    </div>
</div>



</div>

<?php $this->load->view('layout/foot'); ?>


<script type="text/javascript" src="<?=_PUBLIC?>/js/yii.activeForm.js"></script>
<script type="text/javascript" src="<?=_PUBLIC?>/js/yii.validation.js"></script>
<script type="text/javascript">
jQuery(document).ready(function () {
jQuery('#login-form').yiiActiveForm([{"id":"loginform-username","name":"username","container":".field-loginform-username","input":"#loginform-username","error":".help-block.help-block-error","validate":function (attribute, value, messages, deferred, $form) {yii.validation.required(value, messages, {"message":"用户名不能为空。"});}},{"id":"loginform-password","name":"password","container":".field-loginform-password","input":"#loginform-password","error":".help-block.help-block-error","validate":function (attribute, value, messages, deferred, $form) {yii.validation.required(value, messages, {"message":"密码不能为空。"});}},{"id":"contactform-verifycode","name":"code","container":".field-contactform-verifycode","input":"#contactform-verifycode","error":".help-block.help-block-error","validate":function (attribute, value, messages, deferred, $form) {yii.validation.required(value, messages, {"message":"验证码不能为空。"});}},{"id":"loginform-rememberme","name":"rememberMe","container":".field-loginform-rememberme","input":"#loginform-rememberme","error":".help-block.help-block-error","validate":function (attribute, value, messages, deferred, $form) {yii.validation.boolean(value, messages, {"trueValue":"1","falseValue":"0","message":"Remember Me的值必须要么为\"1\"，要么为\"0\"。","skipOnEmpty":1});}}], []);
});
</script>