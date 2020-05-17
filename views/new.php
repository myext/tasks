<html>
<?php include_once ('head.php'); ?>

<body>

<?php include_once ('messages.php'); ?>

<div id="list" class="container">
    <?php include_once ('menu.php'); ?>

    <div style="min-height: 30px; "></div>

    <form method="post" action="<?='http://'.$_SERVER['SERVER_NAME'].'/post';?>">
        <div class="form-group">
            <p>Имя</p>
            <input name="name" type="text" class="form-control" placeholder="Имя">
        </div>
        <div class="form-group">
            <p>Email</p>
            <input name="email" type="text" class="form-control" placeholder="name@example.com">
        </div>
        <div class="form-group">
            <p>Текст</p>
            <textarea name="text" class="form-control" rows="3"></textarea>
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>


</div>

<?php include_once ('scripts.php'); ?>

</body>
</html>
