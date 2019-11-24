<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ExternalData;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
	    // get most common words array
		$most_common_english_words_arr = ExternalData::getMostCommonWords();

	    // get raw rss feed xml	    
		$xml = ExternalData::getRssFeedXml();		
		
		$buff_str = '';
		$common_words = array();
		$feed_entries = array();		
		
		// try to process xml
		$feed = @simplexml_load_string($xml);
		
		// check for error while processing xml and proceed
		if ($feed !== false) {
			foreach($feed->entry as $entry) {
				$title = (string) $entry->title;
				$summary = (string) $entry->summary;
				
				$summary = strip_tags($summary);				
				
				$href = (string) $entry->link['href'];
				$feed_entries[] = array('title'=>$title, 'summary'=>$summary, 'href'=>$href);
				
				// combine title and summary of each entry into one string 
				$buff_str .= $title . ' ' . $summary . ' ';
			}		
			
			$buff_str = strip_tags($buff_str);
			$buff_str = preg_replace("/[^A-Za-z0-9 -]/", '', $buff_str);			
			
			$common_words = array_count_values(str_word_count(strtolower($buff_str), 1));
			
			arsort($common_words);			
			
			$common_words = array_diff_key($common_words, $most_common_english_words_arr);
		}
		
        return view('home', [
	        'xml_error'=> ($feed === false), 
	        'feed_entries'=>$feed_entries, 
	        'common_words' => array_slice($common_words, 0, 10)
        ]);
    }
}