<?php /* TASKS $Id: tasks.class.php,v 1.43 2004/06/11 23:39:34 edeisoft Exp $ */

require_once( $AppUI->getSystemClass( 'libmail' ) );
require_once( $AppUI->getSystemClass( 'dp' ) );
require_once( $AppUI->getModuleClass( 'projects' ) );



/**
* CRegister Class
*/
class CRegister extends CDpObject {
	var $register_id = NULL;
	var $register_code = NULL;
	var $register_format = NULL;
	var $register_start_date = NULL;
	var $register_end_date = NULL;
	var $register_description = NULL;
	var $register_owner = NULL;
	var $register_client = NULL;
	var $register_project = NULL;
	var $register_ref_id = NULL;
	var $register_state = NULL;


	function CRegister() {
		$this->CDpObject( 'registers', 'register_id' );
	}
}
?>
