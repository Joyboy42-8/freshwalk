import './bootstrap';

import Alpine from 'alpinejs';
import { gsap } from "gsap";
import { ScrollTrigger } from "gsap/ScrollTrigger";

window.Alpine = Alpine;

Alpine.start();

// On active le plugin
gsap.registerPlugin(ScrollTrigger);

document.addEventListener("DOMContentLoaded", () => {
    let tl = gsap.timeline({
        scrollTrigger: {
            trigger: ".shoes-section", // la section qui déclenche
            start: "top 80%", // déclenche quand le haut de la section arrive à 80% de la fenêtre
            end: "bottom 20%", // se termine quand le bas arrive à 20%
            scrub: true, // l’animation suit le scroll
            markers: false, // mets true si tu veux voir les repères
        },
    });

    // une chaussure vient du haut
    tl.from(".shoe-top", { x:-100, opacity: 0, duration: 1 }, "-=0.5")
        // une autre vient de la gauche
        .from(".shoe-left", { x: -200, opacity: 0, duration: 1 })
        // une autre vient de la droite
        .from(".shoe-right", { x: 200, opacity: 0, duration: 1 }, "-=0.5")
        // une vient du bas
        .from(".shoe-bottom", { y: 200, opacity: 0, duration: 1 }, "-=0.5")
        //   Cards et Titre
        .from(".up", { y: 200, opacity:0, duration: 1 });
});
