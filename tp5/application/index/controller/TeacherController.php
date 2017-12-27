<?php 
namespace app\index\controller;
//use think\Db;
use app\common\model\Teacher; //as SmallTeacher;

use app\index\controller\CheckController;//用于与v层进行数据传递
use think\Request;
use think\Paginator;
use think\Session;

/**
* 			
*/
class TeacherController	 extends CheckController
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
		
		echo Session::get('UID');
		$Teacher = new Teacher;
		$key = Request::instance()->get('keyword');
		//var_dump($key);
		//if($key){
		//	$Teacher->where("username like '%$key%'");
		//}
		// var_dump($Teacher);
		$teachers = $Teacher->select();
		$pagesize = 5;
		//$teachers = $Teacher::paginate($pagesize,false,['query'=>['keyword'=>$key]]);

		// $teacher = $teachers[0];

		// echo '教师名：'.$JiaoShiZhangSan->getData('name').'<br>';
		// return "重复一遍：教师姓名：".$JiaoShiZhangSan->getData('name');
		
		//var_dump($teachers);
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

		$result = $Teacher->save();
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
		//$Teacher = new Teacher();
		$htmls = $this->fetch();
		return $htmls;

	}
	public function delete()
	{
		// return "hello delete";
		//echo "<pre>";
		$id = Request::instance()->param('id');
		// $Teacher = new Teacher();
		// $result = $Teacher->where("id=$id")->delete();
		
		/**
		 * 老师写的方法
		 */
		//$Teacher中有第$id条数据
		$Teacher = Teacher::get($id);
		// echo "<pre>";
		// var_dump($Teacher);
		// 这样可以直接删除第$id条数据
		$result = $Teacher->delete();
		if(false === $result){
			return "删除数据失败";
		}else{
			return "删除第{$id}条信息成功";
		}
	}

	/**
	 * 
	 */
		
	public function edit(){
		//获取id
		//如果不加后面的/d，则$id是字符型，加上/d则是整型
		$id = Request::instance()->param('id/d');
		// var_dump($id);
		// return $id;
		// $Teacher = new Teacher();
		// $teacher = $Teacher->where("id=$id")->select();
		// //$teacher是一个数组
		// $this->assign("teacher",$teacher[0]);
		 //echo "<pre>";
		 //var_dump($teacher);
		 // echo $teacher->getData('id');
		//$htmls = $this->fetch();
		//return $htmls;
		
		/**
		 * 老师写的方法
		 */
		// 获取当前数据
		if ($Teacher = Teacher::get($id)) {
			// 传给V层
			$this->assign('teacher',$Teacher);
			//获取封装的v层
			$htmls = $this->fetch();
			//返回给用户
			return $htmls;
		} else {
			//说明没有这个数据
			return "系统未找到ID为".$id."的记录";
		}
		
		
	}
	/**
	 * 
	 */
	public function update()
	{
		// 接收数据
		$post = Request::instance()->post();
		//var_dump($post);
		//写入
		$Teacher = new Teacher();
		$result = $Teacher->isUpdate(true)->save($post);
		if($result){
			return "修改成功";
		}else{
			return "修改失败";
		}
		
	}
}
 ?>