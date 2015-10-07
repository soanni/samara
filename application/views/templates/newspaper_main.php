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
                        <a href = "<?php echo $item['article_id'];?>">More</a>
                <?php endif;?>
            </article>
        <?php endforeach;?>
    </div>
    <div id="secondary">
    </div>
    <div in="ternary">
    </div>
</div>