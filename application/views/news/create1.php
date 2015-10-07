
<!--<form id="create" action="" method="post" enctype="multipart/form-data">-->
<?php echo validation_errors(); ?>
<?php if (isset($error)) : ?>
    <div>
        <?= $error ?>
    </div>
<?php endif; ?>
<?php echo form_open(); ?>
    <div>
        <label for="title">Title:</label>
        <input name="title" type="text" id="title"/>
    </div>
    <div>
        <label for="article">Article:</label>
        <textarea name="article" id="article" cols="60" rows="8"></textarea>
    </div>
    <div>
        <input type="submit" value="Create">
    </div>
</form>