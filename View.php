<?
class View {
	static function display($page, $data){
		if(!file_exists($page.'.tpl')){
			trigger_error("Template ".$page.'.tpl does not exist.'); 
			return;
		}
		// Check if compiled template exists ...
		if(file_exists('compiled-'.$page.'.tpl')) {
			// include already compiled template
			?>
			<?include 'compiled-'.$page.'.tpl';?>
			<?
			return;
		}
		// ... or compile it.
		$output = ''; // this will be written to a file
		$text = file_get_contents($page.'.tpl');
		$exploded = explode('{',$text);
		for($i=0; $i<count($exploded); $i++){
			// print escaped variable
			// example: {$variable} is converted into
			//			 htmlspecialchars($data['variable'], ENT_QUOTES)
			if($exploded[$i][0] == '$') {
				$endOfCommand = strpos($exploded[$i], '}');
				$variableName = substr($exploded[$i], 1, $endOfCommand-1);
				$exploded[$i] = str_replace('$'.$variableName."}", "<?=htmlspecialchars(\$data['$variableName'], ENT_QUOTES)?>", $exploded[$i]);
			}
			$output .=$exploded[$i];
		}
		eval('?>'.$output); // evaluate result ...
		// ... and try to write it to the file for future use.
		file_put_contents('compiled-'.$page.'.tpl', $output);
	}
}