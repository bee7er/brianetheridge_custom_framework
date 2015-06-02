<?php
function smarty_function_article($params, &$smarty)
{
	if (isset($params['ref']))
	{
		$article = new Articles();
		$smarty->assign("article", $article->getArticle($params['ref']));
	}
}
?>