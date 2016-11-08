<?php
$id = $_POST['id'];

$zip = new ZipArchive();
$filename = "./" . date("YmdHis") . $id . ".zip";
if ($zip->open($filename, ZIPARCHIVE::CREATE) !== TRUE) {
	exit("无法创建 <$filename>\n");
}
$files = listdir();
foreach ($files as $path) {
	$zip->addFile($path, str_replace("./", "", str_replace("\\", "/", $path)));
}
//打包输出
header('Location:' . $filename . '');
$zip->close();


Function listdir($start_dir = './tmp') {
	$files = array();
	if (is_dir($start_dir)) {
		$fh = opendir($start_dir);
		while (($file = readdir($fh)) !== false) {
			if (strcmp($file, '.') == 0 || strcmp($file, '..') == 0) continue;
			$filepath = $start_dir . '/' . $file;
			if (is_dir($filepath)) $files = array_merge($files, listdir($filepath));
			else array_push($files, $filepath);
		}
		closedir($fh);
	} else {
		$files = false;
	}
	return $files;
}
?>
