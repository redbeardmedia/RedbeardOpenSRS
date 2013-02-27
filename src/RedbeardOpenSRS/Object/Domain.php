<?php
namespace RedbeardOpenSRS\Object;

class Domain extends \RedbeardOpenSRS\Object
{
	
	public static function Register($domain, $nameservers, $contacts)
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
		parent::addSimpleItem($parent, "reg_username", 'username');
		parent::addSimpleItem($parent, "reg_password", 'password');
		parent::addSimpleItem($parent, "custom_tech_contact", '0');
		parent::addSimpleItem($parent, "custom_nameservers", '1');
		

		// Contacts
		$contactElement = parent::addItem($parent, "contact_set");
		// Owner'
			$owner = $contacts['owner'];
		
			$ownerElement = parent::addItem($contactElement, 'owner');
				parent::addSimpleItem($ownerElement, 'first_name', 		$owner->firstname);
				parent::addSimpleItem($ownerElement, 'last_name', 		$owner->lastname);
				parent::addSimpleItem($ownerElement, 'org_name', 		$owner->organisation);
				parent::addSimpleItem($ownerElement, 'address1', 		$owner->address1);
				if($owner->address2 != "")
				{
					parent::addSimpleItem($ownerElement, 'address2', 		$owner->address2);
				}
				if($owner->address3 != "")
				{
					parent::addSimpleItem($ownerElement, 'address3', 		$owner->address3);
				}
				parent::addSimpleItem($ownerElement, 'postal_code', 	$owner->postcode);
				parent::addSimpleItem($ownerElement, 'city', 			$owner->city);
				parent::addSimpleItem($ownerElement, 'country', 		$owner->country);
				parent::addSimpleItem($ownerElement, 'phone', 			$owner->phone);
				if($owner->fax != "")
				{
					parent::addSimpleItem($ownerElement, 'fax', 		$owner->fax);
				}
				parent::addSimpleItem($ownerElement, 'email', 			$owner->emailaddress);
				
			$admin = $contacts['administrative'];
			$adminElement = parent::addItem($contactElement, 'admin');
				parent::addSimpleItem($adminElement, 'first_name', 		$admin->firstname);
				parent::addSimpleItem($adminElement, 'last_name', 		$admin->lastname);
				parent::addSimpleItem($adminElement, 'org_name', 		$admin->organisation);
				parent::addSimpleItem($adminElement, 'address1', 		$admin->address1);
				if($admin->address2 != "")
				{
					parent::addSimpleItem($adminElement, 'address2', 		$admin->address2);
				}
				if($admin->address3 != "")
				{
					parent::addSimpleItem($adminElement, 'address3', 		$admin->address3);
				}
				parent::addSimpleItem($adminElement, 'postal_code', 	$admin->postcode);
				parent::addSimpleItem($adminElement, 'city', 			$admin->city);
				parent::addSimpleItem($adminElement, 'country', 		$admin->country);
				parent::addSimpleItem($adminElement, 'phone', 			$admin->phone);
				if($admin->fax != "")
				{
					parent::addSimpleItem($adminElement, 'fax', 		$admin->fax);
				}
				parent::addSimpleItem($adminElement, 'email', 			$admin->emailaddress);
				
			$billing = $contacts['billing'];
			$billingElement = parent::addItem($contactElement, 'billing');
				parent::addSimpleItem($billingElement, 'first_name', 		$billing->firstname);
				parent::addSimpleItem($billingElement, 'last_name', 		$billing->lastname);
				parent::addSimpleItem($billingElement, 'org_name', 		$billing->organisation);
				parent::addSimpleItem($billingElement, 'address1', 		$billing->address1);
				if($admin->address2 != "")
				{
					parent::addSimpleItem($billingElement, 'address2', 		$billing->address2);
				}
				if($admin->address3 != "")
				{
					parent::addSimpleItem($billingElement, 'address3', 		$billing->address3);
				}
				parent::addSimpleItem($billingElement, 'postal_code', 	$billing->postcode);
				parent::addSimpleItem($billingElement, 'city', 			$billing->city);
				parent::addSimpleItem($billingElement, 'country', 		$billing->country);
				parent::addSimpleItem($billingElement, 'phone', 			$billing->phone);
				if($admin->fax != "")
				{
					parent::addSimpleItem($billingElement, 'fax', 		$billing->fax);
				}
				parent::addSimpleItem($billingElement, 'email', 			$billing->emailaddress);
				
		
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

		return \RedbeardOpenSRS\Connection::Call($xml);
	}
	
}
