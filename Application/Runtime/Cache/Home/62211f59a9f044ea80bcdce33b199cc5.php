<?php if (!defined('THINK_PATH')) exit();?> <!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>人脸监控系统|添加信任成员</title>
	<meta name="viewport" content="width=device-width,initial-scale=1,user-scalable=yes">

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
			<h1 class='title'>添加信任成员</h1>			
		</header>
		<div class="content">
			<form action="#" method="post" id="addperson">
				<div class="list-block">
					<ul>
						<li>
							<div class="item-content">
								<div class="item-inner">
									<div class="item-title label">Name</div>
									<div class="item-input">
									<input type="text" name="person_name" placeholder="Your name" />
									</div>
								</div>
							</div>
						</li>
						<li>
							<div class="item-content">
								<div class="myMsg">请输入英文名字</div>
							</div>
						</li>
					</ul>
					<input type="button" value="提交" class="button button-big button-fill button-success" id="submit_btn" />
				</div>
			</form>
			<div id="tips">
				<img src="/faceMonitor/1/Public/images/ajax-loader.gif">
			</div>

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
			<p class="mySidebarTitle"><a href="<?php echo U('Data/addface');?>" class="button button-fill"><span class="icon icon-picture" id="mySidebarIcon1"></span>添加训练素材</a></p>
			<div id="mySidebarHid">

			</div>
			<p class="mySidebarTitle"><a href="#" class="button button-fill"><span class="icon icon-friends" id="mySidebarIcon2"></span>添加信任成员</a></p>
			<p class="mySidebarTitle"><a href="#" class="close-panel button button-big button-round">关闭</a></p>
		</div>
	</div>

	<script type="text/javascript" src="/faceMonitor/1/Public/scripts/indexjs.js"></script>
</body>
</html>