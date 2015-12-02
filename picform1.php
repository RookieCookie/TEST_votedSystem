<?php
require_once 'src/jpgraph.php';
require_once 'src/jpgraph_bar.php';
$data = array(80,57,65,90,78);
$datas = array("1","2","3","4","5");
$graph = new Graph(600,300);
$graph ->SetScale('textlin');
$graph ->img ->SetMargin(40,30,20,40);
$barplot = new BarPlot($data);
$barplot ->SetFillColor('blue');
$barplot ->value ->Show();
$graph ->Add($barplot);
$graph ->title ->Set(iconv("utf-8","gb2312","asd"));
$graph ->xaxis ->title ->Set(iconv("utf-8","gb2312","A"));
$graph ->xaxis ->SetTickLabels($datas);
$graph ->yaxis ->title ->Set(iconv("utf-8","gb2312","B"));
$graph ->title ->SetFont(FF_SIMSUN,FS_BOLD);
$graph ->xaxis ->title ->SetFont(FF_SIMSUN,FS_BOLD);
$graph ->yaxis ->title ->SetFont(FF_SIMSUN,FS_BOLD);
$graph ->Stroke();
?>