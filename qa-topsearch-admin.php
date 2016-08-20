<?php
class qa_topsearch_admin {

	function allow_template($template)
	{
		return ($template!='admin');
	}

	function option_default($option) {

		switch($option) {
			case 'topsearch_plugin_css':
				return '
qa-top-search-title {
    font: bold;
    font-size: large;
    font-family: Arial;
    font-weight: bold;
    color: #337ab9;
}
.topsearch-widget-container {
    margin-bottom: 10px;}
.qa-top-search {
    margin: 5px;}
	.qa-top-search-item {
margin-right: 3px;
	font-size: x-medium;
       padding-right: 2px;				}

				';
			case 'qa-topsearch-plugin-title':
				return 'Top Searched Content';
			case 'qa-topsearch-plugin-count':
				return '30';
			case 'qa-topsearch-plugin-interval-days':
				return '10';
			case 'qa-topsearch-plugin-param':
				return 'search';
			case 'qa-topsearch-plugin-recent':
				return '';
			default:
				return null;

		}
	}
	function admin_form(&$qa_content)
	{

		//	Process form input

		$ok = null;
		if (qa_clicked('topsearch_save_button')) {
			foreach($_POST as $i => $v) {

				qa_opt($i,$v);
			}

			$ok = qa_lang('admin/options_saved');
		}
		else if (qa_clicked('topsearch_reset_button')) {
			foreach($_POST as $i => $v) {
				$def = $this->option_default($i);
				if($def !== null) qa_opt($i,$def);
			}
			$ok = qa_lang('admin/options_reset');
		}			
		//	Create the form for display


		$fields = array();


		$fields[] = array(
				'label' => 'Top Search custom css',
				'tags' => 'NAME="topsearch_plugin_css"',
				'value' => qa_opt('topsearch_plugin_css'),
				'type' => 'textarea',
				'rows' => 20
				);
		$fields[] = array(
				'label' => 'Top Search Title',
				'tags' => 'NAME="qa-topsearch-plugin-title"',
				'value' => qa_opt('qa-topsearch-plugin-title'),
				'type' => 'text',
				);
		$fields[] = array(
				'label' => 'Top Search Display Count',
				'tags' => 'NAME="qa-topsearch-plugin-count"',
				'value' => qa_opt('qa-topsearch-plugin-count'),
				'type' => 'text',
				);
		$fields[] = array(
				'label' => 'No. of Previous Days to Query searches',
				'tags' => 'NAME="qa-topsearch-plugin-interval-days"',
				'value' => qa_opt('qa-topsearch-plugin-interval-days'),
				'type' => 'text',
				);
		$fields[] = array(
				'label' => 'Search Type',
				'tags' => 'NAME="qa-topsearch-plugin-param"',
				'value' => qa_opt('qa-topsearch-plugin-param'),
				'type' => 'select',
				'options' => array('search'=> 'search','tagsearch'=> 'tagsearch'),
				);
		$fields[] = array(
				'label' => 'Change to Recent Searches',
				'tags' => 'NAME="qa-topsearch-plugin-recent"',
				'value' => qa_opt('qa-topsearch-plugin-recent'),
				'type' => 'checkbox',
				);


		return array(
				'ok' => ($ok && !isset($error)) ? $ok : null,

				'fields' => $fields,

				'buttons' => array(
					array(
						'label' => qa_lang_html('main/save_button'),
						'tags' => 'NAME="topsearch_save_button"',
					     ),
					array(
						'label' => qa_lang_html('admin/reset_options_button'),
						'tags' => 'NAME="topsearch_reset_button"',
					     ),
					),
			    );
	}
	function getMyPath($location) { 
		$getMyPath = str_replace($_SERVER['DOCUMENT_ROOT'],'',$location); 
		return $getMyPath; 
	} 


}
