<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KyZXEAg3QhqLMpG8r+8fhAXLRk2vvoC2f3B09zVXn8CA5QIVfZOJ3BCsw2P0p/We" crossorigin="anonymous">
  <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
  <link rel="stylesheet" href="<?=$base;?>/styles/style.css"/>
  <link rel="shortcut icon" href="<?=$base;?>/images/favicon.ico" />
  <title>Expedição</title>
</head>
<body>
  <nav class="navbar navbar-light myHeader">
    <div class="container-fluid">
      <a class="navbar-brand text-light">Expedição</a>
      <form method="GET" action="<?=$base;?>/logout.php">
        <button type="submit" class="logoutButton">
          <i class="fas fa-sign-out-alt text-light goBack">sair</i>
        </button>
      </form>
    </div>
  </nav>