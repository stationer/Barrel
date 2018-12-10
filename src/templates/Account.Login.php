<?php
/** @var \Stationer\Graphite\View $View */

echo $View->render('header');

include 'Account._loginForm.php';

echo $View->render('footer');
