<?php if (!defined('THINK_PATH')) exit(); /*a:4:{s:83:"D:\www\17_ThinkPHP\Day_06\code\tp5\public/../application/index\view\user\login.html";i:1529373311;s:74:"D:\www\17_ThinkPHP\Day_06\code\tp5\application\index\view\public\base.html";i:1529487374;s:76:"D:\www\17_ThinkPHP\Day_06\code\tp5\application\index\view\public\header.html";i:1529027910;s:76:"D:\www\17_ThinkPHP\Day_06\code\tp5\application\index\view\public\footer.html";i:1528945374;}*/ ?>
<!DOCTYPE html>
<html lang="zh-CN">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>模板</title>
    <!-- Bootstrap -->
    <link href="/17_ThinkPHP/Day_06/code/tp5/public/static/bootstrap/css/bootstrap.css" rel="stylesheet">
    
  </head>
  <body>

    <div class="container">
      
      <div class="navbar navbar-inverse">
    <!-- <div class="navbar navbar-inverse navbar-fixed-top"> -->
    <!-- <div class="navbar navbar-inverse navbar-fixed-bottom"> -->
      <div class="navbar-header">
        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-menu">
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </button>
        <a href="#" class="navbar-brand">达内教育</a>
      </div>
      <div id="navbar-menu" class="collapse navbar-collapse">
        <ul class="nav navbar-nav">
          <li><a href="#">首页</a></li>
          <li><a href="#">下载</a></li>
          <li><a href="#">文档</a></li>
  <li class="dropdown">
    <a href="#" data-toggle="dropdown">博客
      <span class="caret"></span>
    </a>
    <!-- 下拉菜单的内容 -->
    <ul class="dropdown-menu">
      <li><a href="<?php echo url('index/blog/blogList'); ?>">博客列表</a></li>
      <li><a href="<?php echo url('index/blog/add'); ?>">添加博客</a></li>
    </ul>
  </li>
        </ul>
        <ul class="nav navbar-nav navbar-right">
          <li><a href="#">关于我们</a></li>
  <li class="dropdown">
    <a href="#" data-toggle="dropdown">
      <span class="glyphicon glyphicon-user"></span>
      <span class="caret"></span>
    </a>
    <!-- 下拉菜单的内容 -->
    <ul class="dropdown-menu">
      <?php if(session('?user')): ?>
      <li><a href="<?php echo url('index/user/center'); ?>"><?php echo \think\Session::get('user.username'); ?></a></li>
      <li><a href="<?php echo url('index/user/logout'); ?>">退出</a></li>
      <?php else: ?>
      <li><a href="<?php echo url('index/user/login'); ?>">登录</a></li>
      <li><a href="<?php echo url('index/user/register'); ?>">注册</a></li>
      <?php endif; ?>
    </ul>
  </li>
        </ul>
      </div>
    </div>

      <div class="row">
      
      
  <div class="col-md-8">
	<h1>用户登录</h1>
	<form action="<?php echo url('index/user/doLogin'); ?>" method="post" class="form-horizontal">
    <div class="form-group">
      <div class="col-md-2">
        <label class="control-label">用户名:</label>
      </div>
      <div class="col-md-5">
        <input type="text" name="username" id="username" value="" class="form-control">
      </div>
      <div class="col-md-5">
        <span class="help-block">用户名的长度是2-100位</span>
      </div>
    </div>
    <div class="form-group">
      <div class="col-md-2">
        <label class="control-label">密码:</label>
      </div>
      <div class="col-md-5">
        <input type="password" name="password" id="password" value="" class="form-control">
      </div>
      <div class="col-md-5">
        <span class="help-block">请输入密码</span>
      </div>
    </div>

    <div class="form-group">
      <div class="col-md-2">
        <label class="control-label">验证码:</label>
      </div>
      <div class="col-md-5">
        <input type="text" name="captcha" value="" class="form-control">
      </div>
      <div class="col-md-5">
        <img src="<?php echo captcha_src(); ?>" alt="captcha" id="captcha" />
      </div>
    </div>

    <div class="form-group">
      <div class="col-md-10 col-md-offset-2">
        <div class="checkbox">
          <label>
            <input type="checkbox" name="" id="" value=""> 七天免密登录
          </label>
        </div>
      </div>
    </div>

    <div class="form-group">
      <div class="col-md-10 col-md-offset-2">
        <input type="submit" value="登录" class="btn btn-primary">
        <input type="reset" value="取消" class="btn btn-default">
      </div>
      
    </div>
  	</form>
  </div>

      
  <div class="col-md-4">
  	<h1>这里是右边栏</h1>
  </div>


      <footer class="footer">
  <div class="container">
    <div class="row footer-top">
      <div class="col-md-6">
        <h3>站点介绍</h3>
        <p>ThinkPHP 是一个免费开源的，快速、简单的面向对象的 轻量级PHP开发框架 ，创立于2006年初，遵循Apache2开源协议发布，是为了敏捷WEB应用开发和简化企业应用开发而诞生的。ThinkPHP从诞生以来一直秉承简洁实用的设计原则，在保持出色的性能和至简的代码的同时，也注重易用性。并且拥有众多的原创功能和特性，在社区团队的积极参与下，在易用性、扩展性和性能方面不断优化和改进，已经成长为国内最领先和最具影响力的WEB应用开发框架，众多的典型案例确保可以稳定用于商业以及门户级的开发。</p>
      </div>
      <div class="col-md-6">
        <div class="row">
          <div class="col-md-4">
            <h3>关于我们</h3>
            <ul class="list-unstyled">
              <li><a href="#">菜单名称1</a></li>
              <li><a href="#">菜单名称2</a></li>
              <li><a href="#">菜单名称3</a></li>
              <li><a href="#">菜单名称4</a></li>
              <li><a href="#">菜单名称5</a></li>
            </ul>
          </div>
          <div class="col-md-4">
            <h3>合作交流</h3>
            <ul class="list-unstyled">
              <li><a href="#">菜单名称1</a></li>
              <li><a href="#">菜单名称2</a></li>
              <li><a href="#">菜单名称3</a></li>
              <li><a href="#">菜单名称4</a></li>
              <li><a href="#">菜单名称5</a></li>
            </ul>
          </div>
          <div class="col-md-4">
            <h3>支付方式</h3>
            <ul class="list-unstyled">
              <li><a href="#">菜单名称1</a></li>
              <li><a href="#">菜单名称2</a></li>
              <li><a href="#">菜单名称3</a></li>
              <li><a href="#">菜单名称4</a></li>
              <li><a href="#">菜单名称5</a></li>
            </ul>
          </div>
        </div>
      </div>
    </div>
    <div class="row footer-bottom">
      <ul class="list-inline text-center">
        <li>备案号: 京ICP证XXXXXX号</li>
        <li>技术支持: 达内PSD1803</li>
      </ul>
    </div>
  </div>
</footer>
      </div>
      
    </div>

    <script src="/17_ThinkPHP/Day_06/code/tp5/public/static/js/jquery-3.3.1.js"></script>
    <script src="/17_ThinkPHP/Day_06/code/tp5/public/static/bootstrap/js/bootstrap.js"></script>
    
<script type="text/javascript">
  var c = document.getElementById('captcha');
  // 对象.onclick = function(){};
  c.onclick = function(){
    // 更新img标签的src属性
    this.src = "<?php echo captcha_src(); ?>?rand="+Math.random();
  }
</script>

  </body>
</html>