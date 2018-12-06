<?php
/** @var \Stationer\Graphite\View $View */

echo $View->render('header'); ?>
    <nav>
        <ul class="breadcrumbs">
            <li><a href="/Admin">Admin</a></li>
            <li><a href="/Admin/Login">Logins</a></li>
        </ul>
    </nav>

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
                        <th>login_id</th>
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
                                <td><?php echo '<a href="'.'/Admin/LoginEdit/'.$v->login_id.'">'.$v->login_id.'</a>'; ?></td>
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
