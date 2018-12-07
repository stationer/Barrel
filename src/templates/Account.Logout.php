<?php
/** @var \Stationer\Graphite\View $View */
/** @var string $_URI */
$_URI = $_URI ?? '';
/** @var string $_Lbl */
$_Lbl = $_Lbl ?? '';

echo $View->render('header'); ?>
    <section class="Account">
        <div class="c-card">
            <div class="header">
                <h2>Checked Out</h2>
            </div>
            <div class="content">
                <p>It looks like you checked out successfully!
                    <br>How about we redirect you <a href="<?php html($_URI); ?>"><?php html($_Lbl); ?></a>?
                    <script type="text/javascript"><!--
                        window.setTimeout("location.replace('<?php html($_URI);?>')", 1);// --></script>
                </p>
            </div>
        </div>
    </section>
<?php echo $View->render('footer');
