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

  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <script src="https://code.jquery.com/jquery-2.2.4.min.js" integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44=" crossorigin="anonymous"></script>

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
      <h1>Pedidos</h1>

      <form id="form-import" method="POST" action="/pedidos/import" enctype="multipart/form-data">
        <div>
          <label for="file-upload-button">
            Importar Pedido (.xml)
            <input type="file" id="file-upload-button" name="file_xml" accept="text/xml" required />
          </label>
          <span id="file-upload-name"></span>
        </div>
        <button id="form-submit-button" type="submit" disabled>Salvar</button>

        <script>
          let input = document.getElementById("file-upload-button");
          let uploadName = document.getElementById("file-upload-name");
          let uploadButton = document.getElementById("form-submit-button");

          input.addEventListener("change", () => {
            let inputImage = document.querySelector("input[type=file]").files[0];
            uploadName.innerText = inputImage.name;
            uploadButton.removeAttribute('disabled');
          })
        </script>
      </form>

      <?php
      if (isset($_SESSION['imported_xml_message'])) {
        echo $_SESSION['imported_xml_message'];
        unset($_SESSION['imported_csv_message']);
      }
      ?>

      <button onclick="window.location = '/pedidos/cadastrar'" id="button-new-order">Novo Pedido</button>

      <?php
      if (isset($_SESSION['crud_message'])) {
        echo '
            <br>
            <p style="margin-top: 10px; color: #15803d">' . $_SESSION['crud_message'] . '</p>
          ';
        unset($_SESSION['crud_message']);
      }
      ?>

      <table id="generic-table" style="margin-top: 15px;">
        <tr style="background-color: #166534; color: #FFFFFF">
          <th style="width: 20%;">Data e Hora</th>
          <th style="width: 35%;">Cliente</th>
          <th style="width: 15%;">Valor</td>
          <th style="width: 20%">Status</td>
          <th style="width: 10%;">Ações</th>
        </tr>
        <?php
        if (isset($_SESSION['data']['orders']) && is_array($_SESSION['data']['orders'])) {
          foreach ($_SESSION['data']['orders'] as $order) {
            $html = '<tr>';
            $html .= '<td class="center">' . date_format(new DateTime($order['created_at']), 'd/m/Y') . ' às ' . date_format(new DateTime($order['created_at']), 'H:i') . '</td>';
            $html .= '<td> <a id="customer-link-cell" href="/clientes/info?id=' . $order['customer_id'] . '">' . $order['name'] . ' </a> </td>';
            $html .= '<td> R$ ' . number_format($order['amount'], 2, ',', '.') . '</td>';
            $html .= '<td class="center">' . $order['status'] . '</td>';
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
    </div>
  </main>
</body>

</html>