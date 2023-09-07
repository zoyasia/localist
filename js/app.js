src="https://code.jquery.com/jquery-3.6.0.min.js"

$(document).ready(function () {
    // Récupérez le paramètre GET 'category'
    var selectedCategory = "<?php echo isset($_GET['category']) ? $_GET['category'] : ''; ?>";

    // Parcourez les liens de catégorie et mettez à jour la classe 'active' en conséquence
    $(".nav-link").each(function () {
        if ($(this).attr("href").indexOf("?category=" + selectedCategory) !== -1) {
            $(this).addClass("active");
        }
    });
});

