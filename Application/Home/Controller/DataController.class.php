<?php
namespace Home\Controller;
use Think\Controller;
class DataController extends Controller {
	public function index(){
	}
	public function addperson(){
		$this->display();
	}
	
	public function addface(){
		if(IS_POST){
			$api_key = 'd67c3c855e947e43f055ebb16bdec8fb';
			$api_secret = 'DNKcR5C_yXHGR4_Si73J66RLc-XhIOT_';
			$api_url = "http://apicn.faceplusplus.com/v2";

			$api_get_person_list = $api_url.'/info/get_person_list?api_secret='.$api_secret.'&api_key='.$api_key;
			// $api_detection_detect = '/detection/detect';
			// $api_person_add_face = '/person/add_face';


			$data=I('post.');// 表单传来的data
			/*face为要存储到数据库的数组*/
			$face['personname'] = $data['person_name'];//数据库内名为personname

			/*先检验person_name是否存在*/
			$person_list = file_get_contents($api_get_person_list);
			$arr_json = json_decode($person_list,true); //解析json(带bom)，数组形式
			$arr_length = sizeof($arr_json['person']); //数组的长度，有多少个person
			$arr_flag = 0;
			for($i=0;$i<$arr_length;$i++){
				$msg = $i;
				if($face['personname'] == $arr_json['person'][$i]['person_name']){
					$arr_flag = 1;
				}
			}
			if($arr_flag == 0){
				$arr_error = "person不存在！";
				$this->error($arr_error);
			}
			

			/*图片上传参数*/
			$config = array(
				'maxSize'    =>    3145728,// 设置附件上传大小
				'rootPath'   =>    './Public/faceDB/',// 设置附件上传根目录
				'savePath'   =>    '',// 设置附件上传（子）目录
				'saveName'   =>    $face['personname'].date('Y-m-d').'-'.time('H:i:s'),
				'exts'       =>    array('jpg'),// 设置附件上传类型
				'autoSub'    =>    true,
				'subName'    =>    $face['personname'],//子目录名字
				);

    		$upload = new \Think\Upload($config);// 实例化上传类
  		
    		// 上传文件 
    		$info   =   $upload->upload();

    		$photo_name = $info['face']['savename'];
    		/*待存储的faceurl*/
    		$face['faceurl'] = 'http://zengguangyi.com/wx/faceMonitor/Public/faceDB/'.$face['personname'].'/'.$photo_name;

    		/*请求face++进行人脸检测，获取face_id*/
    		$api_detection_detect = $api_url.'/detection/detect?api_key='.$api_key.'&api_secret='.$api_secret."&url=".$face['faceurl'].'&attribute=glass,pose,gender,age,race,smiling';
    		$face_list = file_get_contents($api_detection_detect);
			$arr_face_json = json_decode($face_list,true); //解析json(带bom)，数组形式
			$face['faceid'] = $arr_face_json['face'][0]['face_id'];
			
			/*请求face++添加face*/
			$api_person_add_face = $api_url.'/person/add_face?api_secret='.$api_secret.'&face_id='.$face['faceid'].'&api_key='.$api_key.'&person_name='.$face['personname'];
			$addface_list = file_get_contents($api_person_add_face);
			$arr_addface_json = json_decode($addface_list,true); //解析json(带bom)，数组形式


    		if(!$info) {// 上传错误提示错误信息
    			$this->error($upload->getError());
    		}else{// 上传成功
    			// $addDB = D('Data');
    			// $addDB -> add($face);
    			var_dump($arr_addface_json);
    			$this->success('上传成功！');
    		}
			
    	}else{

    		$this->display();
    	}
    }
}