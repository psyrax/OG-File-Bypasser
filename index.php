
<?php 
require_once('pclzip.lib.php');
function get_file1($file){ 
    $err_msg = ''; 
    //echo "<br>Attempting message download for $file<br>"; 
    $local_path="files/";
    $newfilename=$local_path.time().basename($file);
    $out = fopen($newfilename, 'wb'); 
    if ($out == FALSE){ 
      print "File not opened<br>"; 
      exit; 
    } 
    
    $ch = curl_init(); 
            
    curl_setopt($ch, CURLOPT_FILE, $out); 
    curl_setopt($ch, CURLOPT_HEADER, 0); 
    curl_setopt($ch, CURLOPT_URL, $file); 
                
    curl_exec($ch); 
 //   echo "<br>Error is : ".curl_error ( $ch); 
   // echo "tu archivo es http://opiumgarden.org/dwnld/".$newfilename."!";
 $info = pathinfo($newfilename);
 $zipped="files/".basename($newfilename, '.'.$info['extension']).time().".zip";
  $archive = new PclZip($zipped);
  $v_list = $archive->add($newfilename);
    curl_close($ch); 
    //fclose($handle); 
	echo "Tu archivo: <a href='".$zipped."'>".$zipped."</a> <br />";
}//end function 

?>
<html>
<head>
<style>
body{
background-color:#000;
text-align:center;
font-size:75%;
color:#222;
font-family:"Helvetica Neue", Arial, Helvetica, sans-serif;
}
.container{
width:512px;
height:384px;
background-image:url('fondo.jpg');
background-repeat:no-repeat;
padding:.5em;
}
.head {
color:#FFF;
background:#000;
margin-bottom:1em;
width:490px;
}
.files {
padding:0;
background:#000;
color:#fff;
text-align:left;
float:left;
}
.loader {
padding:1em;
color:#fff;
text-align:left;
float:left;
}
a:focus, a:hover {color:#09f;}
a {color:#06c;text-decoration:underline;}
</style>
</head>
<title>OG File bypasser</title>
<body>
<div class='container'>
<div class='head'>
OG File bypasser
</div>
<div class='files'>
<?php
if (isset($_POST)&&$_POST['file']!=''){

 $getter = get_file1($_POST['file']); 
}
?>
<form method="POST" action="index.php">
URL del archivo a bypassear:
</div>
<div class='loader'>
<input type="text" name="file" style='width:400px;'/>
</div>
<div class='loader'>
<input type="submit"  value="Bypass bomb!"/>
</form>
</div>
</div>
</body>
</html>