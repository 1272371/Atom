<?php
	/*
		This class function deals with organising 
		long text/strings that containg paragraphs
		it allows php to handle them in such a way that
		they can be stored in the database
	*/
	 class Text
	 {
		public static function Parse($text)
		{
			$text=str_replace("\r\n","\n", $text);
			$text=str_replace("\r","\n", $text);
			$text=str_replace("\n","\\n", $text);
			return $text;
		}	 	
	 }
?>