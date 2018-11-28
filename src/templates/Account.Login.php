<?php echo $View->render('header'); ?>
<?php if ($_login_id) { ?>
        <section class="Account Account_left">
            <div class="c-card">
                <div class="content">
                    <h2>You Are Already Checked In</h2>
                    <p>You are already recognized as <b><?php html($_loginname); ?></b>.</p>
                    <p>If you want to switch users, you can use the form to the right.</p>
                </div>
            </div>
        </section>
<?php } ?>
        <section class="Account">
            <div class="c-card">
                <div class="content">
                    <h2>Log in to your account</h2>
                    <p><?php echo isset($msg) ? $msg : ''; ?></p>
                    <div id="bodyLogin">
                        <form action="<?php echo $_loginURL; ?>" method="post">
                            <div>
                                <label for="loginU2">Username</label>
                                <input id="loginU2" type="text" name="l" value="<?php html(isset($l) ? $l : ''); ?>" placeholder="Username">
                            </div>
                            <div>
                                <label for="loginP2">Password</label>
                                <input id="loginP2" type="password" name="p" placeholder="Password">
                            </div>
                            <div>
                                <input id="loginS2" type="submit" value="Log in">
                                <input type="hidden" name="_URI" value="<?php html($_URI); ?>">
                                <input type="hidden" name="_Lbl" value="<?php html($_Lbl); ?>">
                            </div>
                        </form>
                    </div>
                    <p><a href="/Account/recover">Forgot Password?</a></p>
                </div>
            </div>
        </section>
<?php echo $View->render('footer');
