<?php while ($obj = $comments->fetch_object()):?>
    <div class="row">
        <blockquote class="comment col-md-12" id="comment-<?=$obj->id;?>">
            <p class="comment-text"><?=$obj->comment;?></p>
            <footer><?=date('d.m.Y H:i', $obj->created).' '.$obj->email;?></footer>
        </blockquote>
    </div>
<?php endwhile;?>
