<?php
/** @var \Stationer\Graphite\View $View */
/** @var string $msg */
$msg = $msg ?? '';
/** @var string $l last attempted loginname */
$l = $l ?? '';
/** @var string $_URI */
$_URI = $_URI ?? '';
/** @var string $_Lbl */
$_Lbl = $_Lbl ?? '';
/** @var string $_loginname */
$_loginname = $_loginname ?? '';
/** @var string $_logoutURL */
$_logoutURL = $_logoutURL ?? '';

echo $View->render('header'); ?>

<?php if ($_login_id) { ?>
    <section class="Account Account_left">
        <div class="c-card">
            <div class="header">
                <h2>You Are Already Checked In</h2>
            </div>
            <div class="content">
                <p>You are already recognized as <b><?php html($_loginname); ?></b>.</p>
                <p>If you want to switch users, you can use the form to the right.</p>
            </div>
        </div>
    </section>
<?php } ?>
    <section class="Account">
        <div class="c-card l-login">
            <div class="header">
                <h2>Log in to your account</h2>
            </div>
            <div class="content">
                <p><?= $msg ?></p>
                <form class="m-login" action="<?php echo $_loginURL; ?>" method="post">
                    <div class="form-group">
                        <label for="loginU2">Username</label>
                        <input id="loginU2" class="form-control" type="text" name="l"
                               value="<?php html($l); ?>" placeholder="Username">
                    </div>
                    <div class="form-group">
                        <label for="loginP2">Password</label>
                        <input id="loginP2" class="form-control" type="password" name="p" placeholder="Password">
                    </div>
                    <div class="buttons">
                        <input id="loginS2" class="c-btn" type="submit" value="Log in">
                        <input type="hidden" name="_URI" value="<?php html($_URI); ?>">
                        <input type="hidden" name="_Lbl" value="<?php html($_Lbl); ?>">
                    </div>
                </form>
                <p><a href="/Account/recover">Forgot Password?</a></p>
            </div>
        </div>
    </section>
<?php echo $View->render('footer');
