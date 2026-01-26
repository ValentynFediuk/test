    const btn = document.getElementById('btn');
    btn.addEventListener('click', () => {
    gsap.to(btn, {duration: 0.5, scale: 1.5, ease: "elastic.out(1, 0.5)"});
    gsap.to(btn, {duration: 0.5, scale: 1, delay: 0.5});
});
