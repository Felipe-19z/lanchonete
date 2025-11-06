<!-- Menu Admin - Sofisticado -->
<nav class="navbar-admin">
    <div class="navbar-container">
        <div class="navbar-brand">
            <h3>🍔 Lanchonete Admin</h3>
        </div>
        <ul class="navbar-menu">
            <li><a href="?pg=" class="nav-link">🏠 Início</a></li>
            <li><a href="?pg=admin_clientes" class="nav-link">👥 Clientes</a></li>
            <li><a href="?pg=admin_comidas" class="nav-link">🍕 Cardápio</a></li>
            <li><a href="?pg=admin_paginas" class="nav-link">📄 Páginas</a></li>
            <li><a href="?pg=admin_contato" class="nav-link">📧 Contatos</a></li>
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
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        min-height: 100vh;
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }

    .navbar-admin {
        background: linear-gradient(90deg, #2c3e50 0%, #34495e 100%);
        padding: 0;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.3);
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

    .navbar-brand h3 {
        color: #fff;
        font-size: 24px;
        font-weight: 700;
        letter-spacing: 1px;
        transition: all 0.3s ease;
    }

    .navbar-brand h3:hover {
        color: #ffc107;
        transform: scale(1.05);
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
        padding: 12px 18px;
        color: #ecf0f1;
        text-decoration: none;
        font-size: 16px;
        font-weight: 500;
        transition: all 0.3s ease;
        border-radius: 5px;
        position: relative;
    }

    .nav-link:hover {
        background-color: rgba(255, 193, 7, 0.2);
        color: #ffc107;
        padding: 12px 18px;
        transform: translateY(-2px);
    }

    .nav-link::after {
        content: '';
        position: absolute;
        bottom: 0;
        left: 50%;
        width: 0;
        height: 2px;
        background-color: #ffc107;
        transition: all 0.3s ease;
        transform: translateX(-50%);
    }

    .nav-link:hover::after {
        width: 80%;
    }

    /* Responsivo */
    @media (max-width: 768px) {
        .navbar-container {
            flex-direction: column;
            gap: 15px;
            padding: 15px;
        }

        .navbar-brand h3 {
            font-size: 20px;
        }

        .navbar-menu {
            justify-content: center;
            gap: 10px;
        }

        .nav-link {
            padding: 10px 15px;
            font-size: 14px;
        }
    }
</style>
