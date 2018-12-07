<?php
/** @var \Stationer\Graphite\View $View */
/** @var array $list List of logins */
$list = !empty($list) && is_array($list) ? $list : [];

echo $View->render('header'); ?>
    <nav>
        <ul class="breadcrumbs">
            <li><a href="/Admin">Admin</a></li>
        </ul>
    </nav>

    <section>
        <div class="c-card">
            <div class="header">
                <div><h2>Roles</h2></div>
                <div class="buttons">
                    <a href="/Admin/RoleAdd" class="c-btn">Add Role</a>
                </div>
            </div>
            <div class="content">
                <table class="list">
                    <thead>
                    <tr>
                        <th>Id</th>
                        <th>Role</th>
                        <th>Creator</th>
                        <th>Description</th>
                        <th>Status</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($list as $role_id => $Role) {
                        /** @var \Stationer\Graphite\models\Role $Role */ ?>
                        <tr class="<?php echo $Role->disabled ? 'subtle' : ''; ?>">
                            <td><?php echo $Role->role_id; ?></td>
                            <td><a href="/Admin/RoleEdit/<?php echo $role_id; ?>"><?php html($Role->label); ?></a></td>
                            <td><?php echo $Role->creator_id; ?></td>
                            <td><?php echo $Role->description; ?></td>
                            <td><?php echo $Role->disabled ? 'Disabled' : 'Enabled'; ?></td>
                        </tr>
                    <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </section>

<?php echo $View->render('footer');
