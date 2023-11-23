<!-- ======= Footer ======= -->
<footer class="footer">
	<div class="copyright">
		&copy; Copyright <strong><span>Bibliothèque AKAITSUKI 2023</span></strong>. All Rights Reserved
	</div>
</footer><!-- End Footer -->

<a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i
		class="bi bi-arrow-up-short"></i></a>

<!-- Vendor JS Files -->
<script src="<?= PROJECT_DIR; ?>public/vendor/apexcharts/apexcharts.min.js"></script>
<script src="<?= PROJECT_DIR; ?>public/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="<?= PROJECT_DIR; ?>public/vendor/chart.js/chart.umd.js"></script>
<script src="<?= PROJECT_DIR; ?>public/vendor/echarts/echarts.min.js"></script>
<script src="<?= PROJECT_DIR; ?>public/vendor/quill/quill.min.js"></script>
<script src="<?= PROJECT_DIR; ?>public/vendor/simple-datatables/simple-datatables.js"></script>
<script src="<?= PROJECT_DIR; ?>public/vendor/tinymce/tinymce.min.js"></script>
<script src="<?= PROJECT_DIR; ?>public/vendor/php-email-form/validate.js"></script>

<!-- Template Main JS File -->
<script src="<?= PROJECT_DIR; ?>public/js/main.js"></script>
<script src="<?= PROJECT_DIR; ?>public/select2/js/select2.full.js"></script>
<script>
    (function($) {
    $(document).ready(function() {
      //Initialize Select2 Elements
      $('.select2').select2()

      //Initialize Select2 Elements
      $('.select2bs4').select2({
        theme: 'bootstrap4'
      })
    });
  }(jQuery));
</script>
<script>

$(document).ready(function () {
    // Lorsque l'utilisateur tape dans le champ de recherche
    $("#searchInput").on("input", function () {
        // Récupérer la valeur du champ de recherche
        var query = $(this).val();

        // Effectuer une requête AJAX pour obtenir des suggestions
        $.ajax({
            type: "POST",
            url: "<?= PROJECT_DIR; ?>membre/domaine_ouvrage/traitement_suggestion",
            data: { query: query },
            dataType: 'json',
            success: function (data) {
                // Afficher les suggestions dans le conteneur dédié
                displaySuggestions(data);
            }
        });
    });

    // Fonction pour afficher les suggestions
    function displaySuggestions(suggestions) {
        var suggestionsContainer = $("#suggestionsContainer");
        suggestionsContainer.empty();

        // Afficher les suggestions dans le conteneur dédié
        if (suggestions.length > 0) {
            suggestions.forEach(function (suggestion) {
                var suggestionItem = $("<a href='#' class='list-group-item list-group-item-action'></a>").text(suggestion.titre);
                suggestionsContainer.append(suggestionItem);
            });
            suggestionsContainer.show();
        } else {
            var noSuggestionItem = $("<div class='list-group-item'>Aucune suggestion trouvée</div>");
            suggestionsContainer.append(noSuggestionItem);
            suggestionsContainer.show();
        }
    }

    // Gérer le clic sur une suggestion
    $(document).on("click", "#suggestionsContainer a", function () {
        // Récupérer le texte de la suggestion
        var suggestionText = $(this).text();

        // Remplir le champ de recherche avec la suggestion
        $("#searchInput").val(suggestionText);

        // Cacher les suggestions
        $("#suggestionsContainer").hide();
    });

    // Gérer le changement de focus sur le champ de recherche
    $("#searchInput").on("focusout", function () {
        // Cacher les suggestions après une courte pause pour gérer les clics sur les suggestions
        setTimeout(function () {
            $("#suggestionsContainer").hide();
        }, 200);
    });
});
</script>
<!-- Assurez-vous d'inclure jQuery avant ce script -->
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

<script>
    // Fonction pour mettre à jour le nombre d'articles dans le panier
    function updateCartItemCount() {
        var itemCount = <?= count($_SESSION['panier'] ?? []); ?>;
        $("#cartItemCount").text(itemCount);
    }

    // Mettez à jour le nombre d'articles lors du chargement de la page
    $(document).ready(function() {
        updateCartItemCount();
    });

    // Mettez à jour le nombre d'articles lorsqu'un article est ajouté ou retiré
    // Vous devrez appeler cette fonction après chaque modification du panier
    // par exemple, après l'ajout ou la suppression d'un article.
    function onCartItemChanged() {
        updateCartItemCount();
    }

    // Appeler la fonction pour mettre à jour le nombre d'articles dans le panier
    onCartItemChanged();
</script>


</body>

</html>