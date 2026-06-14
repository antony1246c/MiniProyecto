<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MiniProyecto — UTP</title>
    <link rel="stylesheet" href="../public/assets/css/estiloMenuPrincipal.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/4.4.0/chart.umd.min.js"></script>

    <style>
        .top-bar {
            position: sticky;
            top: 0;
            z-index: 99;
            background: var(--sidebar-color);
            padding: 14px 24px;
            display: flex;
            align-items: center;
            box-shadow: 0 1px 6px rgba(0, 0, 0, 0.08);
            transition: var(--tran-05);
        }

        .top-bar .top-title {
            font-size: 18px;
            font-weight: 600;
            color: var(--primary-color);
            font-family: 'Poppins', sans-serif;
        }

        body.dark .home .top-bar .top-title {
            color: var(--text-color)
        }
    </style>
</head>

<body>