<?php
/** @var \Stationer\Graphite\View $View */
/** @var string $_URI */
$_URI = $_URI ?? '';
/** @var string $_Lbl */
$_Lbl = $_Lbl ?? '';
/** @var string $_loginname */
$_loginname = $_loginname ?? '';
/** @var string $_logoutURL */
$_logoutURL = $_logoutURL ?? '';
/** @var string $_location */
$_location = str_replace("'", "\\'", $_URI);

echo $View->render('header'); ?>
    <section class="Account">
        <div class="c-card">
            <div class="header">
                <h2>Checked In</h2>
            </div>
            <div class="content">
                <p>It looks like you checked in successfully!
                    <br>How about we redirect you <a
                        href="<?php echo str_replace('"', '&quot;', $_URI); ?>"><?php html($_Lbl); ?></a>?
                    <script type="text/javascript"><!--
                        window.setTimeout("location.replace('<?=$_location;?>')", 1);
                        // --></script>
                </p>
                <div id="bodyLogin">
                    Hello, <?php html($_loginname); ?>.
                    (<a href="<?php html($_logoutURL); ?>">Logout</a>)
                </div>
            </div>
        </div>
    </section>
<?php echo $View->render('footer');
