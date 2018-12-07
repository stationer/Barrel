<?php
/** @var \Stationer\Graphite\View $View */

echo $View->render('header'); ?>
    <section>
        <div class="c-card">
            <div class="header">
                <h2>Requested Page Not Found</h2>
                <h2>Access Denied</h2>
            </div>
            <div class="content">
                <span>The path you requested could not be located.  Please select an option from the menu above.</span>
            </div>
        </div>
    </section>
<?php echo $View->render('footer');
