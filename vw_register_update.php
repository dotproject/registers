<?php 
GLOBAL $AppUI;

// check permissions
/*$canEdit = !getDenyEdit( 'tasks', $task_id );
if (!$canEdit) {
	$AppUI->redirect( "m=public&a=access_denied" );
}*/

//$task_log_id = intval( dPgetParam( $_GET, 'task_log_id', 0 ) );
$register_id = intval( dPgetParam( $_GET, 'register_id', 0 ) );
$register = new CRegister();

if ($register_id) {
	$register->load( $register_id );
}/* else {
	$register->task_log_task = $register_id;
	$log->task_log_name = $obj->task_name;
}*/

// Lets check which cost codes have been used before
/*$sql = "select distinct task_log_costcode
        from task_log
        where task_log_costcode != ''
        order by task_log_costcode";
$task_log_costcodes = array(""); // Let's add a blank default option
$task_log_costcodes = array_merge($task_log_costcodes, db_loadColumn($sql));
*/

//if ($canEdit) {
// Task Update Form
//	$df = $AppUI->getPref( 'SHDATEFORMAT' );
//	$log_date = new CDate( $log->task_log_date );

//	if ($register_id) {
//		echo $AppUI->_( "Edit Register" );
//	} else {
//		echo $AppUI->_( "Add Register" );
//	}
//	$start_date = new CDate();
//	$end_date = new CDate();
?>

<script>
 function ViewField()
 {
  with (document.editFrm)
  {
   switch (register_format.options[register_format.selectedIndex].value)
   {
    case "1":
     register_code.disabled=0;
     register_start_date.disabled=0;
     register_end_date.disabled=1;
     register_description.disabled=0;
//     register_creator.disabled=1;
     register_client.disabled=1;
     register_project.disabled=1;
     register_ref_id.disabled=0;
     register_state.disabled=1;
     register_owner.disabled=1;
    break;
    case "2":
     register_code.disabled=0;
     register_start_date.disabled=0;
     register_end_date.disabled=0;
     register_description.disabled=0;
//     register_creator.disabled=1;
     register_client.disabled=1;
     register_project.disabled=1;
     register_ref_id.disabled=1;
     register_state.disabled=0;
     register_owner.disabled=1;
    break;
    case "3":
     register_code.disabled=0;
     register_start_date.disabled=0;
     register_end_date.disabled=0;
     register_description.disabled=1;
//     register_creator.disabled=1;
     register_client.disabled=1;
     register_project.disabled=1;
     register_ref_id.disabled=0;
     register_state.disabled=0;
     register_owner.disabled=1;
    break;
    case "4":
     register_code.disabled=0;
     register_start_date.disabled=0;
     register_end_date.disabled=1;
     register_description.disabled=0;
//     register_creator.disabled=1;
     register_client.disabled=1;
     register_project.disabled=1;
     register_ref_id.disabled=1;
     register_state.disabled=1;
     register_owner.disabled=1;
    break;
    case "5":
     register_code.disabled=1;
     register_start_date.disabled=0;
     register_end_date.disabled=0;
     register_description.disabled=1;
//     register_creator.disabled=0;
     register_client.disabled=0;
     register_project.disabled=0;
     register_ref_id.disabled=1;
     register_state.disabled=1;
     register_owner.disabled=0;
    break;
    case "6":
     register_code.disabled=0;
     register_start_date.disabled=0;
     register_end_date.disabled=0;
     register_description.disabled=0;
//     register_creator.disabled=0;
     register_client.disabled=0;
     register_project.disabled=0;
     register_ref_id.disabled=1;
     register_state.disabled=1;
     register_owner.disabled=0;
    break;
    default:
   }
  }
 }
</script>

<table cellspacing="1" cellpadding="2" border="0" width="100%">
<form name="editFrm" action="?m=registers" method="post">
	<input type="hidden" name="dosql" value="do_updateregisters" />
<tr>
	<td align="right">
		<?php echo $AppUI->_('Register Code');?>
	</td>
	<td nowrap="nowrap">
          <input type="text" name="register_code" class="text">
	</td>
</tr>
<tr>
	<td align="right">
		<?php echo $AppUI->_('Start Date');?>
	</td>
	<td nowrap="nowrap">
          <input type="text" name="register_start_date" value="<?php echo date("d/m/Y");?>" class="text">
	</td>
	<td align="right"><?php echo $AppUI->_('Format');?>:</td>
	<td>
<?php
 $register_format=dPgetsysVal('RegisterCode');
 echo arraySelect( $register_format, 'register_format', 'size="1" class="text" onChange="ViewField();"',0, false );
?>
	</td>
</tr>
<tr>
	<td align="right">
		<?php echo $AppUI->_('End Date');?>
	</td>
	<td nowrap="nowrap">
		<input type="text" name="register_end_date">
	</td>

	<td rowspan="3" align="right" valign="top"><?php echo $AppUI->_('Description');?>:</td>
	<td rowspan="3">
		<textarea name="register_description" class="textarea" cols="50" rows="6"><?php echo $register->register_description;?></textarea>
	</td>
</tr>
<tr>
<?php
 $contactos = db_loadHashList ("select contact_id,contact_company from contacts");
 $contactos = arrayMerge( array( '0'=> $AppUI->_('none') ), $contactos);

?>
	<td align="right"><?php echo $AppUI->_('Contacts');?></td>
	<td>
<?php
  echo arraySelect($contactos,'register_client', 'size="1" class="text"',0, false );
?>
	</td>

</tr>
<tr>
<?php
 $projects = db_loadHashList ("select project_id,project_name from projects");
 $projects = arrayMerge( array( '0'=> $AppUI->_('none') ), $projects);

?>
	<td align="right"><?php echo $AppUI->_('Projects');?></td>
	<td>
<?php
  echo arraySelect($projects,'register_project', 'size="1" class="text"',0, false );
?>
	</td>
</tr>
<tr>
	<td align="right"><?php echo $AppUI->_('RState');?></td>
	<td>
<?php
 $rstate=dPgetsysVal('RegisterState');
 echo arraySelect( $rstate, 'register_state', 'size="1" class="text"',0, false );
?>
	</td>
	<td colspan="4" valign="bottom" align="right">
		<input type="button" class="button" value="<?php echo $AppUI->_('Insert Register');?>" onClick="document.editFrm.submit();return false;"/>
	</td>

</tr>
<tr>
	<td align="right">
		<?php echo $AppUI->_('Reference');?>
	</td>
	<td nowrap="nowrap">
          <input type="text" name="register_ref_id" class="text">
	</td>
</tr>
<tr>
<?php
 $users = db_loadHashList ("select user_id,user_username from users");
?>
	<td align="right"><?php echo $AppUI->_('Owner');?></td>
	<td>
<?php
  echo arraySelect($users,'register_owner', 'size="1" class="text"',0, false );
?>
	</td>

</tr>

</form>
</table>
