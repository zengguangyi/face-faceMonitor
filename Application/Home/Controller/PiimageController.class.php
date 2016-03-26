<?php
namespace Home\Controller;
use Think\Controller;
class PiimageController extends Controller {
	public function index(){
		$api_key = 'd67c3c855e947e43f055ebb16bdec8fb';
		$api_secret = 'DNKcR5C_yXHGR4_Si73J66RLc-XhIOT_';
		$api_url = "http://apicn.faceplusplus.com/v2";

		if(IS_POST){
			$data = I('post.');

			$face['confidence'] = $data['confidence'];
			$face['issameperson'] = $data['is_same_person'];
			$face['sessionid'] = $data['session_id'];

			/*请求face++获取创建时间等信息*/
			$api_info_get_session = $api_url."/info/get_session?api_secret=".$api_secret."&api_key=".$api_key."&session_id=".$face['sessionid'];
			$info_get_session = file_get_contents($api_info_get_session);
			$session_list = json_decode($info_get_session,true); //解析json

			$face['createtime'] = $session_list['create_time'];
			$face['finishtime'] = $session_list['finish_time'];
			$face['status'] = $session_list['status'];

			/*session的信息添加进数据库*/
			$addPiimage = D('Piimage');
			$addPiimage->add($face);
			var_dump($face);			

		}
	}

	public function displayimg(){
		$dis = D('Piimage');
		/*提取数据库中信息*/
		$list = $dis->order('id desc')->limit(1)->select();
		$history = $dis->order('id desc')->limit(6)->select();
		$history_list[0] = $history[1];
		$history_list[1] = $history[2];
		$history_list[2] = $history[3];
		$history_list[3] = $history[4];
		$history_list[4] = $history[5];

		$this->assign('list',$list);
		$this->assign('history_list',$history_list);
		$this->display();
	}

	// public function testjson(){
	// 	$face['confidence'] = $_POST['confidence'];
	// 	$face['issameperson'] = $_POST['is_same_person'];
	// 	$face['sessionid'] = $_POST['session_id'];

	// 	$face = json_encode($face);
	// 	echo $face;
	// }
}