<?php
/**
 * Created by PhpStorm.
 * User: stocchetjo
 * Date: 10.03.2017
 * Time: 13:45
 */
header('Content-Type: text/html; charset=utf-8');
if(session_status() == 1) {
    session_start();
}
?>

<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="description" content="">
<meta name="author" content="">

<title>Cette CIF est mortelle… ou pas</title>

<!-- Bootstrap Core CSS -->
<link href="../../../resources/css/bootstrap.min.css" rel="stylesheet">

<link rel="icon" type="image/png" href="../../../resources/images/icon.png" />

<!-- Custom CSS -->
<link href="../../../resources/css/business-casual.css" rel="stylesheet">


<!-- Fonts -->
<link href="https://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800" rel="stylesheet" type="text/css">
<link href="https://fonts.googleapis.com/css?family=Josefin+Slab:100,300,400,600,700,100italic,300italic,400italic,600italic,700italic" rel="stylesheet" type="text/css">

<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
<!--[if lt IE 9]>
<script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
<script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
<![endif]-->
