<?php
/** @var array $letters list of letters and how many items are under each */
?>
<section>
    <div class="c-card">
        <div class="header">
            <div>
                <h2>Search By Letter</h2>
            </div>
            <div class="buttons">
                <a class="c-btn" href="/Admin/LoginAdd">Add New</a>
            </div>
        </div>
        <div class="content">
            <p>
                <?php foreach ($letters as $letter => $count) {
                    echo '<a class="'.($count > 0 ? 'bold'
                            : 'subtle').'" href="'.'/Admin/Login/'.$letter.'" title="'.$count.'">'.$letter.'</a> ';
                } ?>
            </p>
        </div>
    </div>
</section>
