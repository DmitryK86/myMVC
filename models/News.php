<?php

/**
* 
*/
class News
{
	
	public static function getNewsById($params)
	{

		$id = $params[0];

		$db = Db::getConnection();

		$res = $db->query('SELECT id, title, date, content, author, preview FROM news WHERE id='.$id);

		$newsItem = $res->fetch(PDO::FETCH_ASSOC);
		return $newsItem;
		
	}

	public static function getAllNews()
	{
		$db = Db::getConnection();

		$newsList = array();

		$res = $db->query('SELECT id, title, date, short_content, author, preview FROM news ORDER BY date DESC LIMIT 10');

		$i = 0;
		while ($row = $res->fetch(PDO::FETCH_ASSOC)) {
			$newsList[$i]['id'] = $row['id'];
			$newsList[$i]['title'] = $row['title'];
			$newsList[$i]['date'] = $row['date'];
			$newsList[$i]['short_content'] = $row['short_content'];
			$newsList[$i]['author'] = $row['author'];
			$newsList[$i]['preview'] = $row['preview'];
			$i++;
		}
		return $newsList;
	}
}