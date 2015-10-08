<?php
    defined('BASEPATH') OR exit('No direct script access allowed');
?>
<div>
    <?php echo validation_errors(); ?>
    <?php if (isset($error)) : ?>
        <div>
            <?= $error ?>
        </div>
    <?php endif; ?>
    <?= form_open('user/login') ?>
        <div>
            <label for="username">Username</label>
            <input type="text" id="username" name="username" value = "<?php set_value('username'); ?>" placeholder="Enter a username">
        </div>
        <div>
            <label for="pass">Password</label>
            <input type="password" id="pass" name="pass" value = "<?php set_value('pass'); ?>" placeholder="Enter your password">
        </div>
        <div>
            <input type="submit" value="Login">
        </div>
    </form>
</div>
