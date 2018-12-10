<?php
/** @var \Stationer\Graphite\View $View */

echo $View->render('header'); ?>
    <section>
        <div class="c-card">
            <div class="header">
                <h2>Access Denied</h2>
            </div>
            <div class="content">
                <span>The path you requested could be found, but access is restricted.  Try Checking in to gain access.</span>
            </div>
        </div>
    </section>

<?php
include 'Account._loginForm.php';

echo $View->render('footer');
