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
    <?= form_open('user/register') ?>
        <div>
            <label for="username">Username</label>
            <input type="text" id="username" name="username" value = "<?php set_value('username'); ?>" placeholder="Enter a username">
        </div>
        <div>
            <label for="email">Email</label>
            <input type="email" id="email" name="email" value = "<?php set_value('email'); ?>" placeholder="Enter your email">
            <p>A valid email address</p>
        </div>
        <div>
            <input type="submit" value="Register">
        </div>
    </form>
</div>
