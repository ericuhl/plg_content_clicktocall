<?php

/**
* ClickToCall Content Plugin
*
* @package Joomla.Plugin
* @subpackage Content.clicktocall
* @since 3.0
*/

//Restrict Access to this file
defined('_JEXEC') or die;

//Loads the standard classes for a Joomla Plugin
jimport('joomla.plugin.plugin');

//Create unique class for our plugin
class plgContentClicktocall extends JPlugin
{
	function plgContentClicktocall( &$subject, $params )
	{
		parent::__construct( $subject, $params );
	}
	//Before Joomla outputs the content....
	public function onContentPrepare($context, &$row, &$params, $page = 0){
		// Do not run this plugin when the content is being indexed
		if ($context == 'com_finder.indexer'){
			return true;
		}
		if (is_object($row)){
			return $this->clickToCall($row->text, $params);
		}
		//if everything checks out, then run the clickToCall function
		return $this->clickToCall($row, $params);
	}
	protected function clickToCall(&$text, &$params){
		// phone number pattern....
		$pattern = '~(\+?\d?\d?)\s?\(?(\d{3})\)?[\s.-](\d{3})[\s.-](\d{4})~';
		//replacement pattern...
		$replacement = '<a href="tel:$1 $2 $3 $4">$1 ($2) $3-$4</a>';
		//use preg_replace to actually replace the pattern
		$text = preg_replace($pattern, $replacement, $text);
		//return the new value
		return true;
	}
}




