import { gsap } from "gsap";
import { ScrollTrigger } from "gsap/ScrollTrigger";

// On active le plugin
gsap.registerPlugin(ScrollTrigger);


document.addEventListener("DOMContentLoaded", () => {
    gsap.from(".header", {y:-100, duration:1})

    gsap.to(".cta-btn", {
        scale: 1.05,
        repeat: -1,
        yoyo: true,
        duration: 1.2,
        ease: "power1.inOut"
    });

    // Animation des sneakers
    gsap.from(".sneaker-item", {
    scrollTrigger: {
        trigger: ".collections",
        start: "top 80%",   // déclenche quand le haut de la section atteint 80% de l’écran
        toggleActions: "play none none reset"
    },
    y: 100,             // vient du bas
    opacity: 0,         // commence transparent
    duration: 1,
    stagger: 0.2,       // décalage entre chaque élément
    ease: "power3.out"
    });

    // Animation des 2 grids qui se rencontrent au centre
    gsap.fromTo(".grid-left", 
    { x: "-100%", opacity: 0 },  // départ hors écran à gauche
    { 
        x: "0%", 
        opacity: 1,
        duration: 1.5,
        scrollTrigger: {
        trigger: ".collections-two",
        start: "top 80%", // quand la section entre dans le viewport
        end: "top 30%",
        scrub: true, // synchro avec le scroll
        }
    }
    );

    gsap.fromTo(".grid-right", 
    { x: "100%", opacity: 0 },  // départ hors écran à droite
    { 
        x: "0%", 
        opacity: 1,
        duration: 1.5,
        scrollTrigger: {
        trigger: ".collections-two",
        start: "top 80%",
        end: "top 30%",
        scrub: true,
        }
    }
);

    let tl = gsap.timeline();

    tl.from(".hero-title", { y: -50, opacity: 0, duration: 1, ease: "power3.out" })
      .from(".hero-subtitle", { y: 30, opacity: 0, duration: 1 }, "-=0.5")
      .from(".hero-btn", { scale: 0, opacity: 0, duration: 0.5, ease: "back.out(1.7)" }, "-=0.3");


    //   Titres et paragraphes
    gsap.utils.toArray(".fade-up").forEach((el) => {
        gsap.from(el, {
          scrollTrigger: {
            trigger: el,
            start: "top 85%", // déclenche quand l’élément entre dans le viewport
            toggleActions: "play none none reverse",
          },
          y: 50,        // monte depuis le bas
          opacity: 0,   // commence invisible
          duration: 1,
          ease: "power2.out",
        });
      });
});