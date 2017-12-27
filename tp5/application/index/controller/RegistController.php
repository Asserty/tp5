<?php
namespace app\index\controller;
use app\common\model\Teacher;
use think\Controller;
use think\Request;


class RegistController extends Controller{
    public function index(){
        return $this->fetch();
    }
    public function regist(){
    	//return "hello regist";
     	$post = Request::instance()->post();
     	//var_dump($post);
    	$teacher = Teacher::get(['name'=>$post['userName']]);
    	if(!$teacher){
    		$t = new Teacher();
    		$t->name = $post['userName'];
    		$t->passwd = $post['userPwd'];
    		$t->save();
    		$this->success('注册成功，现在去登陆吧',url('Login/index'));
    	}else{
    		$this->error('该用户名已经被占用');
    	}



    }

}