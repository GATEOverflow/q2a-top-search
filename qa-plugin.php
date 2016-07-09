<?php



	if (!defined('QA_VERSION')) { // don't allow this page to be requested directly from browser
			header('Location: ../../');
			exit;
	}
	
	qa_register_plugin_layer('qa-topsearch-layer.php', 'Top Search Layer');	
	
	qa_register_plugin_module('widget', 'qa-topsearch-widget.php', 'qa_topsearch_widget', 'Top Search Widget');


	qa_register_plugin_module('module', 'qa-topsearch-admin.php', 'qa_topsearch_admin', 'Top Search Admin');

/*
	Omit PHP closing tag to help avoid accidental output
*/
