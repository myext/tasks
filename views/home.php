<html>
<?php include_once ('head.php'); ?>

<body>
<div id="list" class="container">

    <?php include_once ('messages.php'); ?>

    <?php include_once ('menu.php'); ?>
    <h1 class="col-12 text-center">список задач</h1>
    <div id="tasks" class="col">
    <?php foreach($collection as $task): ?>
    <form class="row border-bottom task" method="post" action="<?='http://'.$_SERVER['SERVER_NAME'];?>">
        <input name="id" type="hidden" value="<?=$task['id'];?>">
        <input name="is_done" type="hidden" value="off">
        <div class="col-sm-2">
            <p sort="name"  state="<?=htmlspecialchars($task['name']);?>" class="text-truncate"><?=htmlspecialchars($task['name']);?></p>
        </div>
        <div class="col-sm-2">
            <p sort="email" state="<?=htmlspecialchars($task['email']);?>" class="text-truncate"><?=htmlspecialchars($task['email']);?></p>
        </div>
        <div class="col-sm-5">
            <textarea <?php if(!\Session\Session::isAuth()) echo 'readonly' ?> class="form-control text-left" rows="2" name="text">
                <?=htmlspecialchars($task['text']) ?>
            </textarea>
        </div>
        <div class="col-sm-2">
            <div class="row form-check">
                <label class="form-check-label">
                    <input sort="status" <?php if(!\Session\Session::isAuth()) echo 'disabled' ?> name="is_done" type="checkbox" state="<?=$task['is_done']; ?>"
                           class="form-check-input done"<?php if($task['is_done']) echo 'checked' ?>>
                    <p>выполнено</p>
                </label>
            </div>
            <div class="row">
                <p class="is_censored" <?php if(!$task['is_censored']) echo 'hidden' ?>>отредактировано</p>
            </div>
        </div>
        <div class="col-sm-1">
            <button <?php if(!\Session\Session::isAuth()) echo 'hidden' ?> type="submit" class="btn btn-primary update">Submit</button>
        </div>
    </form>
    <?php endforeach; ?>
    </div>
    <div class="row">
        <?php for ($i = 1; $i <= $pages['last']; $i++): ?>
            <?php if ($i != $pages['current']): ?>
                <p class="pages"><a href = "<?='http://'.$_SERVER['SERVER_NAME'].'/'.$i ;?>"><?=$i?></a></p>
            <?php else : ?>
                <p class="pages"><?=$i?></p>
            <?php endif; ?>
        <?php endfor; ?>
    </div>
    <div class="row">
        <div class="col-sm-4">
            <button type="name" class="btn btn-secondary btn btn-block mysort">Сортировать по имени</button>
        </div>
        <div class="col-sm-4">
            <button type="email" class="btn btn-secondary btn btn-block mysort">Сортировать по email</button>
        </div>
        <div class="col-sm-4">
            <button type="status" class="btn btn-secondary btn btn-block mysort">Сортировать по статусу</button>
        </div>
    </div>
</div>

<!-- Modal success-->
<div class="modal fade" id="success" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header alert alert-success">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div id="successText" class="modal-body"></div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal error-->
<div class="modal fade" id="error" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header alert alert-danger">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div id="errorText" class="modal-body"></div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<?php include_once ('scripts.php'); ?>

</body>
</html>