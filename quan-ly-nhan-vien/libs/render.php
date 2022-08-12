<?php
function renderContent($template, $params)
{
	$content = $template;
	foreach ($params as $key=>$value)
	{
		$token = "{" . strtoupper($key) . "}";
		$content = str_replace($token, htmlentities($value, ENT_QUOTES, "UTF-8"), $content);
	}

	return $content;
}

?>