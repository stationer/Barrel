<?php
/** @var string $_title */
$_title = $_title ?? '';
/** @var string $_baseURL */
/** @var array $_meta */
$_meta = $_meta ?? [];
/** @var array $_script */
$_script = $_script ?? [];
/** @var array $_link */
$_link = $_link ?? [];
/** @var string $_head */
$_head = $_head ?? '';
/** @var string $_bodyClass */
$_bodyClass = $_bodyClass ?? '';
/** @var string $_siteName */
$_siteName = $_siteName ?? '';
/** @var string $_login_id */
$_login_id = $_login_id ?? '';
/** @var string $_loginname */
$_loginname = $_loginname ?? '';
/** @var string $_logoutURL */
$_logoutURL = $_logoutURL ?? '';
/** @var string $_loginURL */
$_loginURL = $_loginURL ?? '';

use Stationer\Graphite\G;
?>
<!DOCTYPE HTML>
<html>
    <head>
        <title><?php html($_title); ?></title>
<?php if (!empty($_baseURL)) { ?>
        <base href="<?php html($_baseURL); ?>">
<?php } ?>
        <meta http-equiv="Content-Type" content="text/html;charset=utf-8">
<?php foreach ($_meta as $k => $v) { ?>
        <meta name="<?php html($k)?>" content="<?php html($v)?>">
<?php }
      foreach ($_script as $v) { ?>
        <script type="text/javascript" src="<?php html($v)?>"></script>
<?php }
      foreach ($_link as $v) { ?>
        <link rel="<?php html($v['rel'])?>" type="<?php html($v['type'])?>" href="<?php html($v['href'])?>" title="<?php html($v['title'])?>">
<?php }
      echo $_head;
?>
    </head>
    <body class="<?php echo $_bodyClass; ?>">
        <div class="container-fluid">
            <div class="row">
                <header id="header">
                    <div>
                        <h1><span><?php html($_siteName)?></span></h1>
                    </div>
                    <div id="login">
                        <nav>
                            <a href="/" title="Home Page">Home</a>
                            <a href="/Home/Contact" title="Contact">Contact</a>
                            <?php if (G::$S && G::$S->Login && G::$S->roleTest('Admin')) { ?>
                                <a href="/Admin">Admin</a>
                            <?php } ?>
                            <?php
                            if ($_login_id) {
                                echo 'Hello, '.$_loginname
                                    .'. <a href="'.$_logoutURL.'" class="c-btn m-outline">Logout</a>'
                                    .'<a href="/Account/edit" class="c-btn m-outline" title="Your Account Settings">Account</a>'
                                ;
                            } else {
                                echo '<a id="_loginLink" class="c-btn m-outline" href="'.$_loginURL.'?_Lbl=Back&amp;_URI='.urlencode($_SERVER["REQUEST_URI"]).'">Login</a>'
                                    .'<script type="text/javascript">document.getElementById(\'_loginLink\').href += encodeURIComponent(location.hash);</script>';
                            }
                            ?>
                        </nav>
                    </div>
                </header>
            </div>
        </div>

<?php G::$V->render('subheader'); ?>

        <main>
            <div class="container">
                <div class="row">
                    <?php if (!empty(G::msg())): ?>
                        <section class="messages">
                            <?php if (0 < $v = count($a = G::msg())) { ?>
                                <details id="msg" open="open">
                                    <summary><?php echo $v; ?> Messages:</summary>
                                    <ul>
                                        <?php foreach ($a as $v) { ?>
                                            <li class="<?php echo $v[1]; ?>"><?php echo $v[0]; ?></li>
                                        <?php } ?>
                                    </ul>
                                </details>
                            <?php } ?>
                        </section>
                    <?php endif; ?>
