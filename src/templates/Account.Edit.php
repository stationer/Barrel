<?php
/** @var \Stationer\Graphite\View $View */
/** @var string $path */
/** @var string $email */
/** @var string $comment */

use Stationer\Graphite\Security;

echo $View->render('header'); ?>
    <section class="Account">
        <div class="c-card">
            <div class="header">
                <h2>Account Settings</h2>
            </div>
            <div class="content" id="bodyLogin">
                <form action="/Account/edit" method="post">
                    <input type="hidden" name="path" value="<?php echo $path; ?>">
                    <div class="form-group">
                        <label for="acctMail">Private eMail</label>
                        <input id="acctMail" type="email" name="email" value="<?php echo $email; ?>">
                    </div>
                    <div class="form-group">
                        <label for="acctComm">Comment</label>
                        <input id="acctComm" type="text" name="comment" value="<?php echo $comment; ?>">
                    </div>
                    <div class="form-group">
                        <label for="acctP1">Reset Password</label>
                        <input id="acctP1" type="password" name="password1">
                        <p id="password_policy"><?php html(Security::validate_password('')); ?></p>
                    </div>
                    <div class="form-group">
                        <label for="acctP2">Confirm Password</label>
                        <input id="acctP2" type="password" name="password2">
                    </div>
                    <div class="form-group">
                        <input id="acctS" type="submit" class="c-btn" value="Update">
                    </div>
                </form>
            </div>
        </div>
    </section>
<?php echo $View->render('footer');
