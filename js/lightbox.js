// Attendre que le DOM soit entièrement chargé avant d'exécuter le script
document.addEventListener('DOMContentLoaded', (event) => {
    // Obtenir les éléments de la lightbox et les boutons de contrôle
    const lightbox = document.getElementById('lightbox');
    const lightboxImg = document.getElementById('lightbox-image');
    const lightboxReference = document.getElementById('lightbox-reference');
    const lightboxCategory = document.getElementById('lightbox-category');
    const fullscreenIcons = document.querySelectorAll('.fullscreen-icon');
    const closeBtn = document.querySelector('.lightbox__close');
    const prevBtn = document.querySelector('.lightbox__prev');
    const nextBtn = document.querySelector('.lightbox__next');

    // Initialiser l'index de la photo courante et un tableau pour stocker les photos
    let currentIndex = 0;
    const photos = [];

    // Parcourir toutes les images de la galerie et les ajouter au tableau des photos
    document.querySelectorAll('#photo-item').forEach((item, index) => {
        const img = item.querySelector('img'); // Récupérer l'élément img
        const reference = item.querySelector('.photo-reference').innerText; // Récupérer la référence de la photo
        const category = item.querySelector('.photo-category').innerText; // Récupérer la catégorie de la photo
        const fullscreenIcon = item.querySelector('.fullscreen-icon'); // Récupérer l'icône plein écran

        // Ajouter l'URL de l'image, la référence et la catégorie au tableau des photos
        photos.push({ img: img.src, reference, category });

        // Ajouter un événement clic à l'icône plein écran pour ouvrir la lightbox
        fullscreenIcon.addEventListener('click', () => {
            currentIndex = index; // Mettre à jour l'index courant
            openLightbox(); // Ouvrir la lightbox
        });
    });
    document.querySelectorAll('.related-photo-thumbnail.photo-item').forEach((item, index) => {
        const img = item.querySelector('img'); // Récupérer l'élément img
        const reference = item.querySelector('.photo-reference').innerText; // Récupérer la référence de la photo
        const category = item.querySelector('.photo-category').innerText; // Récupérer la catégorie de la photo
        const fullscreenIcon = item.querySelector('.fullscreen-icon'); // Récupérer l'icône plein écran

        // Ajouter l'URL de l'image, la référence et la catégorie au tableau des photos
        photos.push({ img: img.src, reference, category });

        // Ajouter un événement clic à l'icône plein écran pour ouvrir la lightbox
        fullscreenIcon.addEventListener('click', () => {
            currentIndex = index; // Mettre à jour l'index courant
            openLightbox(); // Ouvrir la lightbox
        });
    });

    // Fonction pour ouvrir la lightbox et afficher la photo courante
    function openLightbox() {
        const photo = photos[currentIndex]; // Obtenir la photo courante
        lightboxImg.src = photo.img; // Mettre à jour l'image de la lightbox
        lightboxReference.textContent = `${photo.reference}`; // Mettre à jour la référence
        lightboxCategory.textContent = `${photo.category}`; // Mettre à jour la catégorie
        lightbox.style.display = 'block'; // Afficher la lightbox
    }

    // Fonction pour fermer la lightbox
    function closeLightbox() {
        lightbox.style.display = 'none'; // Masquer la lightbox
    }

    // Fonction pour afficher la photo précédente
    function showPrevPhoto() {
        currentIndex = (currentIndex - 1 + photos.length) % photos.length; // Décrémenter l'index en bouclant
        openLightbox(); // Ouvrir la lightbox avec la nouvelle photo
    }

    // Fonction pour afficher la photo suivante
    function showNextPhoto() {
        currentIndex = (currentIndex + 1) % photos.length; // Incrémenter l'index en bouclant
        openLightbox(); // Ouvrir la lightbox avec la nouvelle photo
    }

    // Ajouter un événement clic au bouton de fermeture pour fermer la lightbox
    closeBtn.addEventListener('click', closeLightbox);
    // Ajouter un événement clic au bouton précédent pour afficher la photo précédente
    prevBtn.addEventListener('click', showPrevPhoto);
    // Ajouter un événement clic au bouton suivant pour afficher la photo suivante
    nextBtn.addEventListener('click', showNextPhoto);

    // Fermer la lightbox si l'utilisateur clique en dehors de l'image
    lightbox.addEventListener('click', (e) => {
        if (e.target === lightbox) {
            closeLightbox(); // Fermer la lightbox
        }
    });

    // Ajouter des événements pour la navigation au clavier
    document.addEventListener('keydown', (e) => {
        if (lightbox.style.display === 'block') { // Vérifier si la lightbox est affichée
            if (e.key === 'ArrowLeft') { // Flèche gauche pour la photo précédente
                showPrevPhoto();
            } else if (e.key === 'ArrowRight') { // Flèche droite pour la photo suivante
                showNextPhoto();
            } else if (e.key === 'Escape') { // Échapper pour fermer la lightbox
                closeLightbox();
            }
        }
    });
});
