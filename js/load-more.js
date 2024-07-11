jQuery(document).ready(function ($) {
    let currentPage = 1;
  
    $("#load-more-button").on("click", function () {
      currentPage++; // Incrémentation de currentPage de 1, pour charger la page suivante
  
      $.ajax({
        type: "POST",
        url: ajax_object.ajax_url,
        dataType: "json",
        data: {
          action: "load_more_photos",
          paged: currentPage,
        },
        success: function (res) {
          $(".photo-list-container").append(res.html); // Ajoute le contenu à la galerie existante
  
          if (currentPage >= res.max) {
            $("#load-more-button").hide();
          }
        },
      });
    });
  });