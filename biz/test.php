<?php

require_once("AutoLoader.php");
// require_once("GridDisplay.php");

$dbHandler = new DBHandle();
$contentData = new ContentData();
$contentData->section = "Paintings";
$contentData->category = "2010";
$contentItem = new ContentItem($contentData, null);
$queryMaker = new QueryMaker($dbHandler, $contentItem);
$rows = $queryMaker->getContentItemsData();
// print count($rows);
// echo "<br>";
// print_r($rows);

$formatter = new ContentProvider($queryMaker);
$grid = new GridDisplay($formatter);

$html = $grid->getHTML();
echo ($html);

?>