<?php
$dir = "ny-ttx/";
//getting file list
$file_list = glob($dir."*.ttx");
//looping through each file
foreach($file_list as $file){
	$data = file($file,FILE_IGNORE_NEW_LINES);
	//pattern to check
	$panose_start = '~\<panose\>~';
	$panose_end = '~\<\/panose\>~';
	
	$panose_start_ind=$panose_end_ind=0;
	
	//looping through lines
	for($i=0; $i<count($data); $i++){
		if(preg_match($panose_start, $data[$i])){
			$panose_start_ind=$i;
		}
		if(preg_match($panose_end, $data[$i])){
			$panose_end_ind=$i;
		}
	}

	//replace data line with new data
	for($j=$panose_start_ind+1; $j<$panose_end_ind; $j++){
		switch($data[$j]){
			case (preg_match('~\<bFamilyType value\=\"\d*\"\/\>~', $data[$j]) ? true : false) :
				$data[$j]='<bFamilyType value="2"/>';
				break;
			case (preg_match('~\<bSerifStyle value\=\"\d*\"\/\>~', $data[$j]) ? true : false) :
				$data[$j]='<bSerifStyle value="2"/>';
				break;
			case (preg_match('~\<bWeight value\=\"\d*\"\/\>~', $data[$j]) ? true : false) :
				$data[$j]='<bWeight value="5"/>';
				break;
			case (preg_match('~\<bProportion value\=\"\d*\"\/\>~', $data[$j]) ? true : false) :
				$data[$j]='<bProportion value="2"/>';
				break;
			case (preg_match('~\<bContrast value\=\"\d*\"\/\>~', $data[$j]) ? true : false) :
				$data[$j]='<bContrast value="6"/>';
				break;
			case (preg_match('~\<bStrokeVariation value\=\"\d*\"\/\>~', $data[$j]) ? true : false) :
				$data[$j]='<bStrokeVariation value="4"/>';
				break;
			case (preg_match('~\<bArmStyle value\=\"\d*\"\/\>~', $data[$j]) ? true : false) :
				$data[$j]='<bArmStyle value="0"/>';
				break;
			case (preg_match('~\<bLetterForm value\=\"\d*\"\/\>~', $data[$j]) ? true : false) :
				$data[$j]='<bLetterForm value="0"/>';
				break;
			case (preg_match('~\<bMidline value\=\"\d*\"\/\>~', $data[$j]) ? true : false) :
				$data[$j]='<bMidline value="0"/>';
				break;
			case (preg_match('~\<bXHeight value\=\"\d*\"\/\>~', $data[$j]) ? true : false) :
				$data[$j]='<bXHeight value="4"/>';
				break;
			default:
				print("Error: No PANOSE table.");
				break;
		}
	/* PANOSE table	
		'<panose>
			<bFamilyType value="2"/>
			<bSerifStyle value="2"/>
			<bWeight value="5"/>
			<bProportion value="2"/>
			<bContrast value="6"/>
			<bStrokeVariation value="4"/>
			<bArmStyle value="0"/>
			<bLetterForm value="0"/>
			<bMidline value="0"/>
			<bXHeight value="4"/>
		</panose>';
	*/
	}
	
	//merge all line in array to single line string with \r\n
	$output = implode("\r\n", $data);
	//write output to new file in current directory
	file_put_contents((substr($file,strlen($dir),-4).".ttx"), $output);
}
?>