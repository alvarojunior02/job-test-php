<!DOCTYPE html>
<html lang="pt-BR">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <link rel="stylesheet" href="/css/home.css">

  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100..900&display=swap" rel="stylesheet">

  <title>Loja Mágica - Home</title>

  <style>
    * {
      margin: 0;
      padding: 0;

      font-family: "Inter", sans-serif;
    }

    body {
      margin: 0;
      padding: 0;

      background-color: #166534;

      display: flex;
      flex-direction: column;
      justify-content: center;
      align-items: center;

      max-width: 100vw;
      width: 100vw;
      max-height: 100vh;
      height: 100vh;
      overflow: hidden;
    }
  </style>
</head>

<body>
  <h1 class="title">Loja Mágica - Sistema de Gestão</h1>
  <div id="home-buttons">
    <a href="/clientes">
      <img src="../assets/icons/customers.png" width="100px" height="100px" />
      <span>Clientes</span>
    </a>
    <a href="/pedidos">
      <img src="../assets/icons/orders.png" width="100px" height="100px" />
      <span>Pedidos</span>
    </a>
  </div>
</body>

</html>