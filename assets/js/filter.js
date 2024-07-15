// Attendre que le DOM soit entièrement chargé avant d'exécuter le script
jQuery(document).ready(function ($) {

    // Filtre Catégorie

    // Ajouter un événement clic au sélecteur de catégorie
    $(".category-select").click(function () {
        // Basculer la classe "open" et vérifier si elle est active
        let isOpen = $(this).toggleClass("open").hasClass("open");

        // Si le menu est ouvert, mettre à jour le texte du premier élément de la liste
        if (isOpen) {
            $(".category-select li:first-child").html('Catégories <i class="fas fa-chevron-down category-chevron"></i>');
        }

        // Basculer la rotation de l'icône et l'état actif de la catégorie
        $(".category-chevron").toggleClass("category-chevron-rotate", isOpen);
        $(".category").toggleClass("category-active", isOpen);
    });

    // Ajouter un événement clic aux éléments de la liste des catégories
    $(".category-list").click(function () {
        // Récupérer le contenu HTML de l'élément cliqué
        let selected_li = $(this).html();
        // Mettre à jour le texte du premier élément de la liste avec l'élément sélectionné
        $(".category-select li:first-child").html(selected_li + ' <i class="fas fa-chevron-down"></i>');
        // Supprimer la classe de mise en surbrillance des autres éléments
        $(".category-list").removeClass("category-li-focus");
        // Ajouter la classe de mise en surbrillance à l'élément cliqué
        $(this).addClass("category-li-focus");
    });

    // Filtre Format

    // Ajouter un événement clic au sélecteur de format
    $(".format-select").click(function () {
        // Basculer la classe "open" et vérifier si elle est active
        let isOpen = $(this).toggleClass("open").hasClass("open");

        // Si le menu est ouvert, mettre à jour le texte du premier élément de la liste
        if (isOpen) {
            $(".format-select li:first-child").html('Formats <i class="fas fa-chevron-down format-chevron"></i>');
        }

        // Basculer la rotation de l'icône et l'état actif du format
        $(".format-chevron").toggleClass("format-chevron-rotate", isOpen);
        $(".format").toggleClass("format-active", isOpen);
    });

    // Ajouter un événement clic aux éléments de la liste des formats
    $(".format-list").click(function () {
        // Récupérer le contenu HTML de l'élément cliqué
        let selected_li_format = jQuery(this).html();
        // Mettre à jour le texte du premier élément de la liste avec l'élément sélectionné
        $(".format-select li:first-child").html(selected_li_format + ' <i class="fas fa-chevron-down"></i>');
        // Supprimer la classe de mise en surbrillance des autres éléments
        $(".format-list").removeClass("format-li-focus");
        // Ajouter la classe de mise en surbrillance à l'élément cliqué
        $(this).addClass("format-li-focus");
    });

    // Filtre Trier par  

    // Ajouter un événement clic au sélecteur de tri
    $(".date-select").click(function () {
        // Basculer la classe "open" et vérifier si elle est active
        let isOpen = $(this).toggleClass("open").hasClass("open");

        // Si le menu est ouvert, mettre à jour le texte du premier élément de la liste
        if (isOpen) {
            $(".date-select li:first-child").html('Trier par <i class="fas fa-chevron-down sort-by-chevron"></i>');
        }

        // Basculer la rotation de l'icône et l'état actif du tri
        $(".sort-by-chevron").toggleClass("sort-by-chevron-rotate", isOpen);
        $(".sort-by").toggleClass("sort-by-active", isOpen);
    });

    // Ajouter un événement clic aux éléments de la liste de tri
    $(".sort-by-list").click(function () {
        // Récupérer le contenu HTML de l'élément cliqué
        let selected_li_date = $(this).html();
        // Mettre à jour le texte du premier élément de la liste avec l'élément sélectionné
        $(".date-select li:first-child").html(selected_li_date + ' <i class="fas fa-chevron-down"></i>');
        // Supprimer la classe de mise en surbrillance des autres éléments
        $(".sort-by-list").removeClass("sort-by-li-focus");
        // Ajouter la classe de mise en surbrillance à l'élément cliqué
        $(this).addClass("sort-by-li-focus");
    });

    // Script Filtre

    // Définir les variables pour stocker les filtres sélectionnés par l'utilisateur
    let selectedCategory = null;
    let selectedFormat = null;
    let selectedSortBy = "DESC";

    // Fonction pour appliquer la sélection des filtres
    const applyOptionSelection = () => {
        // Effacer le contenu actuel du conteneur de la liste de photos
        document.getElementById("photo-list-container").innerHTML = "";
        // Récupérer les photos filtrées et les afficher
        fetchFilteredPhotos(selectedCategory, selectedFormat, selectedSortBy);
    };

    // Fonction pour récupérer les photos filtrées en fonction des critères sélectionnés
    const fetchFilteredPhotos = () => {
        $.ajax({
            type: "POST", // Type de requête (POST)
            url: "wp-admin/admin-ajax.php", // URL de l'endpoint de l'API
            dataType: "html", // Type de données attendu en réponse
            data: {
                action: "filter_and_sort_photos", // Action spécifiée pour le traitement côté serveur
                categorie: selectedCategory,      // Catégorie sélectionnée
                format: selectedFormat,            // Format sélectionné
                date: selectedSortBy,              // Ordre de tri sélectionné
            },
            success: response => {
                // En cas de succès, ajouter la réponse (photos filtrées) au conteneur de la liste de photos
                $("#photo-list-container").append(response);
            },
            error: error => {
                // En cas d'erreur, afficher le message d'erreur dans la console
                console.log(error.statusText);
            },
        });
    };

    // Fonction pour gérer le clic sur une option de filtre
    const handleOptionClick = (optionClass, optionVariable) => {
        $(optionClass).click(function () {
            // Récupérer la valeur de l'option sélectionnée
            const optionValue = $(this).attr("data-value");

            // Mettre à jour la variable correspondante en fonction de l'option sélectionnée
            if (optionVariable === "selectedCategory") {
                selectedCategory = optionValue;
            } else if (optionVariable === "selectedFormat") {
                selectedFormat = optionValue;
            } else if (optionVariable === "selectedSortBy") {
                selectedSortBy = optionValue;
            }

            // Appliquer la sélection des filtres et mettre à jour la liste des photos
            applyOptionSelection();
        });
    };

    // Attacher les gestionnaires de clics aux options de filtres
    handleOptionClick(".category-list", "selectedCategory");
    handleOptionClick(".format-list", "selectedFormat");
    handleOptionClick(".sort-by-list", "selectedSortBy");
});
