<?
class View {
	static function display($page, $data){
		if(!file_exists('compiled-'.$page.'.tpl') && file_exists($page.'.tpl')) {
			// need to compile template into php
			$text = file_get_contents($page.'.tpl');
			$exploded = explode('{',$text);
			$output = ''; // this will be written to a file
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
			
			file_put_contents('compiled-'.$page.'.tpl', $output);
		}
		?>
		<?include 'compiled-'.$page.'.tpl';?>
		<?
	}
}