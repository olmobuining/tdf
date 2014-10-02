<?php

class myActions extends sfActions
{

    protected function setTitle($string, $before = '', $after = '', $separator = '')
    {
		
		if (empty($separator)){
			$separator = sfConfig::get('app_title_separator');
		}
		
		if ($before === false){
			$before = sfConfig::get('app_title_before')." ".$separator;
		} elseif($before == '') {
			$before = '';
		} else  {
			$before = $before." ".$separator;
		}
		if ($after == ''){
			$after = $separator." ".sfConfig::get('app_title_default');
		}elseif($after === false) {
			$after = '';
		} else  {
			$after = $separator." ".$after;
		}
		
		$this->getResponse()->setTitle($before  ." ". $string ." ". $after);
    }

}

?>