<!DOCTYPE html>
<html lang="pt-BR">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <link rel="stylesheet" href="/css/global.css">
  <link rel="stylesheet" href="/css/header.css">
  <link rel="stylesheet" href="/css/orders.css">

  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100..900&display=swap" rel="stylesheet">

  <script src="https://code.jquery.com/jquery-2.2.4.min.js" integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44=" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js" integrity="sha512-pHVGpX7F/27yZ0ISY+VVjyULApbDlD0/X0rgGbTqCE7WFW5MezNTWG/dnhtbBuICzsd0WQPgpE4REBLv+UqChw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

  <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
  <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

  <title>Loja Mágica - Pedidos</title>
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
          Alterar Status do Pedido: (ID: <?php echo $_SESSION['data']['order']['id']; ?>)
        </h1>
      </div>

      <form id="form-order" method="post">
        <input hidden type="text" name="order_id" value="<?php echo $_SESSION['data']['order']['id']; ?>" />
        <input hidden type="text" name="customer_id" value="<?php echo $_SESSION['data']['order']['customer_id']; ?>" />
        <div id="inputs">
          <div>
            <label for="customer_id">Cliente: </label>
            <select class="select2" name="customer_id" id="customer_id" required disabled>
              <option value="0">Selecione um cliente...</option>
              <?php
              if (isset($_SESSION['data']['customers']) && is_array($_SESSION['data']['customers'])) {
                foreach ($_SESSION['data']['customers'] as $customer) {
                  if ($customer['id'] == $_SESSION['data']['order']['customer_id']) {
                    echo '<option selected value="' . $customer['id'] . '"> ' . $customer['name'] . ' </option>';
                  } else {
                    echo '<option value="' . $customer['id'] . '"> ' . $customer['name'] . ' </option>';
                  }
                }
              }
              ?>
            </select>
          </div>
          <div>
            <label for="amount">Valor (R$): </label>
            <input disabled type="text" name="amount" id="amount" placeholder="999.999.999,99" required value="<?php echo number_format($_SESSION['data']['order']['amount'], 2, ',', '.') ?>" readonly />
          </div>
          <div>
            <label for="status">Status: </label>
            <select class="select2" name="status" id="status" required>
              <?php $_SESSION['data']['order']['status']; ?>
              <option <?php if ($_SESSION['data']['order']['status'] == 'Pedido recebido') {
                        echo 'selected';
                      } ?> value="Pedido recebido">Pedido recebido</option>
              <option <?php if ($_SESSION['data']['order']['status'] == 'Pagamento aprovado') {
                        echo 'selected';
                      } ?> value="Pagamento aprovado">Pagamento aprovado</option>
              <option <?php if ($_SESSION['data']['order']['status'] == 'Em preparação') {
                        echo 'selected';
                      } ?> value="Em preparação">Em preparação</option>
              <option <?php if ($_SESSION['data']['order']['status'] == 'Enviado') {
                        echo 'selected';
                      } ?> value="Enviado">Enviado</option>
              <option <?php if ($_SESSION['data']['order']['status'] == 'Entregue') {
                        echo 'selected';
                      } ?> value="Entregue">Entregue</option>
              <option <?php if ($_SESSION['data']['order']['status'] == 'Cancelado') {
                        echo 'selected';
                      }; ?> value="Cancelado">Cancelado</option>
            </select>
          </div>
        </div>

        <div id="buttons">
          <button type="submit">Confirmar</button>
          <button type="reset">Limpar</button>
        </div>
      </form>
    </div>
  </main>
</body>

<script>
  $(document).ready(function() {
    $('#amount').mask('000.000.000.000.000,00', {
      reverse: true,
    });
    $('.select2').select2();
  })
</script>

</html>