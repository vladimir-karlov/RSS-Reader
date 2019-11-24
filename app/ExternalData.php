<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ExternalData extends Model
{	
    /**
     * Get the RSS Feed XML
     *
     * @return XML String
     */	
     
	public static function getRssFeedXml()
	{
		$curl_handle=curl_init();
		curl_setopt($curl_handle, CURLOPT_URL,'https://www.theregister.co.uk/software/headlines.atom');
		curl_setopt($curl_handle, CURLOPT_CONNECTTIMEOUT, 2);
		curl_setopt($curl_handle, CURLOPT_RETURNTRANSFER, 1);
		$xml = curl_exec($curl_handle);
		curl_close($curl_handle);
		
		return $xml;
	}
	
    /**
     * Get Most Common English Words Array
     *
     * @return Array
     */		
	
	public static function getMostCommonWords()
	{
	    $most_common_english_words_arr = array();		
			    
	    $most_common_english_words_json = file_get_contents('https://raw.githubusercontent.com/jonschlinkert/common-words/master/words.json');
	    $most_common_english_words_mult_arr = json_decode($most_common_english_words_json, true);
	    
	    foreach($most_common_english_words_mult_arr as $key=>$val) {
		    // transform the inital array to match word => rank format (and the $words array below)
		    $most_common_english_words_arr[$val['word']] = $val['rank'];
	    }
		
		return $most_common_english_words_arr;
	}

}
