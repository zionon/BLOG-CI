<?php $this->load->view('admin/top'); ?>
<div class="container clearfix">
    <?php $this->load->view('admin/menu'); ?>
    <!--/sidebar-->
    <div class="main-wrap">

        <div class="crumb-wrap">
            <div class="crumb-list"><i class="icon-font"></i><a href="/jscss/admin">首页</a><span class="crumb-step">&gt;</span><span class="crumb-name">作品管理</span></div>
        </div>
        <!-- 搜索的表单 -->
        <div class="search-wrap">
            <div class="search-content">
                <form action="<?=site_url('admin/blogc/lst')?>" method="GET">
                    <table class="search-tab">
                        <tr>
                            <th width="200">标题:</th>
                            <td><input class="common-text" placeholder="关键字" name="title" value="<?=$this->input->get('title')?>" id="" type="text"></td>
                        </tr>
                        <tr>
                            <th width="200">是否显示:</th>
                            <td>
                            	<?php $isShow = $this->input->get('is_show'); ?>
                            	<input type="radio" name="is_show" value=""  <?php if($isShow=='') echo 'checked="checked"'; ?> />全部
                            	<input type="radio" name="is_show" value="是" <?php if($isShow=='是') echo 'checked="checked"'; ?> />是
                            	<input type="radio" name="is_show" value="否" <?php if($isShow=='否') echo 'checked="checked"'; ?> />否
                            </td>
                        </tr>
                        <tr>
                        	<th width="200"></th>
                        	<td><input class="btn btn-primary btn2" name="sub" value="查询" type="submit"></td>
                        </tr>
                    </table>
                </form>
            </div>
        </div>
        <div class="result-wrap">
            <form name="myform" id="myform" method="post">
                <div class="result-title">
                    <div class="result-list">
                        <a href="insert.html"><i class="icon-font"></i>新增作品</a>
                        <a id="batchDel" href="javascript:void(0)"><i class="icon-font"></i>批量删除</a>
                        <a id="updateOrd" href="javascript:void(0)"><i class="icon-font"></i>更新排序</a>
                    </div>
                </div>
                <div class="result-content">
                    <table class="result-tab" width="100%">
                        <tr>
                            <th>ID</th>
                            <th>标题</th>
                            <th>是否显示</th>
                            <th>添加时间</th>
                            <th>操作</th>
                        </tr>
                        <?php foreach ($data->result() as $k => $v): ?>
                        <tr>
                            <td><?=$v->id?></td>
                            <td><?=$v->title?></td>
                            <td><?=$v->is_show?></td>
                            <td><?=$v->addtime?></td>
                            <td>
                                <a class="link-update" href="<?=site_url('admin/blogc/update/'.$v->id)?>">修改</a>
                                <a onclick="return confirm('确定要删除吗？');" class="link-del" href="<?=site_url('admin/blogc/delete/'.$v->id)?>">删除</a>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </table>
                    <div class="list-page"> <?=$page?> </div>
                </div>
            </form>
        </div>
    </div>
    <!--/main-->
</div>
</body>
</html>