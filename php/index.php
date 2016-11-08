<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<title>文件上传及ini读取</title>
 
</head>

<body>
 <?php
//判断临时文件存放路径是否包含用户上传的文件
if(is_uploaded_file($_FILES["uploadfile"]["tmp_name"])){
//为了更高效，将信息存放在变量中
$upfile=$_FILES["uploadfile"];//用一个数组类型的字符串存放上传文件的信息
$name=$upfile["name"];//便于以后转移文件时命名
$type=$upfile["type"];//上传文件的类型
$size=$upfile["size"];//上传文件的大小
$tmp_name=$upfile["tmp_name"];//用户上传文件的临时名称
$error=$upfile["error"];//上传过程中的错误信息
//echo $name;
//对文件类型进行判断，判断是否要转移文件,如果符合要求则设置$ok=1即可以转移
switch($type){
 case "image/jpg": $ok=1;
 break;
 case "image/jpeg": $ok=1;
 break;
 case "image/gif" : $ok=1;
 break;
 case "image/png" : $ok=1;
 break;
 default:$ok=1;
 break;
}
//如果文件符合要求并且上传过程中没有错误
if($ok&&$error=='0'){
 //调用move_uploaded_file（）函数，进行文件转移
 move_uploaded_file($tmp_name,'temp/'.$name);
 //操作成功后，提示成功
 $info = parse_ini_file("temp/info.ini",true);
 echo "名称：".$info['INFO']['NAME']."<br>";
 echo "版本：".$info['INFO']['VERSION']."<br>";
 echo "作者：".$info['INFO']['AUTHOR']."<br>";
 echo "ID：".$info['INFO']['ID']."<br>";
 echo "描述：".$info['INFO']['DESCRIPTION']."<br>";	 
}else{
 //如果文件不符合类型或者上传过程中有错误，提示失败
 echo "<script language=\"javascript\">alert('请上传ini格式文件')</script>";
}

}
 
?>
<form enctype="multipart/form-data" method="post" name="uploadform">
<input type="file" name="uploadfile"  value="Upload File">
<input type="submit" name="submit" value="Upload">
</form>
</body>

</html>
