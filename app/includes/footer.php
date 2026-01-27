<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.3/dist/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.13.0/gsap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.13.0/ScrollTrigger.min.js"></script>

<script>
    gsap.registerPlugin(ScrollTrigger);

    window.addEventListener('load', () => {
        const cards = gsap.utils.toArray('.card-body');

        // 1️⃣ Поява при скролі
        cards.forEach(card => {
            gsap.from(card.querySelectorAll('*'), {
                y: 30,
                opacity: 0,
                duration: 0.5,
                ease: "power1.out",
                stagger: 0.05,
                scrollTrigger: {
                    trigger: card,
                    start: "top 90%",
                    toggleActions: "play none none none"
                }
            });

            // 2️⃣ Hover ефект
            card.addEventListener('mouseenter', () => {
                gsap.to(card, {
                    y: -5,
                    boxShadow: "0 8px 20px rgba(0,0,0,0.4)",
                    duration: 0.3,
                    ease: "power1.out"
                });
            });

            card.addEventListener('mouseleave', () => {
                gsap.to(card, {
                    y: 0,
                    boxShadow: "0 4px 10px rgba(0,0,0,0.2)",
                    duration: 0.3,
                    ease: "power1.out"
                });
            });
        });

        // 3️⃣ Анімація при скролі в самий низ
        window.addEventListener('scroll', () => {
            const scrollTop = window.scrollY;
            const docHeight = document.documentElement.scrollHeight;
            const winHeight = window.innerHeight;

            if (scrollTop + winHeight >= docHeight - 1) { // доскролив до низу
                // трохи підкинути всі карточки вверх і назад
                gsap.to(cards, {
                    y: "-=10",
                    duration: 0.2,
                    ease: "power1.out",
                    yoyo: true,
                    repeat: 1
                });
            }
        });
    });




</script>
<script src="js/gsap.js"></script>
</body>
</html>