<?php
/** @var \Stationer\Graphite\View $View */

echo $View->render('header'); ?>

    <section>
    <div class="c-card">
    <div class="header">
        <h2>Table Analysis</h2>
    </div>
    <div class="content">

<?php
foreach ($files as $file => $class) {
    if (!isset($tables[$class]) || !is_array($tables[$class])) {
        ?>
        <details class="admin-tables-error">
            <summary><?php html($file); ?></summary>
            <?php html($class); ?>
        </details>
        <?php
    } elseif (empty($tables[$class])) {
        ?>
        <details class="admin-tables-empty">
            <summary><?php html($file); ?></summary>
            No differences
        </details>
        <?php
    } else {
        ?>
        <details class="admin-tables-alter">
            <summary><?php html($file); ?></summary>
            <table>
                <thead>
                <tr>
                    <th>Field</th>
                    <th>Analysis</th>
                    <th>Expected DDL</th>
                    <th>Actual DDL</th>
                    <th>ALTER Statement</th>
                </tr>
                </thead>
                <?php
                foreach ($tables[$class] as $field => $diff) {
                    ?>
                    <tr>
                        <td>`<?php html($field); ?>`</td>
                        <td><?php
                            if (false === $diff['back_ddl']) {
                                echo 'Missing!';
                            } elseif (false === $diff['front_ddl']) {
                                echo 'Unused!';
                            } else {
                                echo 'Different!';
                            }
                            ?></td>
                        <td><?php html($diff['front_ddl']); ?></td>
                        <td><?php html($diff['back_ddl']); ?></td>
                        <td><?php html('ALTER TABLE `'.$class::getTable().'` '.$diff['alter'].';'); ?></td>
                    </tr>
                    <?php
                }
                ?>
            </table>
        </details>
        </div>
        </div>
        </section>
        <?php
    }
}
\croak($tables);
?>

<?php echo $View->render('footer');
