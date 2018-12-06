<?php
/** @var \Stationer\Graphite\View $View */

echo $View->render('header'); ?>
    <section>
        <div class="c-card">
            <div class="header">
                <h2>Internal Server Error</h2>
            </div>
            <div class="content">
                <span>Something went wrong.</span>
            </div>
        </div>
    </section>
<?php echo $View->render('footer');
