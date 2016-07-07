<?php $this->load->view('layout/topNav.php'); ?>

<div class="container">
    <ul class="breadcrumb">
        <li><a href="<?=site_url('WelcomeController')?>">首页</a></li>
        <li class="active">分类</li>
    </ul>

    <div class="site-login">
        <h2>分  类</h2>

        <form id="login-form" class="form-horizontal" action="<?=site_url('CategoryController/categoryCreate')?>" method="post">
            <div class="form-group required">
                <label class="col-lg-1 control-label" for="loginform-username">上级名称:</label>
                <div class="col-lg-3">
                    <select name="Category[parent_id]">
                        <option value="0">顶级分类</option>
                        <?php foreach ($data as $value): ?>
                            <option value="<?=$value['id']?>"><?php echo str_repeat('-', 4*$value['level']) . $value['cat_name']; ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>

            <div class="form-group required">
                <label class="col-lg-1 control-label" for="loginform-username">分类名称:</label>
                <div class="col-lg-3">
                    <input type="text" id="loginform-username" class="form-control" name="Category[cat_name]" autofocus>
                </div>
                <div class="col-lg-8">
                    <p class="help-block help-block-error">
                        <?php $error = form_error('Category[cat_name]'); ?>
                        <span style="color: #F00;font-weight:bold;"><?=$error?></span>
                    </p>
                </div>
            </div>

            <div class="form-group">
                <div class="col-lg-offset-1 col-lg-11">
                    <button type="submit" class="btn btn-primary">提交</button>            
                </div>
            </div>
        </form>
    </div>
</div>



</div>

<?php $this->load->view('layout/foot'); ?>