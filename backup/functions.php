<?php
//Make sure the file isn't accessed directly
defined('IN_PLUCK') or exit('Access denied!');


function backup_save () {
global $lang;

$filename = 'data/modules/backup/backups/'. date("H.i-d.m.y", time()).'.tar';

$phar = new PharData($filename);
$phar->buildFromDirectory('data/settings/');

file_put_contents($filename.'.gz' , gzencode(file_get_contents($filename)));

chmod ($filename, 0777);
chmod ($filename.'.gz', 0777);
@unlink ($filename);
}

function backup_read () {
global $lang;
	if ($files = read_dir_contents('data/modules/backup/backups', 'files')) {
		foreach ($files as $file) {
		?>
		<div class="menudiv">
			<span class="title-page"><?php echo $file; ?></span>
			<span>
				<a href="data/modules/backup/backups/<?php echo $file; ?>" title="<?php echo $lang['backup']['download']; ?>">
					<img src="data/image/down.png" title="<?php echo $lang['backup']['download']; ?>" alt="<?php echo $lang['backup']['download']; ?>" /><?php echo $lang['backup']['download']; ?>
				</a>
			</span>
			<span>
				<a href="?module=backup&amp;page=backup_delete&amp;delfile=<?php echo $file; ?>" title="<?php echo $lang['backup']['delete']; ?>">
					<img src="data/image/delete.png" title="<?php echo $lang['backup']['delete']; ?>" alt="<?php echo $lang['backup']['delete']; ?>" /><?php echo $lang['backup']['delete']; ?>
				</a>
			</span>
		</div>
		<?php
		}
	}
}


?>
