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
    		if(!$info) {// 上传错误提示错误信息
    			$this->error($upload->getError());
    		}

    		$photo_name = $info['face']['savename'];
    		/*待存储的faceurl*/
    		$face['faceurl'] = 'http://zengguangyi.com/wx/faceMonitor/Public/faceDB/'.$face['personname'].'/'.$photo_name;

    		/*待存储的图片名字*/
    		$face['imgname'] = $photo_name;
    		/*创建时间*/
    		$face['createtime'] = substr($photo_name, -25,21);

    		/*1.请求face++进行人脸检测，获取face_id*/
    		$api_detection_detect = $api_url.'/detection/detect?api_key='.$api_key.'&api_secret='.$api_secret."&url=http://g.hiphotos.baidu.com/image/pic/item/c8ea15ce36d3d539d090d5353f87e950342ab093.jpg&attribute=glass,pose,gender,age,race,smiling";//测试地址
    		// $api_detection_detect = $api_url.'/detection/detect?api_key='.$api_key.'&api_secret='.$api_secret."&url=".$face['faceurl'].'&attribute=glass,pose,gender,age,race,smiling';
    		$face_list = file_get_contents($api_detection_detect);
			$arr_face_json = json_decode($face_list,true); //解析json(带bom)，数组形式
			$face['faceid'] = $arr_face_json['face'][0]['face_id'];
			if(!$arr_face_json['face'][0]['face_id']){
				$this->error("sorry,可能图片中没有人脸~");
			}
			
			/*2.请求face++添加face*/
			$api_person_add_face = $api_url.'/person/add_face?api_secret='.$api_secret.'&face_id='.$face['faceid'].'&api_key='.$api_key.'&person_name='.$face['personname'];
			$addface_list = file_get_contents($api_person_add_face);
			$arr_addface_json = json_decode($addface_list,true); //解析json(带bom)，数组形式
			if($arr_addface_json['success'] != true){
				$this->error("sorry,图片没有添加成功，要不再试试0.o");
			}

			/*3.请求face++训练person的素材*/
			$api_train_verify = $api_url.'/train/verify?api_secret='.$api_secret.'&api_key='.$api_key.'&person_name='.$face['personname'];
			$train_list = file_get_contents($api_train_verify);
			if(!$train_list['session_id']){
				$this->error("你的图片成功上传，但是没有及时训练人物素材，最好再来一发或者手动train!");
			}


    		// 上传成功
			$addDB = D('Data');
			$addDB -> add($face);
    		// var_dump($train_list);
			$this->success('哇~上传成功了！再来一发0.o');		
			
		}else{
			$this->display();
		}
	}

	public function deleteface(){
		// if($_POST['person_name']){

		// 	$data = $_POST['person_name'];
		// 	// $json = json_encode($data);
		// 	echo $data;
		// 	$name = 'hi';
		// 	$this->assign('na',$data);
		// 	$this->display();
		// }else{
		// 	// $name = 'hi';
		// 	// $this->assign('na',$name);
		// 	// $this->display();
		// }
		if($person_name = $_GET['person_name']){
			$face = D('Data');
			$this->assign('person_name',$person_name);
			$condtion['personname'] = $person_name;

			$data = $face->where($condtion)->field('faceurl,imgname,faceid')->select();		
			// var_dump($data);
			$this->assign('data',$data);




			
			$this->display();
		}else{
			$this->error('亲，你点的是什么0.o？');
		}

	}

	/*删除数据库内、face++上、本地的face*/
	public function deletedb_face(){
		if(IS_POST){
			$api_key = 'd67c3c855e947e43f055ebb16bdec8fb';
			$api_secret = 'DNKcR5C_yXHGR4_Si73J66RLc-XhIOT_';
			$api_url = "http://apicn.faceplusplus.com/v2";

			$data = I('POST.');
			$face = D('Data');
			/*删除数据库信息*/
			$condtion['faceid'] = $data['faceid'];
			$face->where($condtion)->delete();
			/*删除face++上的face*/
			$api_person_remove_face = $api_url."/person/remove_face?api_secret=".$api_secret."&face_id=".$data['faceid']."&api_key=".$api_key."&person_name=".$data['personname'];
			$remove_face = file_get_contents($api_person_remove_face);
			// $remove_face_list =json_decode($remove_face);
			// var_dump($remove_face_list);

			/*删除本地图片*/
			if(file_exists('./Public/faceDB/'.$data['personname'].'/'.$data['imgname']))//正常环境下删除文件
            unlink('./Public/faceDB/'.$data['personname'].'/'.$data['imgname']);

            /*重新训练faces*/
            $api_train_verify = $api_url.'/train/verify?api_secret='.$api_secret.'&api_key='.$api_key.'&person_name='.$data['personname'];
			$train_list = file_get_contents($api_train_verify);
			
			/*返回json给前端*/
			$this->ajaxReturn($condtion);
			var_dump($image_name);
		}
	}

	/*删除person*/public function deletedb_person(){
		if(IS_POST){
			$api_key = 'd67c3c855e947e43f055ebb16bdec8fb';
			$api_secret = 'DNKcR5C_yXHGR4_Si73J66RLc-XhIOT_';
			$api_url = "http://apicn.faceplusplus.com/v2";

			$data = I('POST.');
			$face = D('Data');
			/*删除数据库信息*/
			$condtion['personname'] = $data['personname'];
			$face->where($condtion)->delete();
			/*删除face++上的face*/
			$api_person_delete = $api_url."/person/delete?api_secret=".$api_secret."&api_key=".$api_key."&person_name=".$data['personname'];
			$person_delete = file_get_contents($api_person_delete);

			/*删除本地文件夹*/
			if(is_dir('./Public/faceDB/'.$data['personname'])){
				rmdir('./Public/faceDB/'.$data['personname']);
			}


		}
	}
}