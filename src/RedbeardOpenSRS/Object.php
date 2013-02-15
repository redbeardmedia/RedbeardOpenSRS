<?php
namespace RedbeardOpenSRS;

class Object
{
	
	public static $doc;
	public static $root;
	public static $attributes;
	
	public static function setDefaultObject($protocol = "XCP", $object = "DOMAIN", $action = "SW_REGISTER")
	{
		self::$doc = new \DOMDocument('1.0', 'UTF-8');
		self::$doc->formatOutput = true;
		
		self::$root = self::$doc->createElement('OPS_envelope');
		self::$root = self::$doc->appendChild(self::$root);
		
		// HEADER		
		$header = new \DOMElement('header');
		$version = new \DOMElement('version', '0.9');
		$header = self::$root->appendChild($header);
		$version = $header->appendChild($version);
		
		// BODY
		$body = new \DOMElement('body');
		$data_block = new \DOMElement('data_block');
		$dt_assoc = new \DOMElement('dt_assoc'); 
		
		$body = self::$root->appendChild($body);
		$body->appendChild($data_block);
		$data_block->appendChild($dt_assoc);
		
		$item = new \DOMElement('item', $object);
		$dt_assoc->appendChild($item);
		$item->setAttribute('key', 'object');
		
		$item = new \DOMElement('item', $action);
		$dt_assoc->appendChild($item);
		$item->setAttribute('key', 'action');
		
		$item = new \DOMElement('item', $protocol);
		$dt_assoc->appendChild($item);
		$item->setAttribute('key', 'protocol');
		
		$item = new \DOMElement('item');
		$dt_assoc->appendChild($item);
		$item->setAttribute('key', 'attributes');
		
		$dt_assoc = new \DOMElement('dt_assoc'); 
		self::$attributes = $item->appendChild($dt_assoc);
	}
	
	public static function addSimpleItem($parent, $key, $value = false)
	{
		$item = new \DOMElement('item', $value);
		$parent->appendChild($item);
		$item->setAttribute('key', $key);
	}
	
	public static function addItem($parent, $key)
	{
		$item = new \DOMElement('item', $value);
		$item = $parent->appendChild($item);
		$item->setAttribute('key', $key);
		
		$dt_assoc = new \DOMElement('dt_assoc'); 
		return $item->appendChild($dt_assoc);
	}

	public static function addItemArray($parent, $key)
	{
		$item = new \DOMElement('item', $value);
		$item = $parent->appendChild($item);
		$item->setAttribute('key', $key);
		
		$dt_assoc = new \DOMElement('dt_array'); 
		return $item->appendChild($dt_assoc);
	}
	
}
