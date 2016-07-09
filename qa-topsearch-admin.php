<?php
class qa_topsearch_admin {

	function allow_template($template)
	{
		return ($template!='admin');
	}

	function option_default($option) {

		switch($option) {
			case 'topsearch_plugin_css':
				return '.qa-top-search  {
					background-color :cornsilk;
				}

				.qa-top-search-title {
					font: bold;
				}

				.qa-top-search-item {
margin: 3px;
background: #d07a15;
font-size: x-small;
color: white;
padding-right: 2px;
padding-left: 2px;
				}

				';
			case 'qa-topsearch-plugin-title':
				return 'Top Searched Content';
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
