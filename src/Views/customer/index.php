<!DOCTYPE html>
<html lang="pt-BR">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <link rel="stylesheet" href="css/customers.css">

  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100..900&display=swap" rel="stylesheet">

  <title>Loja Mágica - Clientes</title>

  <style>
    * {
      margin: 0;
      padding: 0;

      font-family: "Inter", sans-serif;
    }

    body {
      background-color: #FFFFFF;

      margin: 0;
      padding: 0;

      display: flex;
      flex-direction: column;
      justify-content: flex-start;
      align-items: center;

      max-width: 100vw;
      width: 100vw;
      max-height: 100vh;
      height: 100vh;
      /* overflow: hidden; */
    }
  </style>
</head>

<body>
  <header>
    <div id="header-content">
      <div id="header-logo">
        <div id="header-logo-card">
          <img src="../../assets/icons/customers.png" width="50" height="50" />
          <p>Clientes</p>
        </div>
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
      <form id="form-import-customers" method="POST" action="/clientes/import" enctype="multipart/form-data">
        <div>
          <label for="file_csv">Importar Clientes (.csv)</label>
          <input type="file" name="file_csv" id="file_csv" required />
        </div>
        <button type="submit">Enviar</button>
      </form>

      <table id="customers-list">
        <tr>
          <th>ID</th>
          <th>CPF</th>
          <th>Nome</th>
          <th>E-mail</td>
          <th>Ações</th>
        </tr>
        <?php
        echo $customers;
        ?>
      </table>
    </div>
  </main>
</body>

</html>