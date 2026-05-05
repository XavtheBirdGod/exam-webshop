document.addEventListener('DOMContentLoaded', () => {
    gsap.registerPlugin(ScrollTrigger);

    // Fade-in Reveal for all elements with .reveal class
    const reveals = document.querySelectorAll('.reveal');

    reveals.forEach((el) => {
        gsap.fromTo(el, 
            {
                opacity: 0,
                y: 40,
            },
            {
                scrollTrigger: {
                    trigger: el,
                    start: "top 85%",
                    toggleActions: "play none none none"
                },
                opacity: 1,
                y: 0,
                duration: 1.2,
                ease: "power3.out"
            }
        );
    });

    // Parallax effect for botanical images
    const images = document.querySelectorAll('img');
    images.forEach(img => {
        gsap.to(img, {
            scrollTrigger: {
                trigger: img,
                start: "top bottom",
                end: "bottom top",
                scrub: 1
            },
            y: -30,
            ease: "none"
        });
    });

    // Custom Cursor Interaction
    const cursor = document.querySelector('.custom-cursor');
    const interactiveElements = document.querySelectorAll('a, button, .group');

    interactiveElements.forEach(el => {
        el.addEventListener('mouseenter', () => {
            gsap.to(cursor, {
                scale: 4,
                backgroundColor: 'rgba(212, 165, 116, 0.1)',
                border: '1px solid #d4a574',
                duration: 0.3
            });
        });
        el.addEventListener('mouseleave', () => {
            gsap.to(cursor, {
                scale: 1,
                backgroundColor: '#d4a574',
                border: 'none',
                duration: 0.3
            });
        });
    });
});
