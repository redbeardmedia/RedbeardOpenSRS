<?php
namespace RedbeardOpenSRS\Object;

class Domain extends \RedbeardOpenSRS\Object
{
	
	public static function Register($domain, $nameservers)
	{
		parent::setDefaultObject("XCP", "DOMAIN", "SW_REGISTER");
		$parent = parent::$attributes;
		
		// Default data		
		parent::addSimpleItem($parent, "auto_renew");
		parent::addSimpleItem($parent, "reg_domain");
		parent::addSimpleItem($parent, "f_lock_domain", '1');
		parent::addSimpleItem($parent, "f_whois_privacy", '1');
		parent::addSimpleItem($parent, "f_parkp", '1');
		parent::addSimpleItem($parent, "domain", $domain);
		parent::addSimpleItem($parent, "affiliate_id");
		parent::addSimpleItem($parent, "period", '1');
		parent::addSimpleItem($parent, "reg_type", 'new');
		parent::addSimpleItem($parent, "comments", 'No comment');
		parent::addSimpleItem($parent, "reg_username", 'dmn_username');
		parent::addSimpleItem($parent, "reg_password", 'dmn_password');
		parent::addSimpleItem($parent, "custom_tech_contact", '0');
		parent::addSimpleItem($parent, "custom_nameservers", '1');
		

		// Contacts
		$contactElement = parent::addItem($parent, "contact_set");
		// Owner
			$ownerElement = parent::addItem($contactElement, 'owner');
				parent::addSimpleItem($ownerElement, 'first_name', 'First');
				parent::addSimpleItem($ownerElement, 'last_name', 'and Last');
				parent::addSimpleItem($ownerElement, 'org_name', 'First and Last co');
				parent::addSimpleItem($ownerElement, 'address1', 'Address 1234');
				parent::addSimpleItem($ownerElement, 'postal_code', '1882AB');
				parent::addSimpleItem($ownerElement, 'city', 'Lutjebroek');
				parent::addSimpleItem($ownerElement, 'country', 'NL');
				parent::addSimpleItem($ownerElement, 'phone', '+31.165121120');
				parent::addSimpleItem($ownerElement, 'email', 'email@address.net');
				
			$adminElement = parent::addItem($contactElement, 'admin');
				parent::addSimpleItem($adminElement, 'first_name', 'First');
				parent::addSimpleItem($adminElement, 'last_name', 'and Last');
				parent::addSimpleItem($adminElement, 'org_name', 'First and Last co');
				parent::addSimpleItem($adminElement, 'address1', 'Address 1234');
				parent::addSimpleItem($adminElement, 'postal_code', '1882AB');
				parent::addSimpleItem($adminElement, 'city', 'Lutjebroek');
				parent::addSimpleItem($adminElement, 'country', 'NL');
				parent::addSimpleItem($adminElement, 'phone', '+31.165121120');
				parent::addSimpleItem($adminElement, 'email', 'email@address.net');
				
			$billingElement = parent::addItem($contactElement, 'billing');
				parent::addSimpleItem($billingElement, 'first_name', 'First');
				parent::addSimpleItem($billingElement, 'last_name', 'and Last');
				parent::addSimpleItem($billingElement, 'org_name', 'First and Last co');
				parent::addSimpleItem($billingElement, 'address1', 'Address 1234');
				parent::addSimpleItem($billingElement, 'postal_code', '1882AB');
				parent::addSimpleItem($billingElement, 'city', 'Lutjebroek');
				parent::addSimpleItem($billingElement, 'country', 'NL');
				parent::addSimpleItem($billingElement, 'phone', '+31.165121120');
				parent::addSimpleItem($billingElement, 'email', 'email@address.net');
				
		
		// Nameservers
		$nameserverElement = parent::addItemArray($parent, "nameserver_list");
		$nameserverSortorder = 1;
		foreach($nameservers as $key => $nameserver)
		{
			$currentElement = parent::addItem($nameserverElement, $key);
			parent::addSimpleItem($currentElement, 'sortorder', $nameserverSortorder);
			parent::addSimpleItem($currentElement, 'name', $nameserver);
			
			$nameserverSortorder++;
		}

		parent::addSimpleItem($parent, "encoding_type");
		
		$xml = parent::$doc->saveXML();
		// return $xml;
		return \RedbeardOpenSRS\Connection::Call($xml);
	}
	
}
