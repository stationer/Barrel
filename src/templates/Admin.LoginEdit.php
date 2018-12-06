<?php
/** @var \Stationer\Graphite\View $View */
/** @var \Stationer\Graphite\models\Login $L */
/** @var \Stationer\Graphite\models\LoginLog[] $log */
/** @var \Stationer\Graphite\models\Role $Roles[] */
/** @var string $referrer */

echo $View->render('header'); ?>
    <nav>
        <ul class="breadcrumbs">
            <li><a href="/Admin">Admin</a></li>
            <li><a href="/Admin/Login">Logins</a></li>
        </ul>
    </nav>
<?php include 'Admin.LoginSearch.php'; ?>

    <form class="m-flex" action="<?php echo '/Admin/LoginEdit/'.$L->login_id; ?>" method="post" id="Admin_LoginEdit">
        <section class="l-two-thirds">
            <div class="c-card">
                <div class="header">
                    <h2>Edit Account Settings</h2>
                </div>
                <div class="content">
                    <div class="form-group">
                        <label for="loginname">LoginName</label>
                        <input class="form-control" type="text" name="loginname" id="loginname"
                               value="<?php html($L->loginname); ?>">
                    </div>
                    <div class="form-group">
                        <label for="realname">Real Name</label>
                        <input class="form-control" type="text" name="realname" id="realname"
                               value="<?php html($L->realname); ?>">
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
                        <input class="form-control" type="email" name="email1" id="email1"
                               value="<?php html($L->email); ?>">
                    </div>
                    <div class="form-group">
                        <label for="email2">Confirm E-Mail Address</label>
                        <input class="form-control" type="email" name="email2" id="email2"
                               value="<?php html($L->email); ?>">
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
                        <label for="">Referring Login</label>
                        <p><a href="/Admin/LoginEdit/<?php echo $L->referrer_id; ?>"><?php html($referrer); ?></a></p>
                    </div>
                    <div class="form-group">
                        <label for="">Created</label>
                        <p><?php echo $L->dateCreated ? '<time datetime="'.date('c',
                                    $L->dateCreated).'">'.date('r',
                                    $L->dateCreated).'</time>' : 'Never'; ?></p>
                    </div>
                    <div class="form-group">
                        <label for="">Modified</label>
                        <p><?php echo $L->dateModified ? date('r', $L->dateModified) : 'Never'; ?></p>
                    </div>
                    <div class="form-group">
                        <label for="">Checked In</label>
                        <p><?php echo $L->dateLogin ? date('r', $L->dateLogin) : 'Never'; ?></p>
                    </div>
                    <div class="form-group">
                        <label for="">Checked Out</label>
                        <p><?php echo $L->dateLogout ? date('r', $L->dateLogout) : 'Never'; ?></p>
                    </div>
                    <div class="form-group">
                        <label for="">Active</label>
                        <p><?php echo $L->dateActive ? date('r', $L->dateActive) : 'Never'; ?></p>
                    </div>
                    <div class="form-group">
                        <label for="">Last IP</label>
                        <p><?php echo $L->lastIP; ?></p>
                    </div>
                    <div class="form-group">
                        <input type="submit" class="c-btn" value="Submit">
                        <input type="hidden" name="login_id" id="login_id" value="<?php echo $L->login_id; ?>">
                    </div>
                </div>
            </div>
        </section>
        <section class="l-one-third">
            <div class="c-card">
                <div class="header">
                    <h2>Grant Roles</h2>
                </div>
                <div class="content">
                    <table class="list">
                        <thead>
                        <tr>
                            <th>Grant<input type="hidden" name="grant[]" value="0"></th>
                            <th>Role</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        if (is_array($Roles)) {
                            foreach ($Roles as $k => $v) {
                                ?>
                                <tr>
                                    <td><input type="checkbox" name="grant[<?php echo $k; ?>]" id="g<?php echo $k; ?>"
                                               value="1"<?php if ($L->roleTest($v->label)) {
                                            echo ' checked';
                                        } ?>></td>
                                    <td><label for="g<?php echo $k; ?>"><?php echo $v->label; ?></label></td>
                                </tr>
                                <?php
                            }
                        }
                        ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </section>

    </form>
    <section>
        <div class="c-card">
            <div class="header">
                <h2>Login Log</h2>
            </div>
            <div class="content">
                <table class="list">
                    <thead>
                    <tr>
                        <th>pkey</th>
                        <th>date</th>
                        <th>IP</th>
                        <th>user agent</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    if (is_array($log) && count($log)) {
                        foreach ($log as $k => $v) {
                            ?>
                            <tr>
                                <td><?php html($v->pkey); ?></td>
                                <td><?php echo date("r", $v->iDate); ?></td>
                                <td><?php html($v->ip); ?></td>
                                <td><?php html($v->ua); ?></td>
                            </tr>
                            <?php
                        }
                    } else {
                        ?>
                        <tr>
                            <td colspan="4">No records found.</td>
                        </tr>
                        <?php
                    }
                    ?>
                    </tbody>
                </table>
            </div>
        </div>
    </section>
<?php echo $View->render('footer');
