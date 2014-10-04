<?php
//Make sure the file isn't accessed directly.
defined('IN_PLUCK') or exit('Access denied!');

require_once ('data/modules/backup/functions.php');

function backup_pages_admin() {
	global $lang;
	$module_page_admin[] = array(
		'func'  => 'backup',
		'title' => $lang['backup']['name']
	);
	$module_page_admin[] = array(
		'func'  => 'backup_update',
		'title' => $lang['backup']['update_info']
	);
	$module_page_admin[] = array(
		'func'  => 'backup_delete',
		'title' => $lang['backup']['delete_info']
	);
	return $module_page_admin;
}

function backup_page_admin_backup() {
global $lang;
	showmenudiv($lang['backup']['update'],$lang['backup']['update_desc'],'data/image/edit.png','?module=backup&amp;page=backup_update',false);
	backup_read();
	?>
	<p><a href="?action=modules">&lt;&lt;&lt; <?php echo 'powrót'; ?></a></p>	
	<?php
}

function backup_page_admin_backup_update() {
global $lang;
	echo $lang['backup']['doing'];
	
	backup_save ();
	redirect('?module=backup','0');

}

function backup_page_admin_backup_delete() {
global $lang;
	if ((isset($_GET['delfile'])) && (!empty($_GET['delfile'])) && is_file('data/modules/backup/backups/'.$_GET['delfile'])) {
		unlink ('data/modules/backup/backups/' . $_GET['delfile']);
	echo $lang['backup']['deteling'];
	redirect('?module=backup','0');
	}
}
?>