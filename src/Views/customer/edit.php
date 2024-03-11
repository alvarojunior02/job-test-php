<!DOCTYPE html>
<html lang="pt-BR">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <link rel="stylesheet" href="/css/global.css">
  <link rel="stylesheet" href="/css/header.css">
  <link rel="stylesheet" href="/css/customers.css">

  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100..900&display=swap" rel="stylesheet">

  <script src="https://code.jquery.com/jquery-2.2.4.min.js" integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44=" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js" integrity="sha512-pHVGpX7F/27yZ0ISY+VVjyULApbDlD0/X0rgGbTqCE7WFW5MezNTWG/dnhtbBuICzsd0WQPgpE4REBLv+UqChw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

  <title>Loja Mágica - Clientes</title>
</head>

<body>
  <header>
    <div id="header-content">
      <div id="header-logo">
        <h1 style="color: #FFFFFF">Loja Mágica</h1>
      </div>
      <div id="header-links">
        <a href="/" style="margin-right: 20px">Home</a>
        <a href="/clientes">Clientes</a>
        <a href="/pedidos" style="margin-left: 20px">Pedidos</a>
      </div>
    </div>
  </header>

  <main>
    <div>
      <div id="container-page-title">
        <button id="back-button" onclick="history.back()">
          <img src="/assets/icons/back.png" alt="Ver" width="40" height="40" alt="Voltar" />
        </button>
        <h1 id="page-title">
          Editar Cliente: (ID: <?php echo $_SESSION['data']['customer']['id']; ?>)
        </h1>
      </div>
      <p style="font-size: 16px; margin: 10px 0;">
        Criado em:
        <?php echo date_format(new DateTime($_SESSION['data']['customer']['created_at']), 'd/m/Y') ?>
        às
        <?php echo date_format(new DateTime($_SESSION['data']['customer']['created_at']), 'H:i') ?>
      </p>

      <form id="form-customer" method="post">
        <div id="inputs">
          <div>
            <label for="cpf">CPF: </label>
            <input type="text" name="cpf" id="cpf" disabled value="<?php echo $_SESSION['data']['customer']['cpf'] ?>" />
          </div>
          <div>
            <label for="name">Nome: </label>
            <input type="text" name="name" required value="<?php echo $_SESSION['data']['customer']['name'] ?>" />
          </div>
          <div>
            <label for="email">E-mail: </label>
            <input type="text" name="email" required value="<?php echo $_SESSION['data']['customer']['email'] ?>" />
          </div>
        </div>

        <div id="buttons">
          <button type="submit">Confirmar</button>
        </div>
      </form>
    </div>
  </main>
</body>

<script>
  $(document).ready(() => {
    $("#cpf").mask('000.000.000-00');
  })
</script>

</html>