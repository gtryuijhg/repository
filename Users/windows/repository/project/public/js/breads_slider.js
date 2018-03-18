'use strict';   // Mode strict du JavaScript

/***********************************************************************************/
/* ********************************* DONNEES SLIDER *****************************/
/***********************************************************************************/

// Liste des images.
var slides =
[
    { image: '../../public/pictures/ordinary_breads.jpg', legend: 'De gauche à droite : le pain, la déjeunette, la baguette courte, la ficelle et le pain parisien'},
    { image: '../../public/pictures/special_breads_1.jpg', legend: 'De gauche à droite : le pain moulé, la gustive, le pain batard et la boule'},
    { image: '../../public/pictures/special_breads_2.jpg', legend: 'De gauche à droite : la graine de champion et la tradition (baguette et pain batard) et le pain épi'}
];

// Objet contenant l'état du slider.
var state;



/***********************************************************************************/
/* ******************************** FONCTIONS SLIDER ****************************/
/***********************************************************************************/

function onSliderGoToNext()
{
    // Passage à la slide suivante.
    state.index++;

    // Est-ce qu'on est arrivé à la fin de la liste des slides ?
    if(state.index == slides.length)
    {
        // Oui, on revient au début (le slider est circulaire).
        state.index = 0;
    }

    // Mise à jour de l'affichage.
    refreshSlider();
}

function onSliderGoToPrevious()
{
    // Passage à la slide précédente.
    state.index--;

    // Est-ce qu'on est revenu au début de la liste des slides ?
    if(state.index < 0)
    {
        // Oui, on revient à la fin (le slider est circulaire).
        state.index = slides.length - 1;
    }

    // Mise à jour de l'affichage.
    refreshSlider();
}

function refreshSlider()
{
    var sliderImage;
    var sliderLegend;

    // Recherche des balises de contenu du slider.
    sliderImage  = document.querySelector('#slider img');
    sliderLegend = document.querySelector('#slider figcaption');

    // Changement de la source de l'image et du texte de la légende du slider.
    sliderImage.src          = slides[state.index].image;
    sliderLegend.textContent = slides[state.index].legend;
}

function installEventHandler(selector, type, eventHandler)
{
    var domObject;

    // Récupération du premier objet DOM correspondant au sélecteur.
    domObject = document.querySelector(selector);

    // Installation d'un gestionnaire d'évènement sur cet objet DOM.
    domObject.addEventListener(type, eventHandler);
}


/***********************************************************************************/
/* ******************************** CODE PRINCIPAL *********************************/
/***********************************************************************************/

/*
 * Installation d'un gestionnaire d'évènement déclenché quand l'arbre DOM sera
 * totalement construit par le navigateur.
 *
 * Le gestionnaire d'évènement est une fonction anonyme que l'on donne en deuxième
 * argument directement à document.addEventListener().
 */
document.addEventListener('DOMContentLoaded', function()
{
    // Initialisation du slider.
    state       = {};
    state.index = 0;                   // On commence à la première slide
    state.timer = null;                // Le slider est arrêté au démarrage


    // Installation des gestionnaires d'évènement.
    installEventHandler('#slider-previous', 'click', onSliderGoToPrevious);
    installEventHandler('#slider-next', 'click', onSliderGoToNext);


    // Affichage initial.
    refreshSlider();
});