<?php

class qa_topsearch_widget {

	var $urltoroot;

	function load_module($directory, $urltoroot)
	{
		$this->urltoroot = $urltoroot;
	}

	function allow_template($template)
	{

		return true;
	}

	function allow_region($region)
	{
		return true;

	}

	function output_widget($region, $place, $themeobject, $template, $request, $qa_content)
	{

		require_once QA_INCLUDE_DIR.'db/selects.php';


		$out='<div class="qa-top-search-title"><h2>'.qa_opt('qa-topsearch-plugin-title').'</h2></div>';
		$out.='<div class="qa-top-search">';

		$query = "SELECT params, event  FROM ^eventlog  WHERE 
			event like 'search' 
			and datetime > NOW() - INTERVAL 1000 day
			ORDER BY datetime DESC
			LIMIT 300";

		$result = qa_db_query_sub($query);

		$search = qa_db_read_all_assoc($result);
		$strings = array();


		for($i = 0; $i < count($search); $i++){
			$temp = explode("\t",$search[$i]['params']);
			$strings[] = substr($temp[0],6);
		}
		$outr = array();
		for($i=0; $i <count($strings); $i++)
		{
			$outr[$strings[$i]]++;
		}
		arsort($outr);
		$i = 0;

		foreach ($outr as $key => $value)
		{

			$out .='	<span class="qa-top-search-item"> <a href="'.qa_opt(site_url).'/search?q='.urlencode($key).'">'.$key.'</a> </span>';
			$i++;
			if($i>30)break;

		}
		$out .='</div>';
		$output = '<div class="topsearch-widget-container">'.$out.'</div>';

		$themeobject->output(
				$output
				);			
	}
};


/*
   Omit PHP closing tag to help avoid accidental output
 */
