<?php
/** @var \Stationer\Graphite\View $View */
/** @var \Stationer\Graphite\models\Login $L */

echo $View->render('header'); ?>
    <nav>
        <ul class="breadcrumbs">
            <li><a href="/Admin">Admin</a></li>
            <li><a href="/Admin/Login">Logins</a></li>
        </ul>
    </nav>
<?php include 'Admin.LoginSearch.php'; ?>

    <form class="m-flex" action="/Admin/LoginAdd" method="post">
        <section class="l-two-thirds">
            <div class="c-card">
                <div class="header">
                    <h2>Add a New Account</h2>
                </div>
                <div class="content">
                    <div class="form-group">
                        <label for="loginname">LoginName</label>
                        <input class="form-control" type="text" name="loginname" id="loginname" value="<?php html($L->loginname); ?>">
                    </div>
                    <div class="form-group">
                        <label for="realname">Real Name</label>
                        <input class="form-control" type="text" name="realname" id="realname" value="<?php html($L->realname); ?>">
                    </div>
                    <div class="form-group">
                        <label for="pass1">Password</label>
                        <input class="form-control" type="password" name="pass1" id="pass1">
                    </div>
                    <div class="form-group">
                        <label for="pass2">Confirm Password</label>
                        <input class="form-control" type="password" name="pass2" id="pass2">
                    </div>
                    <div class="form-group">
                        <label for="email1">E-Mail Address</label>
                        <input class="form-control js-validate-email-stricter" type="text" name="email1" id="email1"
                               value="<?php html($L->email); ?>">
                        <label class="msg" for="email1" id="email1Msg"></label>
                    </div>
                    <div class="form-group">
                        <label for="email2">Confirm E-Mail Address</label>
                        <input class="form-control js-validate-email-stricter" type="text" name="email2" id="email2"
                               value="<?php html($L->email); ?>">
                        <label class="msg" for="email2" id="email2Msg"></label>
                    </div>
                    <div class="form-group">
                        <label for="sessionStrength">Session Strength</label>
                        <select class="form-control" name="sessionStrength" id="sessionStrength">
                            <option value="2">Secure session to Browser and IP</option>
                            <option value="1"<?php if (1 == $L->sessionStrength) {
                                echo ' selected';
                            } ?>>Secure session to Browser only
                            </option>
                            <option value="0"<?php if (0 == $L->sessionStrength) {
                                echo ' selected';
                            } ?>>Allow multiple concurrent sessions
                            </option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="flagChangePass">Must Change Password?</label>
                        <select class="form-control" name="flagChangePass" id="flagChangePass">
                            <option value="0">No</option>
                            <option value="1"<?php if (1 == $L->flagChangePass) {
                                echo ' selected';
                            } ?>>Yes
                            </option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="disabled">Disabled?</label>
                        <select class="form-control" name="disabled" id="disabled">
                            <option value="0">No, User is Enabled</option>
                            <option value="1"<?php if (1 == $L->disabled) {
                                echo ' selected';
                            } ?>>Yes, User is Disabled
                            </option>
                        </select>
                    </div>
                    <div class="form-group">
                        <input type="submit" class="c-btn" value="Submit">
                    </div>
                </div>
            </div>
        </section>
    </form>
<?php echo $View->render('footer');
