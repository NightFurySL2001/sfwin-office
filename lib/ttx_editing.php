<?php
$dir = "test/";
//getting file list
$file_list = glob($dir."*.ttx");
//looping through each file
foreach($file_list as $file){
	$data = file($file,FILE_IGNORE_NEW_LINES);
	//patterns to check
	$string_nameID1 = '<namerecord nameID="1" platformID="3" platEncID="1" langID="0x409">';
	$string_nameID2 = '<namerecord nameID="2" platformID="3" platEncID="1" langID="0x409">';
	$pattern_fsSel = '~\<fsSelection value\=\"00000000 [01]{8}\"\/\>~';
	$pattern_macStyle = '~\<macStyle value\=\"00000000 [01]{8}\"\/\>~';
	
	$nameID1=$nameID2=$fsSel=$macStyle="";
	$nameID1_ind=$nameID2_ind=$fsSel_ind=$macStyle_ind=0;
	
	//looping through lines
	for($i=0; $i<count($data); $i++){
		if(trim($data[$i]) == $string_nameID1){
			$nameID1=trim($data[$i+1]);
			$nameID1_ind=$i+1;
		}
		if(trim($data[$i]) == $string_nameID2){
			$nameID2=trim($data[$i+1]);
			$nameID2_ind=$i+1;
		}
		if(preg_match($pattern_fsSel, $data[$i])){
			$fsSel_ind=$i;
		}
		if(preg_match($pattern_macStyle, $data[$i])){
			$macStyle_ind=$i;
		}
	}
	
	//check for regular/italic/bold/bold italic n set lines, else set to other weight
	switch($nameID2){
		case "Regular":
			$fsSel = '<fsSelection value="00000000 01000000"/>';
			$macStyle = '<macStyle value="00000000 00000000"/>';
			break;
		case "Italic":
			$fsSel = '<fsSelection value="00000000 00000001"/>';
			$macStyle = '<macStyle value="00000000 00000010"/>';
			break;
		case "Regular Italic":
			$fsSel = '<fsSelection value="00000000 00000001"/>';
			$macStyle = '<macStyle value="00000000 00000010"/>';
			$nameID2 = "Italic";
			break;
		case "Bold":
			$fsSel = '<fsSelection value="00000000 00100000"/>';
			$macStyle = '<macStyle value="00000000 00000001"/>';
			break;
		case "Bold Italic":
			$fsSel = '<fsSelection value="00000000 00100001"/>';
			$macStyle = '<macStyle value="00000000 00000011"/>';
			break;	
		default:
			if(substr($nameID2,-6) != "Italic"){
				//regular weight
				$fsSel = '<fsSelection value="00000000 00000000"/>';
				$macStyle = '<macStyle value="00000000 00000000"/>';
				$nameID1 = $nameID1." ".$nameID2;
				$nameID2 = "Regular";
			} else {
				//italic weight
				$fsSel = '<fsSelection value="00000000 00000001"/>';
				$macStyle = '<macStyle value="00000000 00000010"/>';
				$nameID1 = $nameID1." ".substr_replace($nameID2,"",-7);
				$nameID2 = "Italic";
			}
			break;
	}
	//replace data line with new data
	$data[$nameID1_ind]=$nameID1;
	$data[$nameID2_ind]=$nameID2;
	$data[$fsSel_ind]=$fsSel;
	$data[$macStyle_ind]=$macStyle;
	//merge all line in array to single line string with \r\n
	$output = implode("\r\n", $data);
	//output name ID for checking
	echo($nameID1."<br>\r\n".$nameID2."<br>\r\n".$fsSel."<br>\r\n".$macStyle."<br>\r\n");
	//write output to new file in current directory
	file_put_contents((substr($file,strlen($dir),-4).".ttx"), $output);
}
?>