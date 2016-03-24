/*ak,as,url全局变量*/
var api_key = "d67c3c855e947e43f055ebb16bdec8fb";
var api_secret = "DNKcR5C_yXHGR4_Si73J66RLc-XhIOT_";
var api_url = "http://apicn.faceplusplus.com/v2";

/*获取person信息--主页信息card和侧栏person*/
function get_person_list(){
	var fun = "/info/get_person_list"; //face++的“返回该App中的所有Person ”
	$.getJSON(api_url+fun+"?api_secret="+api_secret+"&api_key="+api_key, function(data){
		var personName = new Array();
		for(var i=0;i<data.person.length;i++){
			personName[i] = data.person[i].person_name; //获取person中的person_name
			/*添加信息卡片*/
			var html = '<div class="card"><div class="card-content"><div class="content-block-title" id="myMaster">主人：<span class="person_name">Make</span></div><div class="list-block"><ul><li class="item-content"><div class="item-media"><i class="icon icon-f7"></i></div><div class="item-inner"></div></li><li class="item-content"><div class="item-media"><i class="icon icon-f7"></i></div><div class="item-inner"><a href="#" class="myCenterTitle">查看</a></div></li></ul></div></div></div>';
			$("#js-card-msg").append(html);
			/*设置卡片人物信息*/
			$("span.person_name:eq("+i+")").text(personName[i]);
			$("div.card:eq("+i+")").attr('id', personName[i]);
			/*添加侧栏face素材的下拉person*/
			// var html2 = '<p><a href="#" class="button">ab</a></p>';
			// $("#mySidebarHid").append(html2);
			// $("#mySidebarHid a:eq("+i+")").text(personName[i]);
		}
	});
}

/*检测addface中输入person_name是否存在*/
function check_addface_person_name(){
	$("#myPersonNameInput").bind("blur keyup",function() {
		
		var fun = "/info/get_person_list"; //face++的“返回该App中的所有Person ”
		$.getJSON(api_url+fun+"?api_secret="+api_secret+"&api_key="+api_key, function(data){
			var personName = new Array();
			/*创建判断的标志*/
			var flag = false;

			for(var i=0;i<data.person.length;i++){
				//获取person中的person_name
				personName[i] = data.person[i].person_name;

				if( $("#myPersonNameInput").val() == personName[i] ){flag = true;}
			}
			if(flag == false){
				$(".addfaceMsg").text('Wrong!').css('color', '#F14D4D');
				// $("#myPersonNameInput").val("");//取消，为避免keyup实时监测会删去val
				return false;
			}else{
				$(".addfaceMsg").text('OK!').css('color', '#4BF867');
			}
		});
	});
}
/*添加face的等待loading动画*/
function addface_loading(){
	$("#addface_sub_btn").click(function() {
		$("#addface_load").show();
	});
} 


/*在face++后台添加新的person*/
function add_person(){
	$("#submit_btn").click(function() {
		var person_name = $("input[name=person_name]").val();
		var reg = /^[A-Za-z]+$/;   //匹配英文字符的正则表达式
		var request = person_name.match(reg);
		if(person_name == ""){
			$(".myMsg").text('名字不可为空');
			return false;
		}
		if(request == null){
			$(".myMsg").text('请输入英文字母，暂不支持其他字符');
			return false;
		}
		$(".myMsg").text('');
		/*loading动画，回调函数请求face++,再淡出动画*/
		$("#tips").fadeIn('slow', function() {
			/*/person/create创建一个person*/
			var fun = "/person/create";
			var callback;
			$.getJSON(api_url+fun+"?api_key="+api_key+"&api_secret="+api_secret+"&tag=demotest&person_name="+person_name+"&group_name=Master", function(data) {
				if(data.person_id){
					var suc_html = $("<p class='suc_msg'>Success!</p>");
					$("#tips").empty().html(suc_html).fadeOut("slow");
					
				}else{
					var err_html = $("<p class='err_msg'>Error!</p>");
					$("#tips").empty().html(err_html);
				}
			});
		});
	});
}

/*侧栏添加face素材的下拉效果*/
function mySidebarHidden(){
	var flag = 0;
	$("p.mySidebarTitle:eq(1)").click(function() {
		if(flag === 0){
			$("#mySidebarHid").show();
			flag = 1;
		}else{
			$("#mySidebarHid").hide();
			flag = 0;
		}
	});
}





$(function(){
	get_person_list();
	

	// mySidebarHidden();
	add_person();
	check_addface_person_name();
	addface_loading();
})
// window.onload = function(){
// 	index_ajax_person_name();
// }