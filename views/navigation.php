<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" href="#"><?php echo $config['title']; ?></a>

    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link <?php echo $_SERVER['SCRIPT_NAME'] === '/index.php' ? 'active' : ''; ?>" href="/index.php">Home</a>
        </li>

        <li class="nav-item">
            <?php if (isset($_SESSION['user'])) : ?>
                <a class="nav-link" href="/app/users/logout.php">Log out</a>
            <?php else : ?>
                <a class="nav-link <?php echo $_SERVER['SCRIPT_NAME'] === '/login.php' ? 'active' : ''; ?>" href="login.php">Log in</a>
            <?php endif; ?>
        </li>

        <li class="nav-item">
            <?php if (isset($_SESSION['user'])) : ?>
                <a class="nav-link" href="/account.php">Account</a>
            <?php else : ?>
                <a class="nav-link <?php echo $_SERVER['SCRIPT_NAME'] === '/signup.php' ? 'active' : ''; ?>" href="signup.php">Create account</a>
            <?php endif; ?>
        </li>


        <li class="nav-item">
            <?php if (isset($_SESSION['user'])) : ?>
                <a class="nav-link" href="/wunderlists.php">My Wunderlists</a>
            <?php else : ?>
                <a class="nav-link <?php echo $_SERVER['SCRIPT_NAME'] === '/about.php' ? 'active' : ''; ?>" href="/about.php">About</a>
            <?php endif; ?>
        </li>
    </ul>
</nav>