<?php 
namespace app\index\controller;
use think\Controller;//用于与v层进行数据传递
use think\Session;

/**
* 			
*/
class CheckController extends Controller
{		
	public function __construct($value='')
	{
		parent::__construct();
		if(!session::has('UID')){
			$this->error('请先登陆',url('Login/index'));
		}
	}
}
?>