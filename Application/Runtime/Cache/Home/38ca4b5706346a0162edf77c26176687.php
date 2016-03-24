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
			<h1 class='title'><?php echo ($person_name); ?></h1>
			<button class="button button-danger deleteface_delete_person" id="<?php echo ($person_name); ?>">删除该person</button>					
		</header>
		<div class="content">
			<div class="content-block-title">faces</div>
			<?php if(is_array($data)): foreach($data as $key=>$n): ?><div class="list-block media-list">
					<ul>
						<li>
							<div class="item-content">
								<div class="item-media"><img src="/faceMonitor/1/Public/faceDB/<?php echo ($person_name); ?>/<?php echo ($n["imgname"]); ?>" style='width: 2.2rem;'></div>
								<div class="item-inner">
									<div class="item-title-row">
										<div class="item-title" id="<?php echo ($n['imgname']); ?>"><?php echo ($n['imgname']); ?></div>
									</div>
									<div class="item-subtitle"><?php echo ($n['faceurl']); ?></div>
								</div>
								<button class="button button-danger deleteface_delete_btn" id="<?php echo ($n['faceid']); ?>">删除</button>
							</div>
						</li>
					</ul>
				</div><?php endforeach; endif; ?>


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
		/*deleteface中删除图片*/
		// function deleteface_delete_face()
		$(function(){
			$(document).on('click','.deleteface_delete_btn',function() {
				var person_name = $("header h1").text();
				var face_id = $(this).attr('id');
				var img_name =$(this).siblings('.item-inner').children('.item-title-row').children('.item-title').attr('id');
				console.log(img_name);
				$.ajax({
					url: '<?php echo U("Data/deletedb_face");?>',
					type: 'POST',
					dataType: 'json',
					data: {
						personname: person_name,
						faceid: face_id,
						imgname: img_name,
					},
					success: function(data){						
						$("#"+data['faceid']).parents('div.list-block').remove();
					}
				})
				.done(function() {
					console.log("success");
				})
				.fail(function() {
					console.log("error");
				})
				.always(function() {
					console.log("complete");
				});
			});

			$(".deleteface_delete_person").click(function() {
				var person_name = $(this).attr('id');
				$.ajax({
					url: '<?php echo U("Data/deletedb_person");?>',
					type: 'POST',
					dataType: 'json',
					data: {personname: person_name},
					success: function(data){
						
					}
				})
				.done(function() {
					console.log("success");
				})
				.fail(function() {
					console.log("error");
				})
				.always(function() {
					console.log("complete");
				});
				
			});
		});

	</script>
</body>
</html>