<?php
/*
* Developer: Matthew Donald Auld (Lycrios)
* File started: 9/6/2016 11:51:40 PM
* File: documenter.class.php
*/

class Document{
	public $title = "";
	public $base_url = "http://www.test.com/";
	public $version = 0.001;
	public $functions = array();
	private $homepage = "NO DESCRIPTION";

	public function __construct($file){
		$yaml = yaml_parse_file($file);
		$this->title = $yaml["project"]["name"];
		$this->version = $yaml["project"]["version"];
		$this->base_url = $yaml["project"]["access-url"];
		$this->functions = $yaml["functions"];
		$this->homepage = $yaml["project"]["home-description"];
	}

	public function renderPage($page,$parameters){
		switch($page){
			case "home":
				$this->renderHomePage();
				break;
			case "function":
				$this->renderFunctionPage($parameters);
				break;
			default:
				$this->render404();
		}
	}

	private function renderHomePage(){
		echo "<h1 class=\"text-center\">".$this->title." v".$this->version."</h1>";
		echo $this->homepage;
	}

	private function render404(){
		echo "<h1 class=\"text-center\">404 - Not Found</h1>";
	}

	private function renderFunctionPage($parameters){
		include("tpl/function.tpl.php");
	}

	public function getFunction($function){
		foreach ($this->functions as $key => $value) {
			if($function == $value["name"]){
				return $this->functions[$key];
			}
		}
		return null;
	}

	public function formatValue($value,$level = 2){
		$html = "";
		if(is_bool($value)){
			$html .= "<span class=\"text-warning\">".(isset($value) ? ($value == 1 ? "true" : "false") : "false")."</span>";
		}elseif(is_int($value) || is_float($value) || is_double($value)){
			$html .= "<span class=\"text-info\">".(isset($value) ? $value : "0")."</span>";
		}elseif(is_array($value)){
			$html .= "[\n";
			foreach ($value as $key => $v) {
				for($i=0;$i<$level;$i++){
					$html .= "\t\t";
				}
				if(isset($v["name"])){
					$html .= $this->formatValue($v["name"],$level + 1).": ".$this->formatValue($v["value"],$level + 1).",\n";
				}else{
					$html .= $this->formatValue($v["value"],$level + 1).",\n";
				}
				
			}
			for($i=0;$i<$level-1;$i++){
				$html .= "\t\t";
			}
			$html .= "]";
		}else{
			$html .= "<span class=\"text-success\">\"".(isset($value) ? $value : "<i>N/A</i>")."\"</span>";
		}

		return $html;
	}

	public function generateSuccessExample($function_name){
		$func = $this->getFunction($function_name);
		if(isset($func["success"]["results"])){
			$html = "{\n";
			foreach ($func["success"]["results"] as $key => $value) {

				$html .= "\t<span class=\"text-success\">\"$value[name]\"</span>: ";
				if(isset($value["example"])){
					if(is_bool($value["example"])){
						$html .= "<span class=\"text-warning\">".(isset($value["example"]) ? ($value["example"] == 1 ? "true" : "false") : "false")."</span>";
					}elseif(is_int($value["example"]) || is_float($value["example"]) || is_double($value["example"])){
						$html .= "<span class=\"text-info\">".(isset($value["example"]) ? $value["example"] : "0")."</span>";
					}elseif(is_array($value["example"])){
						$html .= "[\n";
						foreach ($value["example"] as $key => $value) {
							if(isset($value["name"])){
								$html .= "\t\t".$this->formatValue($value["name"]).":".$this->formatValue($value["value"]).",\n";
							}else{
								$html .= "\t\t".$this->formatValue($value["value"]).",\n";
							}
						}
						$html = substr($html,0,strlen($html) - 2)."\n";
						$html .= "\t]";
					}else{
						$html .= "<span class=\"text-success\">\"".(isset($value["example"]) ? $value["example"] : "<i>N/A</i>")."\"</span>";
					}
				}else{
					$html .="<span class=\"text-success\">\"<i>N/A</i>\"</span>";
				}
				$html .= ",\n";
			}
			$html = substr($html,0,strlen($html) - 2)."\n";
			$html .= "}";
			return $html;
		}else{
			return "N/A";
		}
	}

	public function generateFailureExample($function_name){
		$func = $this->getFunction($function_name);
		if(isset($func["failure"]["results"])){
			$html = "{\n";
			foreach ($func["failure"]["results"] as $key => $value) {
				
				$html .= "\t<span class=\"text-success\">\"$value[name]\"</span>: ";
				if(isset($value["example"])){
					if(is_bool($value["example"])){
						$html .= "<span class=\"text-warning\">".(isset($value["example"]) ? ($value["example"] == 1 ? "true" : "false") : "false")."</span>";
					}elseif(is_int($value["example"]) || is_float($value["example"]) || is_double($value["example"])){
						$html .= "<span class=\"text-info\">".(isset($value["example"]) ? $value["example"] : "0")."</span>";
					}elseif(is_array($value["example"])){
						$html .= "[\n";
						foreach ($value["example"] as $key => $value) {
							if(isset($value["name"])){
								$html .= "\t\t".$this->formatValue($value["name"]).":".$this->formatValue($value["value"]).",\n";
							}else{
								$html .= "\t\t".$this->formatValue($value["value"]).",\n";
							}
						}
						$html = substr($html,0,strlen($html) - 2)."\n";
						$html .= "\t]";
					}else{
						$html .= "<span class=\"text-success\">\"".(isset($value["example"]) ? $value["example"] : "<i>N/A</i>")."\"</span>";
					}
				}else{
					$html .="<span class=\"text-success\">\"<i>N/A</i>\"</span>";
				}
				$html .= ",\n";
			}
			$html = substr($html,0,strlen($html) - 2)."\n";
			$html .= "}";
			return $html;
		}else{
			return "N/A";
		}
	}

	public function parseCode($code){
		$code = preg_replace("/\"([^\"]+)\"/i", "<span class=\"uri text-success\">\"$1\"</span>",$code);
		$code = preg_replace("/```([^`]+)```/i", "<span class=\"label label-info\">$1</span>",$code);
		$code = preg_replace("/``([^`]+)``/i", "<span class=\"label label-warning\">$1</span>",$code);
		$code = preg_replace("/`([^`]+)`/i", "<span class=\"label label-primary\">$1</span>",$code);


		return $code;
	}
}
?>