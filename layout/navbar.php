<nav class="landing-navbar">
    <div class="nav-logo">
        <a class="navbar-brand" href="/index.php">
            <img src="/assets/logo.png" alt="logo" class="logo">
            Localist
        </a>
    </div>
    <ul class="nav-list">
        <li><a href="index.php" class="nav-links">Accueil</a></li>
        <li><a href="about.php" class="nav-links">À propos</a></li>
        <?php if (isset($_SESSION['user_id'])) { ?>
            <li><a href="landing-page.php" class="nav-links">Mes adresses</a></li>
            <li><a href="newAddress.php" class="nav-links">Ajouter une adresse</a></li>
            <li><a href="profile.php" class="nav-links">Profil</a></li>
            <li><a href="logout.php" class="nav-links">Déconnexion</a></li>
        <?php } else { ?>
            <li><a href="login.php" class="nav-links">Connexion</a></li>
            <li><a href="register.php" class="nav-links">Inscription</a></li>
        <?php } ?>

    </ul>
</nav>