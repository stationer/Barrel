<?php
/** @var \Stationer\Graphite\View $View */
/** @var string $msg */
$msg = $msg ?? '';

echo $View->render('header'); ?>
    <section class="Account">
        <div class="c-card">
            <div class="header">
                <h2>Password Recovery</h2>
            </div>
            <div class="content">
                <p><?php echo $msg; ?></p>
                <p>Enter your username, or the email associated with
                    your username, and a new password will be sent to you.</p>
                <div id="bodyLogin">
                    <form action="/Account/recover" method="post">
                        <div class="form-group">
                            <label for="loginname">Username or Email</label>
                            <input id="loginname" type="text" name="loginname">
                        </div>
                        <div class="form-group">
                            <input type="hidden" name="action" value="Get Password">
                            <input type="submit" class="c-btn" value="Get Password">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
<?php echo $View->render('footer');
