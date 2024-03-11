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
      <div id="container-title">
        <div id="container-page-title">
          <button id="back-button" onclick="history.back()">
            <img src="/assets/icons/back.png" alt="Ver" width="40" height="40" alt="Voltar" />
          </button>
          <h1 id="page-title">
            Informações do Cliente (ID: <?php echo $_SESSION['data']['customer']['id']; ?>)
          </h1>
        </div>
        <a href="/clientes/email?id=<?php echo $_SESSION['data']['customer']['id']; ?>">
          <img src="/assets/icons/email.png" width="50" height="50" alt="Ícone de E-mail" />
        </a>
      </div>
      <?php
      if (isset($_SESSION['email_success'])) {
        echo '
            <p style="margin: 10px 0; color: #15803d">' . $_SESSION['email_success'] . '</p>
          ';
        unset($_SESSION['email_success']);
      }
      ?>
      <p style="font-size: 16px; margin: 10px 0;">
        Criado em:
        <?php echo date_format(new DateTime($_SESSION['data']['customer']['created_at']), 'd/m/Y') ?>
        às
        <?php echo date_format(new DateTime($_SESSION['data']['customer']['created_at']), 'H:i') ?>
      </p>

      <div id="container-customer-infos">
        <div>
          <label for="cpf">CPF:</label>
          <input type="text" name="cpf" id="cpf" readonly value="<?php echo $_SESSION['data']['customer']['cpf']; ?>" />
        </div>
        <div>
          <label for="name">Nome Completo:</label>
          <input type="text" name="name" id="name" readonly value="<?php echo $_SESSION['data']['customer']['name']; ?>" />
        </div>
        <div>
          <label for="email">E-mail:</label>
          <input type="text" name="email" id="email" readonly value="<?php echo $_SESSION['data']['customer']['email']; ?>" />
        </div>
      </div>

      <div id="container-customer-orders">
        <h2>Pedidos: <?php echo count($_SESSION['data']['orders']); ?></h2>
        <?php
        if (!isset($_SESSION['data']['orders']) || count($_SESSION['data']['orders']) == 0) {
          echo '<p style="font-size: 14px; font-weight: 400; margin-top: 10px">Nenhum pedido registrado.<p>';
        } else {
        ?>
          <table id="generic-table">
            <tr style="background-color: #166534; color: #FFFFFF">
              <th style="width: 20%;">Data e Hora</th>
              <th style="width: 35%;">Valor</th>
              <th style="width: 35%;">Status</td>
              <th style="width: 10%;">Ações</td>
            </tr>
            <?php
            if (isset($_SESSION['data']['orders']) && is_array($_SESSION['data']['orders'])) {
              foreach ($_SESSION['data']['orders'] as $order) {
                $html = '<tr>';
                $html .= '<td class="center">' . date_format(new DateTime($order['created_at']), 'd/m/Y') . ' às ' . date_format(new DateTime($order['created_at']), 'H:i') . '</td>';
                $html .= '<td> R$ ' . number_format($order['amount'], 2, ',', '.') . '</td>';
                $html .= '<td>' . $order['status'] . '</td>';
                $html .= '
                  <td class="center">
                    <a href="/pedidos/editar?id=' . $order['id'] . '"> 
                      <img src="/assets/icons/pencil.png" alt="Editar" width="20" height="20"/>
                    </a>
                  </td>
                ';
                $html .= '</tr>';
                echo $html;
              }
            }
            ?>
          </table>
        <?php
        }
        ?>
      </div>

      <div id="container-customer-emails">
        <h2>E-mails: <?php echo count($_SESSION['data']['emails']); ?></h2>
        <?php
        if (!isset($_SESSION['data']['emails']) || count($_SESSION['data']['emails']) == 0) {
          echo '<p style="font-size: 14px; font-weight: 400; margin-top: 10px">Nenhum e-mail enviado.<p>';
        } else {
        ?>
          <table id="generic-table">
            <tr style="background-color: #166534; color: #FFFFFF">
              <th style="width: 20%;">Data e Hora</th>
              <th style="width: 70%;">Assunto</th>
              <th style="width: 10%;">Ações</td>
            </tr>
            <?php
            if (isset($_SESSION['data']['emails']) && is_array($_SESSION['data']['emails'])) {
              foreach ($_SESSION['data']['emails'] as $email) {
                $html = '<tr>';
                $html .= '<td class="center">' . date_format(new DateTime($email['created_at']), 'd/m/Y') . ' às ' . date_format(new DateTime($email['created_at']), 'H:i') . '</td>';
                $html .= '<td>' . $email['subject'] . '</td>';
                $html .= '
                  <td class="center actions" >
                    <a href="/clientes/email/info?id=' . $email['id'] . '"> 
                      <img src="/assets/icons/eye.png" alt="Ver" width="20" height="20"/>
                    </a>
                  </td>
                ';
                $html .= '</tr>';
                echo $html;
              }
            }
            ?>
          </table>
        <?php
        }
        ?>
      </div>
    </div>
  </main>
</body>

</html>