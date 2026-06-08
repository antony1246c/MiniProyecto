<?php
$problema = isset($_GET['p']) ? (int) $_GET['p'] : null;
include '../src/components/header.php';
?>

<nav class="sidebar close">
    <header>
        <div class="image-text">
            <span class="image">
                <img src="../src/img/logo.png" alt="logo">
            </span>
            <div class="text header-text">
                <span class="name">MiniProyecto</span>
                <span class="profession">Desarrollo Soft VII</span>
            </div>
        </div>
        <i class="bx bx-chevron-right toggle"></i>
    </header>

    <div class="menu-bar">
        <div class="menu">
            <ul class="menu-links">
                <li class="nav-link">
                    <a href="index.php">
                        <i class="bx bx-home-alt icon"></i>
                        <span class="text nav-text">Inicio</span>
                    </a>
                </li>
                <li class="nav-link">
                    <a href="?p=1">
                        <i class="bx bx-line-chart icon"></i>
                        <span class="text nav-text">Problema #1</span>
                    </a>
                </li>
                <li class="nav-link">
                    <a href="?p=2">
                        <i class="bx bx-plus icon"></i>
                        <span class="text nav-text">Problema #2</span>
                    </a>
                </li>
                <li class="nav-link">
                    <a href="?p=3">
                        <i class="bx bx-x icon"></i>
                        <span class="text nav-text">Problema #3</span>
                    </a>
                </li>
                <li class="nav-link">
                    <a href="?p=4">
                        <i class="fa-solid fa-arrow-up-1-9 icon"></i>
                        <span class="text nav-text">Problema #4</span>
                    </a>
                </li>
                <li class="nav-link">
                    <a href="?p=5">
                        <i class="fa-solid fa-person-circle-plus icon"></i>
                        <span class="text nav-text">Problema #5</span>
                    </a>
                </li>
                <li class="nav-link">
                    <a href="?p=6">
                        <i class="fa-regular fa-hospital icon"></i>
                        <span class="text nav-text">Problema #6</span>
                    </a>
                </li>
                <li class="nav-link">
                    <a href="?p=7">
                        <i class="fa-solid fa-calculator icon"></i>
                        <span class="text nav-text">Problema #7</span>
                    </a>
                </li>
                <li class="nav-link">
                    <a href="?p=8">
                        <i class="fa-solid fa-calendar-days icon"></i>
                        <span class="text nav-text">Problema #8</span>
                    </a>
                </li>
                <li class="nav-link">
                    <a href="?p=9">
                        <i class="fa-solid fa-superscript icon"></i>
                        <span class="text nav-text">Problema #9</span>
                    </a>
                </li>
            </ul>
        </div>

        <div class="bottom content">
            <li class="mode">
                <div class="moon-sun">
                    <i class="bx bx-moon icon moon"></i>
                    <i class="bx bx-sun icon sun"></i>
                </div>
                <span class="mode-text text">Dark Mode</span>
                <div class="toggle-switch">
                    <span class="switch"></span>
                </div>
            </li>
        </div>
    </div>
</nav>

<section class="home">
    <div class="top-bar">
        <span class="top-title">MiniProyecto — UTP Solin Rodriguez | Ana Cheung | Carlos Diaz </span>
    </div>

    <?php if ($problema === null): ?>
        <div class="welcome">
            <div class="welcome-header">
                <img src="../src/img/logo-utp.png" alt="Logo UTP" class="welcome-logo">
                <img src="../src/img/logo.png" alt="Logo Facultad" class="welcome-logo">
            </div>

            <h1>MiniProyecto Grupal</h1>
            <h3>Universidad Tecnológica de Panamá</h3>
            <p class="welcome-facultad">Facultad de Ingeniería de Sistemas Computacionales</p>

            <div class="welcome-info">
                <div class="info-box">
                    <span class="info-lbl">Salón</span>
                    <span class="info-val">1GS131</span>
                </div>
                <div class="info-box">
                    <span class="info-lbl">Curso</span>
                    <span class="info-val">Desarrollo de Software VII</span>
                </div>
            </div>

            <div class="autores">
                <div class="autor-card">
                    <i class="bx bx-user-circle autor-icon"></i>
                    <span class="autor-nombre">Solin Rodriguez</span>
                    <span class="autor-cedula">C.I: 8-1032-104</span>
                </div>
                <div class="autor-card">
                    <i class="bx bx-user-circle autor-icon"></i>
                    <span class="autor-nombre">Ana Cheung</span>
                    <span class="autor-cedula">C.I: 8-1033-725</span>
                </div>
                <div class="autor-card">
                    <i class="bx bx-user-circle autor-icon"></i>
                    <span class="autor-nombre">Carlos Diaz</span>
                    <span class="autor-cedula">C.I: 7-713-1842</span>
                </div>
            </div>
            <p class="welcome-hint">
                <i class="bx bx-left-arrow-alt"></i>
                Selecciona un problema del menú para comenzar
            </p>
        </div>
    <?php elseif ($problema >= 1 && $problema <= 9): ?>
        <?php
        $css = __DIR__ . "/../src/estilos/estiloP{$problema}.css";
        if (file_exists($css)) {
            echo '<link rel="stylesheet" href="../src/estilos/estiloP' . $problema . '.css">';
        }
        ?>
        <?php include __DIR__ . "/problems/p{$problema}.php"; ?>
    <?php else: ?>
        <div class="text">Problema no encontrado.</div>
    <?php endif; ?>
</section>

<script src="script.js"></script>

<?php include '../src/components/footer.php'; ?>