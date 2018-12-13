<?php 
	$v = '0.0.1';
	$document = Document::getInstance();
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
	<title><?=$document->getTitle();?></title>
	
	<!-- Bootstrap -->
    <link href="/css/bootstrap.min.css?<?=$v;?>" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="/css/styles.css?<?=$v;?>">

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<!--
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
-->
<!--
	<script src="/js/jquery-1.11.2.min.js"></script>
-->
	<script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
	<script src="https://api.trello.com/1/client.js?key=1811d64047505714232f8c94679a96ae&token=62d37398f8d7b2ddcdc625a4cde3cf4fa7b4958cd12a29ca83587d0e5e1366ae"></script>
    <script src="/js/func.js?<?=$v;?>"></script>
<!--
    <script src="/js/trello.js?<?=$v;?>"></script>
-->
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="/js/bootstrap.min.js"></script>
    <script src="/js/Chart.min.js"></script>
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body>
