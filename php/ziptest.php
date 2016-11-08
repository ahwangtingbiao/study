<?php   
 function createZip($openFile,$zipObj,$sourceAbso,$newRelat = '')  
{  
    while(($file = readdir($openFile)) != false)  
    {  
        if($file=="." || $file=="..")  
            continue;  
        $sourceTemp = $sourceAbso.'/'.$file;  
        $newTemp = $newRelat==''?$file:$newRelat.'/'.$file;  
        if(is_dir($sourceTemp))  
        {      
            $zipObj->addEmptyDir($newTemp);
            createZip(opendir($sourceTemp),$zipObj,$sourceTemp,$newTemp);  
        }  
        if(is_file($sourceTemp))  
        {             
            $zipObj->addFile($sourceTemp,$newTemp);  
        }  
    }  
}  
 
$zip = new ZipArchive();  
$exdir = 'emoticon';
$exportPath = $exdir;
if(!$zip->open($exportPath.".zip",ZIPARCHIVE::CREATE))  
{ echo "失败";} 
else{
	createZip(opendir($exportPath),$zip,$exportPath); 
	echo "成功";
	} 
$zip->close(); 

//输出下载;
$filename =$exportPath.".zip";
header ( "Cache-Control: max-age=0" );
header ( "Content-Description: File Transfer" );
header ( 'Content-disposition: attachment; filename=' . basename ($filename ) ); // 文件名
header ( "Content-Type: application/zip" ); // zip格式的
header ( "Content-Transfer-Encoding: binary" ); // 告诉浏览器，这是二进制文件
header ( 'Content-Length: ' . filesize ( $filename ) ); // 告诉浏览器，文件大小
@readfile ( $filename );//输出文件;
?>