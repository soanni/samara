<div id="main">
    <div>
        <article>
            <h1><?php echo $item['title']; ?></h1>
            <?php
                echo My_Utility::convertToParas($item['article']); ?>
        </article>
    </div>
</div>

