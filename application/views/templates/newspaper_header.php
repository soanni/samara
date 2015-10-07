<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?php echo $title; ?></title>
    <meta name="description" content="Samara News">
    <meta name="author" content="Andrey Solodov">
    <link rel="stylesheet" href="<?php echo base_url('assets/css/styles.css');?>">
    <!--[if lt IE9]>
        <script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->
</head>
<body>
<header>
    <hgroup>
        <h1>Samara news</h1>
        <h2>Test trial for Crossover PHP vacancy. Built using Codeigniter</h2>
    </hgroup>
    <nav>
        <ul>
            <li><a href="<?php echo site_url();?>#top">Home</a></li>
            <li><a href="<?php echo site_url('user/register');?>">Sign Up</a></li>
            <li><a href="<?php echo site_url('user/login');?>">Log In</a></li>
        </ul>
    </nav>
</header>