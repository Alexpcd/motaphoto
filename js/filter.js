jQuery(document).ready(function ($) {

// Filtre Catégorie 

$(".category-select").click(function () {
    let isOpen = $(this).toggleClass("open").hasClass("open");

    if (isOpen) {
        $(".category-select li:first-child").html('Catégories <i class="fas fa-chevron-down category-chevron"></i>');
    }

    $(".category-chevron").toggleClass("category-chevron-rotate", isOpen);
    $(".category").toggleClass("category-active", isOpen);
});

$(".category-list").click(function () {
    let selected_li = $(this).html();
    $(".category-select li:first-child").html(selected_li + ' <i class="fas fa-chevron-down"></i>');
    $(".category-list").removeClass("category-li-focus");
    $(this).addClass("category-li-focus");
});

// Filtre Format

$(".format-select").click(function () {
    let isOpen = $(this).toggleClass("open").hasClass("open");

    if (isOpen) {
        $(".format-select li:first-child").html('Formats <i class="fas fa-chevron-down format-chevron"></i>');
    }

    $(".format-chevron").toggleClass("format-chevron-rotate", isOpen);
    $(".format").toggleClass("format-active", isOpen);
});

$(".format-list").click(function () {
    let selected_li_format = jQuery(this).html();
    $(".format-select li:first-child").html(selected_li_format + ' <i class="fas fa-chevron-down"></i>');
    $(".format-list").removeClass("format-li-focus");
    $(this).addClass("format-li-focus");
});

// Filtre Trier par  

$(".date-select").click(function () {
    let isOpen = $(this).toggleClass("open").hasClass("open");

    if (isOpen) {
        $(".date-select li:first-child").html('Trier par <i class="fas fa-chevron-down sort-by-chevron"></i>');
    }

    $(".sort-by-chevron").toggleClass("sort-by-chevron-rotate", isOpen);
    $(".sort-by").toggleClass("sort-by-active", isOpen);
});

$(".sort-by-list").click(function () {
    let selected_li_date = $(this).html();
    $(".date-select li:first-child").html(selected_li_date + ' <i class="fas fa-chevron-down"></i>');
    $(".sort-by-list").removeClass("sort-by-li-focus");
    $(this).addClass("sort-by-li-focus");
});

// Script Filtre

// Définir les variables pour stocker les filtres sélectionnés par l'utilisateur
let selectedCategory = null;
let selectedFormat = null;
let selectedSortBy = "DESC";

// Fonction pour appliquer la sélection des filtres
const applyOptionSelection = () => {
    // Efface le contenu actuel du conteneur de la liste de photos
    document.getElementById("photo-list-container").innerHTML = "";
    // Récupère les photos filtrées et les affiche
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
            // En cas de succès, ajoute la réponse (photos filtrées) au conteneur de la liste de photos
            $("#photo-list-container").append(response);
        },
        error: error => {
            // En cas d'erreur, affiche le message d'erreur dans la console
            console.log(error.statusText);
        },
    });
};

// Fonction pour gérer le clic sur une option de filtre
const handleOptionClick = (optionClass, optionVariable) => {
    $(optionClass).click(function () {
        // Récupère la valeur de l'option sélectionnée
        const optionValue = $(this).attr("data-value");

        // Met à jour la variable correspondante en fonction de l'option sélectionnée
        if (optionVariable === "selectedCategory") {
            selectedCategory = optionValue;
        } else if (optionVariable === "selectedFormat") {
            selectedFormat = optionValue;
        } else if (optionVariable === "selectedSortBy") {
            selectedSortBy = optionValue;
        }

        // Applique la sélection des filtres et met à jour la liste des photos
        applyOptionSelection();
    });
};

// Attache les gestionnaires de clics aux options de filtres
handleOptionClick(".category-list", "selectedCategory");
handleOptionClick(".format-list", "selectedFormat");
handleOptionClick(".sort-by-list", "selectedSortBy");
});