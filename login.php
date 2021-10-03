<?php
    require './config.php';
    require './partials/header_login.php';
?>

<div class="login-body">

    <form method="POST" action="<?=$base;?>/login_action.php">
        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label text-light">Email</label>
            <input type="email" class="form-control" maxlength="45" name="email" id="exampleInputEmail1" aria-describedby="emailHelp" required/>
        </div>
        <div class="mb-3">
            <label for="exampleInputPassword1" class="form-label text-light">Senha</label>
            <input type="password" class="form-control" maxlength="8" name="password" id="exampleInputPassword1" required/>

            <?php if(!empty($_SESSION['flash'])): ?>
                <?=$_SESSION['flash'];?>
                <?=$_SESSION['flash'] = '';?>
            <?php endif;?>

        </div>
        <button type="submit" class="btn text-button">Acessar o Sistema</button>
    </form>
</div>

<?php require './partials/footer.php'; ?>

