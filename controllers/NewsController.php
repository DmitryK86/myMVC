<?php

include_once ROOT.'/models/News.php';

/**
* 
*/
class NewsController
{
	
	public function actionIndex()
	{
		$newsList = News::getAllNews();

		require_once(ROOT.'/views/news/index.php');

		return true;
	}

	public function actionView($params)
	{
		$newsItem = News::getNewsById($params);


		require_once(ROOT.'/views/news/item.php');


		return true;
	}
}