<?php
/**
 * @todo:Yar php操作类 (主要支持并行yar请求)
 *
 * @author: hughnian
 *
 */

namespace Api\Libs;

class YarClient
{
	public $url    = "";
	public $method = "";
	public $params = array();
	public $ret    = array();
	public $error  = array();

	public function setUrl($url)
	{
		$this->url = $url;	
	}

	public function setMethod($method)
	{
		$this->method = $method;
	}

	public function setParams($params)
	{
		$this->params = $params;
	}

	public function setcallback($reval, $callinfo)
	{
		$this->ret = array('reval'=>$reval, 'callinfo'=>$callinfo);
	}

	public function seterror_callback($type, $error, $callinfo)
	{
		$this->error = array('type'=>$type, 'error'=>$error, 'callinfo'=>$callinfo);
	}

	public function run()
	{	
		\Yar_Concurrent_Client::call($this->url, $this->method, $this->params, "callback", "error_callback");
		\Yar_Concurrent_Client::loop();
	}
}

$YarClient = new YarClient();

/**
 * @todo:yar成功回调
 *
 *
 */
function callback($reval, $callinfo)
{
	global $YarClient;
	$YarClient->mycallback($reval, $callinfo);
}

/**
 * @todo:yar失败回调
 *
 *
 */
function error_callback($type, $error, $callinfo)
{
	global $YarClient;
	$YarClient->myerror_callback($type, $error, $callinfo);
}
