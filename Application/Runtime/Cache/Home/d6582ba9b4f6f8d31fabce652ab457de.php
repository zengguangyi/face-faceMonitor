<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>人脸监控系统|后台管理</title>
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
			<h1 class='title'>实时信息</h1>			
		</header>
		<div class="content">
			<div class="content-block-title">最近一次识别</div>
			<div class="card">
				<div class="card-content">
					<div class="card-content-inner">
						<div class="list-block contacts-block">
							<div class="list-group">
								<ul>
									<li>
										<div class="item-content">
											<div class="item-inner">
												<img class="item-inner-img" src="/faceMonitor/1/Public/faceUpload/facemonitor.jpg">
											</div>
										</div>
									</li>
									<li class="list-group-title"><?php echo ($list[0]['id']); ?></li>
									<li>
										<div class="item-content">
											<div class="item-inner">
												<div class="item-title">识别时间：</div>
												<div class="item-after"><?php echo ($list[0]['createtime']); ?></div>
											</div>
										</div>
									</li>
									<li>
										<div class="item-content">
											<div class="item-inner">
												<div class="item-title">置信度：</div>
												<div class="item-after"><?php echo ($list[0]['confidence']); ?></div>
											</div>
										</div>
									</li>
									<li>
										<div class="item-content">
											<div class="item-inner">
												<div class="item-title">是否同一个人：</div>
												<div class="item-after"><?php echo ($list[0]['issameperson']); ?></div>
											</div>
										</div>
									</li>
									<li>
										<div class="item-content">
											<div class="item-inner">
												<div class="item-title">session_id：</div>
												<div class="item-after"><?php echo ($list[0]['sessionid']); ?></div>
											</div>
										</div>
									</li>
								</ul>
							</div>
						</div>
					</div>
				</div>
			</div>

			<div class="content-block">
				<p><a href="#"  class="open-popup button">查看历史纪录</a></p>
			</div>
		</div>

		<div class="popup popup-about">
			<div class="content-block">
				<?php if(is_array($history_list)): foreach($history_list as $key=>$his): ?><div class="card">
						<div class="card-content">
							<div class="card-content-inner">
								<div class="list-block contacts-block">
									<div class="list-group">
										<ul>
										<li class="list-group-title"><?php echo ($his['id']); ?></li>
											<li>
												<div class="item-content">
													<div class="item-inner">
														<div class="item-title">识别时间：</div>
														<div class="item-after"><?php echo ($his['createtime']); ?></div>
													</div>
												</div>
											</li>
											<li>
												<div class="item-content">
													<div class="item-inner">
														<div class="item-title">置信度：</div>
														<div class="item-after"><?php echo ($his['confidence']); ?></div>
													</div>
												</div>
											</li>
											<li>
												<div class="item-content">
													<div class="item-inner">
														<div class="item-title">是否同一个人：</div>
														<div class="item-after"><?php echo ($his['issameperson']); ?></div>
													</div>
												</div>
											</li>
										</ul>
									</div>
								</div>
							</div>
						</div>
					</div><?php endforeach; endif; ?>
				
				<p><a href="#" class="close-popup button">返回</a></p>
				
			</div>
		</div>

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
			<p class="mySidebarTitle"><a href="<?php echo U('Piimage/displayimg');?>" class="button button-fill"><span class="icon icon-download" id="mySidebarIcon2"></span>查看实时信息</a></p>
			<p class="mySidebarTitle"><a href="#" class="close-panel button button-big button-round">关闭</a></p>
		</div>
	</div>

	<!-- <script type="text/javascript" src="/faceMonitor/1/Public/scripts/indexjs.js"></script> -->
	<script type="text/javascript">

	</script>
</body>
</html>