<?php
$config = array(
    'post' => array(
        array(
            'field' => 'Post[title]',
            'label' => '标题',
            'rules' => 'required'
        ),
        array(
            'field' => 'Post[content]',
            'label' => '文章',
            'rules' => 'required'
        ),
        array(
            'fiele' => 'Post[status]',
            'label' => '必须选择状态',
            'rules' => 'required'
        ),
    ),

    'register' => array(
        array(
            'field' => 'User[username]',
            'label' => '用户名',
            'rules' => 'required',
        ),
        array(
            'field' => 'User[password]',
            'label' => '密码',
            'rules' => 'required',
        ),
        array(
            'field' => 'User[passconf]',
            'label' => '确认密码',
            'rules' => 'required|matches[User[password]]',
        ),
        array(
            'field' => 'User[email]',
            'label' => '邮箱',
            'rules' => 'required|valid_email',
        ),
        array(
            'field' => 'User[code]',
            'label' => '验证码',
            'rules' => 'required|callback_checkCode',
        ),
    ),

    'login' => array(
        array(
            'field' => 'LoginForm[username]',
            'label' => '用户名',
            'rules' => 'required|callback_checkUsername',
        ),
        array(
            'field' => 'LoginForm[password]',
            'label' => '密码',
            'rules' => 'required',
        ),
        array(
            'field' => 'LoginForm[code]',
            'label' => '验证码',
            'rules' => 'required|callback_checkCode',
        ),
    ),
);