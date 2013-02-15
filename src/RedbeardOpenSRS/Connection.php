<?php
namespace RedbeardOpenSRS;

class Connection
{
	public static function Call($xml)
	{
		$config = Module::getConfig();
		
		
		$signature 				=	md5(md5($xml.$config['redbeardopensrs']['apikey']).$config['redbeardopensrs']['apikey']);
		$length					=	strlen($xml);
		
		$url = 'https://'.$config['redbeardopensrs']['hostname'].":".$config['redbeardopensrs']['port'].$config['redbeardopensrs']['path'];
		
		$curl_connection = curl_init($url);
		curl_setopt($curl_connection, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($curl_connection, CURLOPT_CONNECTTIMEOUT, 300);
		curl_setopt($curl_connection, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($curl_connection, CURLOPT_POST, true); 
		
		$headers = array();
		$headers[] = "Content-Type: text/xml";
		$headers[] = "X-Username: ".$config['redbeardopensrs']['username'];
		$headers[] = "X-Signature: ".$signature;
		$headers[] = "Content-Length: ".$length;
		
		curl_setopt($curl_connection, CURLOPT_HTTPHEADER, $headers);
		curl_setopt($curl_connection, CURLOPT_POSTFIELDS, $xml);
		
 		$result = curl_exec($curl_connection);
 		if($result === false)
 		{
 			
 		}
		
 		curl_close($curl_connection);
		
		return $result;
	}
	
}