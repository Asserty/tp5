<?php 
namespace app\index\controller;
//use think\Db;
use app\common\model\Teacher; //as SmallTeacher;

use think\Controller;//用于与v层进行数据传递
use think\Request;

/**
* 			
*/
class TeacherController	 extends Controller
{		
	
	function index()
	{
		// //获取教师表中所有数据
		// $teacher = Db::name('teacher')->select();

		// //查看获取数据
		// var_dump($teacher);
		// $Teacher = new Teacher;
		// dump($Teacher);
		// $Teacher = new Teacher;
		// $teachers = $Teacher->select();

		// //获取第0个数据
		// $teacher = $teachers[0];

		// echo "<pre>";
		// //var_dump($teachers);
		// var_dump($teacher->getData('name'));
		// echo $teacher->getData('name');
		// return $teacher->getData('name');
		
		$Teacher = new Teacher;
		$teachers = $Teacher->select();

		// $teacher = $teachers[0];

		// echo '教师名：'.$JiaoShiZhangSan->getData('name').'<br>';
		// return "重复一遍：教师姓名：".$JiaoShiZhangSan->getData('name');
		
		//
		$this->assign('teachers',$teachers);
		//
		$htmls = $this->fetch();
		//
		return $htmls;
	}
	public function insert()
	{
		// return "hello insert";
		//新建测试数据
		// $teacher = array();
		// $teacher['name']="王五";
		// $teacher['username']='wangwu';
		// $teacher['sex']='1';
		// $teacher['email']='wangwu@qq.com';
		// var_dump($teacher);
		//引用teacher数据表对应的模型
		// $Teacher = new Teacher();

		//一切皆对象
		//实例化Teacher空对象
		
		$postdata = Request::instance()->post();
		// var_dump($postdata);
		$Teacher = new Teacher();
		$Teacher->name = $postdata['name'];
		$Teacher->username = $postdata['username'];
		$Teacher->sex = $postdata['sex'];
		$Teacher->email = $postdata['email'];

		$result = $Teacher->validate(true)->save($Teacher->getData());
		if (false === $result) {
			return '新增失败'.$Teacher->getError();

		} else {
			return '新增成功，新增ID为：'.$Teacher->id;
		}
		
		// $Teacher->save();
		// return $Teacher->name.'成功插入数据表，新增ID为：'.$Teacher->id;
		// $Teacher = new Teacher();
		// $Teacher->name = '麻子';
		// $Teacher->sex = '0';
		// $Teacher->email = 'mazi@qq.com';
		// $Teacher->username = 'mazi';
		// var_dump($Teacher);
		// var_dump($Teacher->save());
		//想teacher表中插入数据并判断是否插入成功
		// $state=$Teacher->data($teacher)->save();
		// return $Teacher->name.'成功插入数据表,新增ID为：'.$Teacher->id;

	}
	public function add()
	{
		// return "hello add";
		$Teacher = new Teacher();
		$htmls = $this->fetch();
		return $htmls;

	}
	public function delete()
	{
		// return "hello delete";
		//echo "<pre>";
		$id = Request::instance()->param('id');
		$Teacher = new Teacher();
		$result = $Teacher->where("id=$id")->delete();
		if(false === $result){
			echo "删除数据失败";
		}else{
			echo "删除第{$id}条信息成功";
		}
	}
		
}
 ?>