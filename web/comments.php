<?php
define('STATICVER', '0.1');

use \Core\DB\Adapter;
use \Core\Events\EventManager;
require_once __DIR__.'/../init.server.php';

include __DIR__.'/../views/header.php';

$table_name = 'comments';
if ($_SESSION['csrf-is-valid'] && !empty($_POST['comment'])) {
    $observers = Adapter::runQuery("SELECT * FROM `observers`");
    while ($obj = $observers->fetch_object()) {
        $sdata[$obj->name][$obj->id] = $obj->data;
    }
    EventManager::getInstance()->loadData($sdata);

    $email = Adapter::escape($_POST['email']);
    $comment = EventManager::getInstance()
        ->run_onSubmit($_POST['comment']);
    $comment = Adapter::escape($comment);
    $sql = "INSERT INTO `$table_name`(`email`, `comment`) VALUES ('$email', '$comment')";
    Adapter::runQuery($sql);
}
?>

<div class="comment-list">
    <?php
    $comments = Adapter::runQuery("SELECT * FROM `$table_name` ORDER BY `created` DESC");
    include __DIR__.'/../views/comment-list.php';
    ?>
</div>

<div class="new-comment row">
    <form action="" method="POST">
        <input type="hidden" name="csrf_token" value="<?=$_SESSION['csrf'];?>">
        <label class="col-sm-3 control-label" for="form-email">Enter your E-mail:</label>
        <p class="col-sm-9"><input type="email" name="email" id="form-email" class="form-control" required></p>
        <label class="col-sm-3 control-label" for="form-comment">Enter the comment:</label>
        <p class="col-sm-9"><textarea rows="7" name="comment" id="form-comment" class="form-control" required></textarea>
        <p><input type="submit" class="btn btn-info"></p>
    </form>
</div>

<?php
include __DIR__.'/../views/footer.php';
