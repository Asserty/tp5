<?php
namespace app\index\controller;
use app\common\model\Teacher;
use think\Controller;
use think\Request;
use think\Session;

class LoginController extends Controller{
    public function index(){
        return $this->fetch();
    }
    public function login(){
        $post = Request::instance()->post();
        //echo $post['userName'];
        $teacher = Teacher::get(['name'=>$post['userName']]);
        
        if($teacher && $teacher['passwd'] === $post['userPwd']){
        	Session::set('UID',$teacher['id']);
        	$this->success('登陆成功',url('Teacher/index'));
        }else{
        	$this->error('用户不存在或密码错误');
        }
    }
    public function logout(){
    	session::clear();
    	$this->redirect('Teacher/index');
    }

}
 
?>