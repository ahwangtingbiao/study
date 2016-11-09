 <?php 
 
 //创建文件夹
 function createDir($aimUrl) {
        $aimUrl = str_replace('', '/', $aimUrl);
        $aimDir = '';
        $arr = explode('/', $aimUrl);
        $result = true;
        foreach ($arr as $str) {
            $aimDir .= $str . '/';
            if (!file_exists($aimDir)) {
                $result = mkdir($aimDir);
            }
        }
        return $result;
    }

 //写入配置
 function write_ini_file($assoc_arr, $path, $has_sections=FALSE) { 
    $content = ""; 
    if ($has_sections) { 
        foreach ($assoc_arr as $key=>$elem) { 
            $content .= "\n[".$key."]\n"; 
            foreach ($elem as $key2=>$elem2) { 
                if(is_array($elem2)) 
                { 
                    for($i=0;$i<count($elem2);$i++) 
                    { 
                        $content .= $key2."[] = ".$elem2[$i]."\n";
                    } 
                }
                else if($elem2=="") $content .= $key2." = \n"; 
                else $content .= $key2." = ".$elem2."\n"; 
            } 
        } 
    } 
    else { 
        foreach ($assoc_arr as $key=>$elem) { 
            if(is_array($elem)) 
            { 
                for($i=0;$i<count($elem);$i++) 
                { 
                    $content .= $key2."[] = ".$elem[$i]."\n"; 
                } 
            } 
            else if($elem=="") $content .= $key2." = n"; 
            else $content .= $key2." = ".$elem."\n"; 
        } 
    } 
    if (!$handle = fopen($path, 'w')) { 
        return false; 
    } 
    if (!fwrite($handle, $content)) { 
        return false; 
    } 
    fclose($handle); 
    return true; 
}

//写入
$num = $_POST['num'];//表情个数
$type = $_POST['type'];//表情类型
switch($type){
	case 'dynamic':
	$_EXPRESSION_TYPE_QQ = "7";//QQGIF类型
    $_EXPRESSION_TYPE_WX = "6"; //微信GIF类型
	break;
	case 'static':
	$_EXPRESSION_TYPE_QQ = "5";//QQPNG类型
    $_EXPRESSION_TYPE_WX = "1"; //微信PNG类型
	break;
};

$_EXPRESSION_SIZE_V = "3x3"; //竖屏排列
$_EXPRESSION_SIZE_L= "3x4";//横屏排列
$_EXPRESSION_CHILDREN = "";
for ($i=1; $i<=$num; $i++) {
	if($i==$n){
		$_EXPRESSION_CHILDREN =$_EXPRESSION_CHILDREN.'Expression_'.$i;
	}else{
		$_EXPRESSION_CHILDREN =$_EXPRESSION_CHILDREN.'Expression_'.$i.',';
	} 
}

$qq_expression = array(		
				'EXPRESSION' => array(
                    'TYPE' => $_EXPRESSION_TYPE_QQ,
                    'SIZE' => $_EXPRESSION_SIZE_V,
                    'CHILDREN' => $_EXPRESSION_CHILDREN,
                ));

if($type='dynamic'){
	for ($i=1; $i<=$num; $i++) {
			$qq_expression['Expression_'.$i] = array(
                    'TITLE'=> $i,
                    'MAPPING' => $i,
                    'SRC' => $i,
					'PREVIEW_IMAGE' => 'preview_'.$i,
				); 
}
}else{
	for ($i=1; $i<=$num; $i++) {
			$qq_expression['Expression_'.$i] = array(
                    'TITLE'=> $i,
                    'MAPPING' => $i,
                    'SRC' => $i,                   
				); 
  }
}


				
$qq_expression_land = array(		
				'EXPRESSION' => array(
                    'TYPE' => $_EXPRESSION_TYPE_QQ,
                    'SIZE' => $_EXPRESSION_SIZE_L,
                    'CHILDREN' => $_EXPRESSION_CHILDREN,
                ));	

$wx_expression = array(		
				'EXPRESSION' => array(
                    'TYPE' => $_EXPRESSION_TYPE_WX,
                    'SIZE' => $_EXPRESSION_SIZE_V,
                    'CHILDREN' => $_EXPRESSION_CHILDREN,
                ));		

$wx_expression_land = array(		
				'EXPRESSION' => array(
                    'TYPE' => $_EXPRESSION_TYPE_WX,
                    'SIZE' => $_EXPRESSION_SIZE_L,
                    'CHILDREN' => $_EXPRESSION_CHILDREN,
                ));	

$info = array(
                '602' => array(
                    'Type' => $_602_Type,
                    'NM_Color' => $_602_NM_Color,
                    'PR_Color' => $_602_PR_Color,
                    'DS_Color' => $_602_DS_Color,                
                ),
                '640' => array(
                    'Type' => $_604_Type,
                    'NM_Image' => $_604_NM_Image,
                    'PR_Image' => $_604_PR_Image,
                    'DS_Image' => $_604_DS_Image,
				),				
				'EXPRESSION' => array(
                    'TYPE' => $_EXPRESSION_TYPE,
                    'SIZE' => $_EXPRESSION_SIZE,
                    'CHILDREN' => $_EXPRESSION_CHILDREN,
                ));				
	
$info = array(
                'INFO' => array(
                    'PLATFORM' => 'android',
                    'VERSION' => $_VERSION,
                    'NAME' => $_NAME,
                    'AUTHOR' => $_AUTHOR,                
                    'PREVIEW' => 'preview',                
                    'ID' => $ID,                
                    'BASE' => 'templet',                
                    'CONTENT' => 'templet,templet_mm',                
                    'DESCRIPTION' => $DESCRIPTION,                
                ),
                'templet' => array(
                    'NAME' => $_NAME,
                    'DIR' => 'templet', 
                    'SUPPORT' => 'com.tencent.mobileqq',
                    'SUPPORT_VERSION_MIN' => '60',                    
				),				
				'templet_mm' => array(
                    'NAME' => $_NAME,
                    'DIR' => 'templet_mm', 
                    'SUPPORT' => 'com.tencent.mobileqq',
                    'SUPPORT_VERSION_MIN' => '0',      
                ));

$rootdir = date("YmdHis");
$expdir = $rootdir.'/'.$rootdir;
$qqdir = $expdir.'/templet/layout/';
$qqdir_land = $expdir.'/templet/layout_land/';
$qqres = $expdir.'/templet/res/';
$wxdir = $expdir.'/templet_mm/layout/';
$wxdir_land = $expdir.'/templet_mm/layout_land/';
createDir($qqdir);//创建目录
createDir($qqdir_land);//创建目录
createDir($qqres);//创建目录
createDir($wxdir);//创建目录
createDir($wxdir_land);//创建目录
write_ini_file($qq_expression, $qqdir.'expression.ini', true);
write_ini_file($qq_expression_land, $qqdir_land.'expression.ini', true);
write_ini_file($wx_expression, $wxdir.'expression.ini', true);
write_ini_file($wx_expression_land, $wxdir_land.'expression.ini', true);
write_ini_file($info,$expdir.'/info.ini', true);

//print_r($qq_expression);

$exportPath = $rootdir;//设置需要打包的目录
$filename =$rootdir.".exp";//设置压缩包的文件名

include('pack.php');

//读取配置
/* $info = parse_ini_file("temp/info.ini",true);
 if($info){
 echo  "名称：".$info['INFO']['NAME']."<br>";
 } */

?>