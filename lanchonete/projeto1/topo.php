<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>
<!-- Menu Público - Sofisticado -->
<nav class="navbar-public">
    <div class="navbar-container">
        <div class="navbar-brand">
            <a href="?pg=conteudo" class="logo">
                <h2>Lanchonete que Delícia 😋</h2>
            </a>
        </div>
        <ul class="navbar-menu">
            <li><a href="?pg=conteudo" class="nav-link">Home</a></li>
            <li><a href="?pg=quemsomos" class="nav-link">Quem Somos</a></li>
            <li><a href="?pg=cardapio" class="nav-link">🍕 Cardápio</a></li>
            <li><a href="?pg=clientes" class="nav-link">Clientes</a></li>
            <li><a href="?pg=faleconosco" class="nav-link">Contato</a></li>
        </ul>
    </div>
</nav>

<style>
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }

    body {
        background: #f5f5f5;
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }

    .navbar-public {
        background: linear-gradient(90deg, #ff6b6b 0%, #ee5a6f 50%, #ff8c42 100%);
        padding: 0;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.2);
        position: sticky;
        top: 0;
        z-index: 1000;
    }

    .navbar-container {
        max-width: 1200px;
        margin: 0 auto;
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 0 20px;
    }

    .navbar-brand {
        flex-shrink: 0;
    }

    .logo {
        text-decoration: none;
        display: flex;
        align-items: center;
    }

    .navbar-brand h2 {
        color: #fff;
        font-size: 28px;
        font-weight: 700;
        letter-spacing: 1px;
        transition: all 0.3s ease;
        text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.2);
    }

    .navbar-brand h2:hover {
        transform: scale(1.05);
        text-shadow: 2px 2px 8px rgba(0, 0, 0, 0.4);
    }

    .navbar-menu {
        display: flex;
        list-style: none;
        gap: 5px;
        flex-wrap: wrap;
        justify-content: flex-end;
    }

    .navbar-menu li {
        position: relative;
    }

    .nav-link {
        display: inline-block;
        padding: 15px 20px;
        color: #fff;
        text-decoration: none;
        font-size: 16px;
        font-weight: 600;
        transition: all 0.3s ease;
        border-radius: 5px;
        position: relative;
        text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.1);
    }

    .nav-link:hover {
        background-color: rgba(255, 255, 255, 0.2);
        color: #fff;
        transform: translateY(-3px);
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.15);
    }

    .nav-link::before {
        content: '';
        position: absolute;
        bottom: 0;
        left: 0;
        width: 0;
        height: 3px;
        background-color: #fff;
        transition: width 0.3s ease;
    }

    .nav-link:hover::before {
        width: 100%;
    }

    /* Responsivo */
    @media (max-width: 768px) {
        .navbar-container {
            flex-direction: column;
            gap: 15px;
            padding: 15px;
        }

        .navbar-brand h2 {
            font-size: 24px;
        }

        .navbar-menu {
            justify-content: center;
            gap: 8px;
        }

        .nav-link {
            padding: 12px 15px;
            font-size: 14px;
        }
    }

    @media (max-width: 480px) {
        .navbar-brand h2 {
            font-size: 20px;
        }

        .nav-link {
            padding: 10px 12px;
            font-size: 13px;
        }
    }
</style>

