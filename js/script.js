console.log("le fichier modale.js fonctionne");

// code pour la modale contact

// Ouverture et fermeture de la modale de contact
document.addEventListener('DOMContentLoaded', function() {
    var modal = document.getElementById('contactModal');
    var links = document.querySelectorAll('.contactLink');
    var closeBtn = document.querySelector('.closeBtn');

    // Fonction pour récupérer la référence du chemin de l'URL
    function getReferenceFromURL() {
        var url = window.location.href;
        var regex = /\/photos\/[^\/]+\/([^\/]+)\/$/;
        var match = url.match(regex);
        if (match && match[1]) {
            console.log("Référence trouvée dans l'URL : " + match[1]); // Log pour vérifier la référence
            return match[1];
        }
        console.log("Aucune référence trouvée dans l'URL");
        return null;
    }

    // Ouvrir la modale
    links.forEach(function(link) {
        link.addEventListener('click', function(event) {
            event.preventDefault();
            event.stopPropagation();

            // Récupérer la référence de l'URL
            var reference = getReferenceFromURL();

            // Remplir automatiquement le champ "référence"
            var referenceField = document.getElementById('reference-photo');
            if (referenceField) {
                referenceField.value = reference;
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
