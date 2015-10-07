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
    <?= form_open("user/confirm/$id") ?>
        <div>
            <label for="password">Password</label>
            <input type="password"id="password" name="password" placeholder="Enter a password">
            <p>At least 6 characters</p>
        </div>
        <div>
            <label for="password_confirm">Confirm password</label>
            <input type="password" id="password_confirm" name="password_confirm" placeholder="Confirm your password">
            <p>Must match your password</p>
        </div>
        <div>
            <input type="submit" value="Confirm">
        </div>
    </form>
</div>
