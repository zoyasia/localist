<nav class="landing-navbar">
    <div class="nav-logo">
        <img src="/assets/logo.png" alt="logo" class="logo">
    </div>
    <ul class="nav-list">
        <li><a href="about.php" class="nav-links">A propos</a></li>
        <?php if (isset($_SESSION['user_id'])) { ?>
        <li><a href="newAddress.php" class="nav-links">Ajouter une adresse</a></li>
        <li><a href="#" class="nav-links">Profil</a></li>
        <li><a href="logout.php" class="nav-links">Déconnexion</a></li>            
        <?php } else { ?>
            <li><a href="login.php" class="nav-links">Connexion</a></li>
            <li><a href="register.php" class="nav-links">Inscription</a></li>
        <?php } ?>

    </ul>
</nav>