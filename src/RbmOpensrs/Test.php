<?php
namespace RbmOpensrs;

class Test 
{
	
	public function connect()
	{
		
		
// 		$hostname				=	"rr-n1-tor.opensrs.net";
		$path					=	"/";
		$port					=	55443;
		
		
		$username				=	"";

//		Live Data
// 		$hostname				=	"rr-n1-tor.opensrs.net";
// 		$apikey					=	"";

//		Test/Dev Data
		$hostname				=	"horizon.opensrs.net";
		$apikey					=	"";
		
		$xml					=	"";
		
		$signature 				=	md5(md5($xml.$apikey).$apikey);
		$length					=	strlen($xml);
		
		$url = 'https://'.$hostname.":".$port.$path;
		
		$curl_connection = curl_init($url);
		curl_setopt($curl_connection, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($curl_connection, CURLOPT_CONNECTTIMEOUT, 300);
		curl_setopt($curl_connection, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($curl_connection, CURLOPT_POST, true); 
		
// 		curl_setopt($curl_connection, CURLOPT_FOLLOWLOCATION, 1);
		//curl_setopt($curl_connection, CURLOPT_POST, true);
		
		$headers = array();
		$headers[] = "Content-Type: text/xml";
		$headers[] = "X-Username: ".$username;
		$headers[] = "X-Signature: ".$signature;
		$headers[] = "Content-Length: ".$length;
		
		curl_setopt($curl_connection, CURLOPT_HTTPHEADER, $headers);
		curl_setopt($curl_connection, CURLOPT_POSTFIELDS, $xml);
		
 		$result = curl_exec($curl_connection);
 		if($result === false)
 		{
 			echo 'Curl error: ' . curl_error($curl_connection);
 		}
		
 		curl_close($curl_connection);
		
		echo $result;
				
// 		echo "---";
		
		die();
		
	}
	
	
}