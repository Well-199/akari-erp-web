<?php
    require './config.php';
    require './partials/header_login.php';
?>

    <section class="conteiner">
        <div class="logo">
            <div class="logo1"></div>
            <div class="logo2"></div>
            <div class="logo3"></div>
        </div>
        <form method="POST" action="<?=$base;?>/login_action.php">
            <input type="email" class="login" name="email" maxlength="45" placeholder="email" required/>
            
            <input type="password" class="password" name="password" maxlength="8" placeholder="senha" required/>

            <?php if(!empty($_SESSION['flash'])): ?>
                <?=$_SESSION['flash'];?>
                <?=$_SESSION['flash'] = '';?>
            <?php endif;?>

            <button type="submit" class="bnt">Acessar o Sistema</button>
        </form>
    </section>

<?php require './partials/footer.php'; ?>

