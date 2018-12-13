<?php
class TrelloRequest
{
	const KEY = '1811d64047505714232f8c94679a96ae';
	const TOKEN = '62d37398f8d7b2ddcdc625a4cde3cf4fa7b4958cd12a29ca83587d0e5e1366ae';
	const TRELLO_API_URL = 'https://api.trello.com/1/';
	const TRELLO_KEY_AND_TOKEN = '?key=1811d64047505714232f8c94679a96ae&token=62d37398f8d7b2ddcdc625a4cde3cf4fa7b4958cd12a29ca83587d0e5e1366ae';
	
	public static function get($url)
	{
		$ch = curl_init();
		
		curl_setopt_array($ch, array(
			CURLOPT_URL => $url,
			//~ CURLOPT_VERBOSE => True,
			CURLOPT_RETURNTRANSFER => True,
		));
		
		$output = curl_exec($ch);
		curl_close($ch);
		
		return $output;
	}
	
	public static function getCard($id, $param = '')
	{
		$url = self::TRELLO_API_URL . 'cards/' . ($param != '' ? "$id/$param" : "$id") . self::TRELLO_KEY_AND_TOKEN;
		$json = self::get($url);
		
		return json_decode($json, true);
	}
	
	public static function getList($id, $param = '')
	{
		$url = self::TRELLO_API_URL . 'lists/' . ($param != '' ? "$id/$param" : "$id") . self::TRELLO_KEY_AND_TOKEN;
		$json = self::get($url);
		
		return json_decode($json, true);
	}
	
	public static function getBoard($id, $param = '')
	{
		$url = self::TRELLO_API_URL . 'boards/' . ($param != '' ? "$id/$param" : "$id") . self::TRELLO_KEY_AND_TOKEN;
		$json = self::get($url);
		
		return json_decode($json, true);
	}
	
	public static function put($url, $data)
	{
		$ch = curl_init();
		
		curl_setopt_array($ch, array(
			CURLOPT_URL            => $url,
			CURLOPT_CUSTOMREQUEST  => "PUT",
			CURLOPT_POSTFIELDS	   => http_build_query($data),
			CURLOPT_RETURNTRANSFER => True,
		));
		
		$output = curl_exec($ch);
		curl_close($ch);
		
		return $output;
	}
}

