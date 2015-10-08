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
                <li><a href="<?php echo site_url('user/register');?>">My Profile</a></li>
                <li><a href="<?php echo site_url('news/create');?>">Create new article</a></li>
                <li><a href="<?php echo site_url('user/logout');?>">Log Out</a></li>
            </ul>
        </nav>
    </header>
    <div id="main">
        <div id="primary">
            <?php foreach ($result as $item):?>
                <article>
                    <h1><?php echo $item['title']; ?></h1>
                    <h3><strong>Created at: </strong><?php echo $item['created'];?></h3>
                    <p></p>
                    <?php
                    $extract = My_Utility::getFirst($item['article']);
                    echo My_Utility::convertToParas($extract[0]);
                    if($extract[1]):?>
                        <a href = "<?php echo site_url('news/view/' . $item['article_id']);?>">More</a>
                    <?php endif;?>
                </article>
            <?php endforeach;?>
        </div>
        <div id="secondary">
        </div>
        <div in="ternary">
        </div>
    </div>
    <footer>
        <section id="footerinfo">
            <small>&copy; Samara News</small>
        </section>
    </footer>
    <script src="<?php echo base_url('assets/js/scripts.js');?>"></script>
    </body>
</html>