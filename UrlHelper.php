<?php
class UrlHelper {
	
	/**
	 *
	 * Convert a text to a url-friendly text, plus check for the uniqueness of it
	 *
	 * @param	String		$text	The text to convert
	 * @param	Callable	$unique	Callable to check if alias is unique
	 * @return	String
	 *
	 */
	public static function alias($text, $unique=null) {
		// Replace everything that isn't an alphanumeric character with a space
		// and by the way lower the characters
		$text=preg_replace('/[^a-z0-9]/', ' ', strtolower($text));

		// Replace multiple spaces with a single space
		$text=preg_replace('/\s+/', ' ', $text);

		// Now replace the spaces with a dash
		$text=str_replace(' ', '-', $text);

		// Trim the string with a few additional characters
		$text=trim($text, '.-_|');

		// Return false if nothing is left
		if(empty($text))
			return false;

		// Return the alias if the $unique parameter is not a callable function
		if(!is_callable($unique))
			return $text;
			
		// This is a recursion, make sure the function at some point returns true
		while($unique($text)!==true) {
			// Match any digit at the end of the string
			preg_match('/(\d+)$/', $text, $matches);
				
			// If there's a match, increment it by one
			if(isset($matches[1])) {
				$num=intval($matches[1])+1;
				$text=substr($text, 0, -(strlen($matches[1]))).$num;
			} else {
				// It is a duplicate anyway, so we add '-1'
				$text.='-1';
			}
		}

		return $text;
	}
}
