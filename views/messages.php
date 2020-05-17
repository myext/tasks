<?php foreach(\Session\Session::getErrors() as $error): ?>
    <div class="alert alert-danger" role="alert">
        <strong><?=$error?></strong>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
<?php endforeach; ?>

<?php foreach(\Session\Session::getMessages() as $message): ?>
    <div class="alert alert-success" role="alert">
        <strong><?=$message?></strong>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
<?php endforeach; ?>
