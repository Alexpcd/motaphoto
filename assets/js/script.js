console.log("le fichier modale.js fonctionne");

// code pour la modale contact

// Ouverture et fermeture de la modale de contact
document.addEventListener('DOMContentLoaded', function() {
    var modal = document.getElementById('contactModal');
    var links = document.querySelectorAll('.contactLink');
    var closeBtn = document.querySelector('.closeBtn');

// Fonction pour récupérer la référence du chemin de l'URL


// Ouvrir la modale
links.forEach(function(link) {
    link.addEventListener('click', function(event) {
        event.preventDefault();
        event.stopPropagation();

// Récupére l'attribut 'data-reference' de l'élément actuel
const reference = this.getAttribute('data-reference');

// Sélectionne le champ "REF. PHOTO" dans le formulaire de contact par l'attribut 'name'
const refPhotoField = document.querySelector('input[name="your-ref"]');

// Vérifie si la référence existe et si le champ est présent sur la page
if (reference && refPhotoField) {
// Pré-rempli le champ "REF. PHOTO" dans le formulaire de contact
refPhotoField.value = reference;

} else {

    console.log('Référence ou champ REF. PHOTO non trouvé');
}

            modal.classList.add('open');
        });
    });

    // Fermer la modale via la croix
    closeBtn.addEventListener('click', function(event) {
        event.stopPropagation();
        closeModal();
    });

    // Fermer la modale en cliquant en dehors de la modale
    document.addEventListener('click', function(event) {
        if (modal.classList.contains('open') && !modal.querySelector('.modale-global').contains(event.target)) {
            closeModal();
        }
    });

    // Empêcher la propagation des clics à l'intérieur de la modale
    modal.querySelector('.modale-global').addEventListener('click', function(event) {
        event.stopPropagation();
    });

    // Fonction pour fermer la modale
    function closeModal() {
        modal.classList.remove('open');
    }
});




// code pour la section single-photo

// Cible la flèche précédente
const prevArrow = document.querySelector('.post-navigation__previous-arrow');
if (prevArrow) {
    // Gestionnaire d'événements pour le survol de la souris
    prevArrow.addEventListener('mouseenter', function() {
        // Change l'opacité lors du survol
        const prevThumbnail = document.querySelector('.post-navigation__previous-thumbnail');
        if (prevThumbnail) {
            prevThumbnail.style.opacity = '1';
        }
    });

    // Gestionnaire d'événements pour le départ de la souris
    prevArrow.addEventListener('mouseleave', function() {
        // Remet l'opacité à 0 lorsque la souris quitte
        const prevThumbnail = document.querySelector('.post-navigation__previous-thumbnail');
        if (prevThumbnail) {
            prevThumbnail.style.opacity = '0';
        }
    });
}

// Cible la flèche suivante
const nextArrow = document.querySelector('.post-navigation__next-arrow');
if (nextArrow) {
    // Gestionnaire d'événements pour le survol de la souris
    nextArrow.addEventListener('mouseenter', function() {
        // Change l'opacité lors du survol
        const nextThumbnail = document.querySelector('.post-navigation__next-thumbnail');
        if (nextThumbnail) {
            nextThumbnail.style.opacity = '1';
        }
    });

    // Gestionnaire d'événements pour le départ de la souris
    nextArrow.addEventListener('mouseleave', function() {
        // Remet l'opacité à 0 lorsque la souris quitte
        const nextThumbnail = document.querySelector('.post-navigation__next-thumbnail');
        if (nextThumbnail) {
            nextThumbnail.style.opacity = '0';
        }
    });
}


// code pour le menu burger 

// Attendre que le DOM soit entièrement chargé avant d'exécuter le script
document.addEventListener('DOMContentLoaded', function() {
    // Sélectionner les éléments du DOM pour le menu burger
    const menuToggle = document.querySelector('.menu-toggle');
    const menuClose = document.querySelector('.menu-close');
    const primaryMenu = document.getElementById('menu-header');

    // Fonction pour basculer l'état du menu (ouvert ou fermé)
    function toggleMenu(expanded) {
        // Mettre à jour les attributs aria-expanded des boutons de menu
        menuToggle.setAttribute('aria-expanded', expanded);
        menuClose.setAttribute('aria-expanded', expanded);

        // Basculer la classe 'show' pour afficher/masquer le menu
        primaryMenu.classList.toggle('show', expanded);

        // Afficher ou masquer les boutons de menu en fonction de l'état
        menuClose.style.display = expanded ? 'block' : 'none';
        menuToggle.style.display = expanded ? 'none' : 'block';
    }

    // Ajouter un événement clic au bouton de menu (ouvrir)
    if (menuToggle) {
        menuToggle.addEventListener('click', function() {
            // Vérifier l'état actuel du menu (ouvert ou fermé)
            const expanded = this.getAttribute('aria-expanded') === 'true' || false;
            // Basculer l'état du menu
            toggleMenu(!expanded);
        });
    }

    // Ajouter un événement clic au bouton de fermeture du menu
    if (menuClose) {
        menuClose.addEventListener('click', function() {
            // Vérifier l'état actuel du menu (ouvert ou fermé)
            const expanded = this.getAttribute('aria-expanded') === 'true' || false;
            // Basculer l'état du menu
            toggleMenu(!expanded);
        });
    }

    // Ajouter un événement resize pour gérer l'affichage du menu en fonction de la largeur de la fenêtre
    window.addEventListener('resize', function() {
        if (window.innerWidth >= 768) { // Breakpoint pour passer en version desktop
            // En version desktop, masquer les boutons et fermer le menu
            menuClose.style.display = 'none';
            menuToggle.style.display = 'none';
            primaryMenu.classList.remove('show');
        } else {
            // En version mobile, afficher le bouton de menu et masquer le bouton de fermeture
            menuToggle.style.display = 'block';
            menuClose.style.display = 'none';
            primaryMenu.classList.remove('show');
        }
    });
});
