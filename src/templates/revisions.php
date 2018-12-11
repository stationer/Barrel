<?php

use \Stationer\Graphite\G;
use \Stationer\Graphite\models\Revision;
use const \Stationer\Graphite\DATETIME_HUMAN;

if (G::$S->roleTest('Admin') && isset($Revisions) && is_array($Revisions) && 0 < count($Revisions)) { ?>
    <section>
        <div class="c-card">
            <details>
                <summary class="header">
                    <h2>Revision Log</h2>
                </summary>
                <div class="content">
                    <table>
                        <thead>
                        <tr>
                            <th>Date</th>
                            <th>Login</th>
                            <th>Details</th>
                        </tr>
                        </thead>
                        <?php foreach ($Revisions as $Revision) {
                            /** @var Revision $Revision */
                            ?>
                            <tr>
                                <td><?php echo date(DATETIME_HUMAN, $Revision->created_uts); ?></td>
                                <td><a href="/Admin/loginEdit/<?=$Revision->editor_id?>"><?php echo $Revision->loginname; ?></a></td>
                                <td style="white-space:pre-wrap;"><?php echo htmlspecialchars(print_r($Revision->changes,
                                        true)); ?></td>
                            </tr>
                        <?php } ?>
                    </table>
                </div>
            </details>
        </div>
    </section>
<?php } ?>
