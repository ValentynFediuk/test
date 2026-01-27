/* global gsap, ScrollTrigger */

window.addEventListener('load', () => {
    gsap.registerPlugin(ScrollTrigger);

    gsap.from(".card.mb-3", {
        duration: 0.6,
        opacity: 0,
        y: 50,
        stagger: 0.1,
        ease: "power3.out"
    });
});

const title = document.getElementById('dashboard-title');
const text = title.textContent;
title.textContent = '';
// wrap each character in span
text.split('').forEach(char => {
    const span = document.createElement('span');
    span.textContent = char;
    span.style.display = 'inline-block';
    title.appendChild(span);
});

window.addEventListener('load', () => {
    const letters = document.querySelectorAll("#dashboard-title span");

    // нескінченна хвиля
    gsap.to(letters, {
        y: "-=10",              // рух вгору
        rotation: 10,            // легке обертання
        duration: 0.6,
        ease: "sine.inOut",
        stagger: {
            each: 0.05,
            yoyo: true,
            repeat: -1
        }
    });

    // додатково: нескінченне світіння кольору
    gsap.to(letters, {
        color: "#ffd700",
        textShadow: "0 0 10px #ffd700, 0 0 20px #ff8c00",
        duration: 1.2,
        repeat: -1,
        yoyo: true,
        stagger: 0.05
    });
});

window.addEventListener('load', () => {
    const brand = document.getElementById("brand-logo");

    // нескінченна subtle хвиля
    gsap.to(brand, {
        y: "-=4",                // легке підняття
        rotation: 2,              // трішки обертаємо
        duration: 0.8,
        repeat: -1,               // infinity
        yoyo: true,
        ease: "sine.inOut"
    });

    // neon-glow ефект через shadow
    gsap.to(brand, {
        textShadow: "0 0 8px #00ffff, 0 0 12px #00bfff, 0 0 20px #1e90ff",
        duration: 1.5,
        repeat: -1,
        yoyo: true,
        ease: "sine.inOut"
    });
});

// gsap.js
// Регіструємо ScrollTrigger

window.addEventListener('load', () => {
    // Анімація нотаток при скролі
    gsap.utils.toArray('.card-body').forEach(card => {
        gsap.from(card, {
            opacity: 0,
            y: 50,
            duration: 0.8,
            ease: "power3.out",
            scrollTrigger: {
                trigger: card,
                start: "top 85%",
                toggleActions: "play none none none"
            }
        });
    });

    // Заголовок
    gsap.from("#dashboard-title", {
        y: -50,
        opacity: 0,
        duration: 1,
        ease: "power2.out",
        scrollTrigger: {
            trigger: "#dashboard-title",
            start: "top 90%",
            toggleActions: "play none none none"
        }
    });
});
