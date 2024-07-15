// Attendre que le DOM soit entièrement chargé avant d'exécuter le script
jQuery(document).ready(function ($) {
  // Définir une variable pour suivre la page courante
  let currentPage = 1;

  // Ajouter un événement clic au bouton "Charger plus"
  $("#load-more-button").on("click", function () {
      // Incrémenter la variable currentPage de 1 pour charger la page suivante
      currentPage++;

      // Effectuer une requête AJAX pour charger plus de photos
      $.ajax({
          type: "POST", // Type de requête (POST)
          url: ajax_object.ajax_url, // URL de l'endpoint AJAX fourni par WordPress
          dataType: "json", // Type de données attendu en réponse
          data: {
              action: "load_more_photos", // Action spécifiée pour le traitement côté serveur
              paged: currentPage, // Page courante à charger
          },
          success: function (res) {
              // En cas de succès, ajouter le contenu récupéré à la galerie existante
              $(".photo-list-container").append(res.html);

              // Si la page courante est supérieure ou égale au nombre maximal de pages, masquer le bouton "Charger plus"
              if (currentPage >= res.max) {
                  $("#load-more-button").hide();
              }
          },
      });
  });
});
