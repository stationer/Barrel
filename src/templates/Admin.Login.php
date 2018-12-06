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
<?php include 'Admin.LoginSearch.php'; ?>

    <section>
        <div class="c-card">
            <div class="header">
                <h5>Select a Login</h5>
            </div>
            <div class="content">
                <ul>
                    <?php foreach ($list as $login_id => $Login) {
                        /** @var \Stationer\Graphite\models\Login $Login */?>
                        <li><a href="/Admin/LoginEdit/<?php echo $login_id; ?>">
                                <?php html($Login->loginname ?: '_'); ?></a></li>
                    <?php } ?>
                </ul>
            </div>
        </div>
    </section>

<?php echo $View->render('footer');
