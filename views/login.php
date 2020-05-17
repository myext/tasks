<html>
<?php include_once('head.php'); ?>

<body>
<div id="list" class="container">

    <?php include_once('messages.php'); ?>

    <?php include_once('menu.php'); ?>

    <div style="min-height: 30px; "></div>

    <form method="post" action="<?='http://'.$_SERVER['SERVER_NAME'].'/login';?>">
        <div class="form-group">
            <label for="login">Login</label>
            <input name="login" type="text" class="form-control" id="login" aria-describedby="emailHelp" placeholder="Enter login">
        </div>
        <div class="form-group">
            <label for="password">Password</label>
            <input name="password" type="password" class="form-control" id="password" placeholder="Password">
        </div>
        <button type="submit" class="btn btn-block btn-success">Войти</button>
    </form>

    <form method="post" action="<?='http://'.$_SERVER['SERVER_NAME'].'/logout';?>">
        <button <?php if(!\Session\Session::isAuth()) echo 'hidden' ?> type="submit" class="btn btn-block btn-primary">Выйти</button>
    </form>

</div>
<?php include_once('scripts.php'); ?>

</body>
</html>
