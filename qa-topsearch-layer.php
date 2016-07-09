<?php

class qa_html_theme_layer extends qa_html_theme_base {

	function head_custom()
	{
		qa_html_theme_base::head_custom();

		require_once QA_INCLUDE_DIR.'db/selects.php';
		$this->output('<style type="text/css">'.qa_opt('topsearch_plugin_css').'</style>');
	}



}
?>
