<?php
/** @var \Stationer\Graphite\View $View */
/** @var \Stationer\Graphite\models\Role $R */

echo $View->render('header'); ?>
    <nav>
        <ul class="breadcrumbs">
            <li><a href="/Admin">Admin</a></li>
            <li><a href="/Admin/Role">Roles</a></li>
        </ul>
    </nav>

    <form class="m-flex" action="/Admin/RoleAdd" method="post">
        <section>
            <div class="c-card">
                <div class="header">
                    <h2>Add a New Role</h2>
                </div>
                <div class="content">
                    <div class="form-group">
                        <label for="label">Label</label>
                        <input class="form-control" type="text" name="label" id="label"
                               value="<?php html($R->label); ?>">
                    </div>
                    <div class="form-group">
                        <label for="description">Description</label>
                        <textarea class="form-control" rows="4" cols="40" name="description"
                                  id="description"><?php html($R->description); ?></textarea>
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
                        <input type="submit" class="c-btn" value="Submit">
                    </div>
                </div>
            </div>
        </section>
    </form>
<?php echo $View->render('footer');
