
<!DOCTYPE html>
<html data-theme="light">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?=$pageTitle?></title>
    <link
        rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/bulma@1.0.4/css/bulma.min.css"
    >
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
</head>

<body>

<nav class="navbar is-primary " role="navigation" aria-label="main navigation">
    <div class="navbar-brand">
        <a class="navbar-item" href="index.php">
            <strong>357ltd</strong>
        </a>
    </div>

    <div name="navbarBasic" class="navbar-menu">
        <div class="navbar-start">
            <a class="navbar-item" href="products.php">
                Products
            </a>
            <a class="navbar-item" href="account.php">
                Account
            </a>
        </div>
    </div>

    <div class="navbar-end">
        <a class="navbar-item" href="basket.php">
            <div class="icon-text">
                    <span class="icon">
                        <i class="fas fa-shopping-cart"></i>
                        </span>
                <span class="">Shopping Cart</span>
            </div>
        </a>

        <?php if(isset($_SESSION['user']['uid'])): ?>


            <a class="navbar-item" href="resources/handlers/logout.handler.php">
                <div class="icon-text">
                    <span class="icon">
                        <i class="fas fa-right-from-bracket"></i>
                        </span>
                    <span class="">Logout</span>
                </div>
            </a>

        <?php else: ?>

        <a class="navbar-item" href="login.php">
            <div class="icon-text">
                    <span class="icon">
                        <i class="fas fa-user"></i>
                        </span>
                <span class="">Login</span>
            </div>
        </a>
    </div>

    <?php endif; ?>


</nav>