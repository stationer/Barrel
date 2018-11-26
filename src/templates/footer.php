<?php
/** @var \Stationer\Graphite\View $View */
$_tail = $tail ?? '';
?>
                </div>
            </div>

<?php echo $View->render('debug'); ?>
        </main>
        <footer id="footer">
        </footer>
        <?php echo $View->render('debug'); ?>
        <div id="G__tail"><?php echo $_tail;?></div>
    </body>
</html>
