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
			event like '".qa_opt('qa-topsearch-plugin-param')."' 
			and datetime >= NOW() - INTERVAL 10 day
			ORDER BY datetime DESC
			LIMIT 150";

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
			if(isset($outr[$strings[$i]]))
				$outr[$strings[$i]]++;
			else
				$outr[$strings[$i]] = 0;
		}
		arsort($outr);
		$i = 0;
		$cnt = qa_opt('qa-topsearch-plugin-count');
		if(qa_opt('qa-topsearch-plugin-param') === 'tagsearch')
			$querypage = 'tag-search-page';
		else
			$querypage = 'search';
		foreach ($outr as $key => $value)
		{

			$out .='	<span class="qa-top-search-item"> <a href="'.qa_opt('site_url').$querypage.'?q='.urlencode($key).'">'.$key.'</a> </span>';
			$i++;
			if($i>$cnt)break;

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
