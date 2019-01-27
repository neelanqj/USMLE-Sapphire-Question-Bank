<?php

// Code from http://blog.djekldevelopments.co.uk/?p=362
function ARRAYtoXML($array, $depth = 0){
    $indent = '';
    $return = '';
    for($i = 0; $i < $depth; $i++)
        $indent .= "";
    foreach($array as $key => $item){
		if ($depth == 0)
			$return.= "<item>";
		else
        	$return .= "<{$key}>";
        if(is_array($item))
            $return .= ARRAYtoXML($item, $depth + 1);
        else
            $return .= "{$item}";
			
			if ($depth == 0)
				$return.= "</item>";
			else				
				$return .= "</{$key}>";				
        }
    return $return;
}

function jsonToXML($json_data) {
    $data = json_decode($json_data, true);
    
    return "<root>".ARRAYtoXML($data)."</root>";
}

?>