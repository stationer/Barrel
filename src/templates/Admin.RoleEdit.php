<?php
/** @var \Stationer\Graphite\View $View */
/** @var \Stationer\Graphite\models\Role $R */
/** @var \Stationer\Graphite\models\Login[] $Logins */
/** @var string $creator */
/** @var array $members */

echo $View->render('header'); ?>
    <nav>
        <ul class="breadcrumbs">
            <li><a href="/Admin">Admin</a></li>
            <li><a href="/Admin/Role">Roles</a></li>
        </ul>
    </nav>

    <form class="m-flex" action="<?php echo '/Admin/RoleEdit/'.$R->role_id; ?>" method="post">
        <section class="l-two-thirds">
            <div class="c-card">
                <div class="header">
                    <h2>Edit Role</h2>
                </div>
                <div class="content">
                    <div class="form-group">
                        <label for="label">Label</label>
                        <input class="form-control" type="text" name="label" id="label"
                               value="<?php html($R->label); ?>">
                    </div>
                    <div class="form-group">
                        <label for="description">Description</label>
                        <textarea class="form-control" rows="4" cols="40"
                                  name="description" id="description"><?php html($R->description); ?></textarea>
                    </div>
                    <div class="form-group">
                        <label for="disabled">Disabled?</label>
                        <select class="form-control" name="disabled" id="disabled">
                            <option value="0">No, Role is Enabled</option>
                            <option value="1"<?php if (1 == $R->disabled) {
                                echo ' selected';
                            } ?>>Yes, Role is Disabled
                            </option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="">Creator Login</label>
                        <p><a href="/Admin/LoginEdit/<?php echo $R->creator_id; ?>"><?php html($creator); ?></a></p>
                    </div>
                    <div class="form-group">
                        <label for="">Created</label>
                        <p><?php echo $R->dateCreated ? date('r', $R->dateCreated) : 'Never'; ?></p>
                    </div>
                    <div class="form-group">
                        <label for="">Modified</label>
                        <p><?php echo $R->dateModified ? date('r', $R->dateModified) : 'Never'; ?></p>
                    </div>
                    <div class="form-group">
                        <input type="submit" class="c-btn" value="Submit">
                        <input type="hidden" name="role_id" id="role_id" value="<?php echo $R->role_id; ?>">
                    </div>
                </div>
            </div>
        </section>

        <section class="l-one-third">
            <div class="c-card">
                <div class="header">
                    <h2>Grant Role</h2>
                </div>
                <div class="content">
                    <table class="list">
                        <thead>
                        <tr>
                            <th>Grant<input type="hidden" name="grant[]" value="0"></th>
                            <th>To</th>
                            <th>By</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        if (is_array($Logins)) {
                            foreach ($Logins as $k => $v) {
                                ?>
                                <tr>
                                    <td><input type="checkbox" name="grant[<?php echo $k; ?>]" id="g<?php echo $k; ?>"
                                               value="1"<?php if (isset($members[$k])) {
                                            echo ' checked';
                                        } ?>></td>
                                    <td><label for="g<?php echo $k; ?>"><?php echo $v->loginname; ?></label></td>
                                    <td class="subtle"><?php
                                        if (isset($members[$k]) && isset($Logins[$members[$k]])) {
                                            echo $Logins[$members[$k]]->loginname;
                                        } ?></td>
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
<?php include 'revisions.php'; ?>

<?php echo $View->render('footer');
