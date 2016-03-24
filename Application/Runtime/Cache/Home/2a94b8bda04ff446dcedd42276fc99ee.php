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
			<h1 class='title'>主页</h1>			
		</header>
		<div class="content">

			<div class="content-block-title">人物信息</div>
			<div  id="js-card-msg">
				<!-- 人物信息卡片 -->
				<!-- <div class="card">
					<div class="card-content">
						<div class="content-block-title" id="myMaster">主人：<span id="person_name">Make</span></div>
						<div class="list-block">
							<ul>
								<li class="item-content">
									<div class="item-media"><i class="icon icon-f7"></i></div>
									<div class="item-inner">
										<div class="item-title"><p>人脸素材</p></div>
										<div class="item-after">12</div>
									</div>
								</li>
								<li class="item-content">
									<div class="item-media"><i class="icon icon-f7"></i></div>
									<div class="item-inner">
										<a href="#" class="myCenterTitle">查看</a>
									</div>
								</li>
							</ul>
						</div>
					</div>
				</div> -->
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
				<!-- 本该为侧栏隐藏 -->
			</div>
			<p class="mySidebarTitle"><a href="<?php echo U('Data/addperson');?>" class="button button-fill"><span class="icon icon-friends" id="mySidebarIcon2"></span>添加信任成员</a></p>
			<p class="mySidebarTitle"><a href="#" class="close-panel button button-big button-round">关闭</a></p>
		</div>
	</div>

	<script type="text/javascript" src="/faceMonitor/1/Public/scripts/indexjs.js"></script>
	<script type="text/javascript">
		/*index中把person_name传给php*/
		window.onload = function(){
			$(document).on("click",".card",function() {
				location.href = "<?php echo U('Data/deleteface');?>?person_name="+$(this).attr('id');
			});
		}

	</script>
</body>
</html>