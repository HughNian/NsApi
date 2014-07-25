<?php
/***
 * @todo: yar客户端接口控制器,带Restful风格接口
 * 
 * @author: hughnian
 *
 * @date: 2014-07-20
 *
 */

namespace Api\Controller;

use Think\Controller\RestController;
use Api\Constant\ApiConst;

class ClientController extends RestController implements ApiConst
{
	protected $allowMethod = array("get", "post", "put", "delete");
	protected $defaultMethod = 'get';
	protected $allowType   = array("json", "xml", "html");
	protected $defaultType = 'json';
	protected $allowOutputType = array( 'xml' => 'application/xml', 'json' => 'application/json','html' => 'text/html');

	private $Yar_Concurrent_Client = Yar_Concurrent_Client;

	public function __construct()
	{
		parent::__construct();
	}

	/**
	 * @todo:yar成功回调
	 *
	 */
	public function callback($reval, $callinfo)
	{
		
	}

	/**
	 * @todo:yar失败回调
	 *
	 */
	public function error_callback($type, $error, $callinfo)
	{
	
	}
	
	/**
	 * @todo:接口返回结果
	 *
	 */
	public function output()
	{	
		if($this->_type == 'json') { //Rest请求如果为json, 返回json数据
			if($this->_method == 'get'){
				$gets = I("get.");
			}
			$data = array('name'=>'niansong', 'sex'=>'男', 'gets'=>$gets);
			$this->response($data, $this->defaultType);
			//$this->Yar_Concurrent_Client::call();
			//$this->Yar_Concurrent_Client::loop("callback", "error_callback");
		} 	
		
		if($this->_type == 'xml') { //Rest请求如果为xml, 返回xml数据
		
		}

		if($this->_type == 'html') { //Rest请求如果为html,就是通过网页浏览器器访问
			exit('here');
		}
	}

}