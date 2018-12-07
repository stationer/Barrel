<?php
/** @var \Stationer\Graphite\View $View */

echo $View->render('header'); ?>
    <section>
        <div class="c-card">
            <div class="header">
                <h2>Default Page</h2>
            </div>
            <div class="content">
                <span>Something went OK.</span>
            </div>
        </div>
    </section>
<?php echo $View->render('footer');
