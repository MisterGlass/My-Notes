<?php

/*
A library of functions commonly needed for projects.
Compiled by Yair Silbermintz, many are sourced from the web
*/

//slugify, pulled from the symfony jobeet tutorial
//makes text URL friendly
	static public function slugify($text)	{
		// code derived from http://php.vrana.cz/vytvoreni-pratelskeho-url.php
		$text = preg_replace('~[^\\pL\d]+~u', '-', $text);  // replace non letter or digits by -
		$text = trim($text, '-');  // trim
		if (function_exists('iconv'))	{  // transliterate
			$text = iconv('utf-8', 'us-ascii//TRANSLIT', $text);
		}
		$text = strtolower($text);  // lowercase
		$text = preg_replace('~[^-\w]+~', '', $text);  // remove unwanted characters

		if (empty($text))	return 'n-a';
		return $text;
	}
	
	/*
	shorten and linkify, used to take a tweet (or other text), shorten it to a specified length without breakign words, add <a> URLs and other items in the text, and append elipses
	Takes 4 arguments:
		string $text - the text to be shortened & linkified
		integer $maxlength - the maximum length of the string to be output. defaults to null, which returns the full length of the submitted string	
		string $elipses - string to be appended if $text is longer than $maxlength. Defaults to ...
		bool $twitter - When true, function will take all words that start with @ or # and add <a> tags to link to their corresponding pages on twitter.
		Function will always convert web address to links. 
	*/
	static public function shortenAndLinkify($text, $maxlength = null, $elipses = '...', $twitter = TRUE)	{
		if ($maxlength !=null && strlen($text) > $maxlength)	{
			//substr without breaking words from http://www.php.net/manual/en/function.substr.php#94705
			$text = substr(($text=wordwrap($text,$maxlength,'$$')),0,strpos($text,'$$')) . $elipses;
		}
		if ($twitter)	{
			//Linkify preg_replace from http://slexy.org/view/s213S9k4Hk
			$text = preg_replace(array('/(https?:\/\/[\w\.\/\?\&\=]+)/', '/#(\w+)/','/@(\w+)/'), array('<a href="$1">$1</a>', '<a href="http://search.twitter.com/search?q=%23$1">#$1</a>','<a href="http://twitter.com/$1">@$1</a>'), $text);
		}
		else	{
			$text = preg_replace(array('/(https?:\/\/[\w\.\/\?\&\=]+)/'), array('<a href="$1">$1</a>'), $text);
		}
		return $text;
	}
	
?>