<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>人脸监控系统|后台管理</title>
	<meta name="viewport" content="width=device-width,initial-scale=1,user-scalable=yes">

	<!-- <link rel="stylesheet" type="text/css" href="/faceMonitor/1/Public/styles/wx_style.css"> -->

	<script type="text/javascript" src="/faceMonitor/1/Public/libs/jquery-1.12.0.min.js"></script>

	<link rel="stylesheet" href="http://g.alicdn.com/msui/sm/0.6.2/css/sm.min.css">
	<script type='text/javascript' src='http://g.alicdn.com/sj/lib/zepto/zepto.min.js' charset='utf-8'></script>
	<script type='text/javascript' src='http://g.alicdn.com/msui/sm/0.6.2/js/sm.min.js' charset='utf-8'></script>
	<link rel="stylesheet" href="http://g.alicdn.com/msui/sm/0.6.2/css/sm.min.css">

	<link rel="stylesheet" type="text/css" href="/faceMonitor/1/Public/styles/style.css">


</head>
<body>
	<div class="page">
		<header class="bar bar-nav">		
			<a href="#" class="pull-right open-panel" data-panel='#panel-left-demo'><span class="icon icon-menu"></span></a>		
			<h1 class='title'>添加face</h1>			
		</header>
		<div class="content">
			<form action="<?php echo U('Data/addface');?>" enctype="multipart/form-data" method="post" >
				<div class="list-block">
					<ul>
						<li>
							<div class="item-content">
								<div class="item-media"><i class="icon icon-form-gender"></i></div>
								<div class="item-inner">
									<div class="item-title label">Person <span class="addfaceMsg"></span></div>
									<div class="item-input">
										<!-- person_name表单输入 -->
										<input type="text" name="name" id="myPersonNameInput" />
									</div>
								</div>
							</div>
						</li>
						<li>
							<div class="item-content">
								<div class="item-media"><i class="icon icon-form-gender"></i></div>
								<div class="item-inner">
									<div class="item-title label">选择图片</div>
									<div class="item-input">
										<!-- face表单输入 -->
										<input type="file" name="photo" />	
									</div>
								</div>
							</div>
						</li>
					</ul>
				</div>
				<div class="content-block">
					<div class="row">
						<div class="col-50"><a href="#" class="button button-big button-fill button-danger">取消</a></div>
						<!-- 提交表单 -->
						<div class="col-50"><input type="submit" value="提交" class="button button-big button-fill button-success" ></div>
					</div>
				</div>
				
			</form>
			
			
		</div>
		<nav class="bar bar-tab" id="myFoot">									
			<h1 class='title'>底部</h1>			
		</nav>	
	</div>

	<div class="panel-overlay"></div>
	<!-- Left Panel with Reveal effect -->
	<div class="panel panel-right panel-reveal theme-dark" id='panel-left-demo'>
		<div class="content-block">
			<p class="mySidebarTitle"><a href="<?php echo U('Index/index');?>" class="button button-fill">主页</a></p>
			<p class="mySidebarTitle"><a href="#" class="button button-fill"><span class="icon icon-picture" id="mySidebarIcon1"></span>添加训练素材</a></p>
			<div id="mySidebarHid">
				
			</div>
			<p class="mySidebarTitle"><a href="<?php echo U('Data/addperson');?>" class="button button-fill"><span class="icon icon-friends" id="mySidebarIcon2"></span>添加信任成员</a></p>
			<p class="mySidebarTitle"><a href="#" class="close-panel button button-big button-round">关闭</a></p>
		</div>
	</div>

	<script type="text/javascript" src="/faceMonitor/1/Public/scripts/indexjs.js"></script>
</body>
</html>