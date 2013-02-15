<?php
namespace RedbeardOpenSRS;

use RedbeardOpenSRS\Object\Domain;

class Test 
{
	
	public function connect()
	{
		$domain = "jemoeder456.com";
		$nameservers = array();
		$nameservers[] = "ns1.nameserver.net";
		$nameservers[] = "ns2.nameserver.net";
		$nameservers[] = "ns3.nameserver.net";
		
		$xml = Object\Domain::Register($domain, $nameservers);
		echo $xml;
		
		die();
		
	}
	
	
}