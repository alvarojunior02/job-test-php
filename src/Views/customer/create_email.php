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

  <title>Loja Mágica - Clientes - Enviar E-mail</title>
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
          Enviar E-mail
        </h1>
      </div>

      <form id="form-send-email" method="post">
        <input hidden type="text" name="customer_id" value="<?php echo $_SESSION['data']['customer']['id'] ?>" />
        <div id="inputs">
          <div>
            <label for="customer_identification">Cliente: </label>
            <input type="text" name="customer_identification" id="customer_identification" value="<?php echo $_SESSION['data']['customer']['name'] ?> (<?php echo $_SESSION['data']['customer']['email'] ?>)" readonly required />
          </div>
          <div>
            <label for="subject">Assunto: </label>
            <input type="text" name="subject" required />
          </div>
          <div>
            <label for="message">Mensagem: </label>
            <textarea rows="12" name="message" required></textarea>
          </div>
        </div>

        <div id="buttons">
          <button type="submit">Enviar</button>
          <button type="reset">Limpar</button>
        </div>
      </form>
    </div>
  </main>
</body>

</html>