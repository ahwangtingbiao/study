 <?php
 
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
 

 
 //写入示例
$_602_Type = 5;
$_602_NM_Color = "FF5c5c5c";
$_602_PR_Color = "FF5c5c5c";
$_602_DS_Color = "805c5c5c";

$_604_Type = 20;
$_604_NM_Image = "4";
$_604_PR_Image = "12";
$_604_DS_Image = "4";

$_EXPRESSION_TYPE = "5";
$_EXPRESSION_SIZE = "3x3";
$_EXPRESSION_CHILDREN = "Expression_1,Expression_2,Expression_3";


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

print_r($info);
//write_ini_file($info, 'temp/config2.ini', true);

//读取配置
$info = parse_ini_file("temp/info.ini",true);
 if(!$info){
 echo  "名称：".$info['INFO']['NAME']."<br>";
 echo "版本：".$info['INFO']['VERSION']."<br>";
 echo "作者：".$info['INFO']['AUTHOR']."<br>";
 echo "ID：".$info['INFO']['ID']."<br>";
 echo "描述：".$info['INFO']['DESCRIPTION']."<br>";
 }


 ?>