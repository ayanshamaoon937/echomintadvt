// main.js

// Testimonial Slider
document.addEventListener("DOMContentLoaded", () => {
    const testimonialSwiper = new Swiper(".testimonial-slider", {
        slidesPerView: 1,
        centeredSlides: false,
        loop: true,
        spaceBetween: 20,
        autoplay: false,
        navigation: {
            nextEl: "#testimonial-slider-next",
            prevEl: "#testimonial-slider-prev",
        },
        breakpoints: {
            2300: { slidesPerView: 3, spaceBetween: 20 }, // above 1440px
            1700: { slidesPerView: 3, spaceBetween: 20 }, // above 1440px
            1024: { slidesPerView: 3, spaceBetween: 20 }, // tablets & medium screens
            767:  { slidesPerView: 2, spaceBetween: 20 }, // small tablets
            390:  { slidesPerView: 1,   spaceBetween: 20 }, // mobiles
        },
    });
});

// How It Works Slider
document.addEventListener("DOMContentLoaded", () => {
    const swiper = new Swiper(".how-it-works-slider", {
        slidesPerView: 1,
        centeredSlides: false,
        loop: true,
        navigation: {
            nextEl: "#next",
            prevEl: "#prev",
        },
        breakpoints: {
            1440: {
                slidesPerView: 4.4,
                spaceBetween: 20,
            },
            767: {
                slidesPerView: 3,
            },
            390: {
                slidesPerView: 1.5,
            },
        }
    });
});

// General Section One Animation
document.addEventListener("DOMContentLoaded", () => {
    gsap.registerPlugin(ScrollTrigger);

    let tl = gsap.timeline({
        scrollTrigger: {
            trigger: ".general-section-one",
            start: "top 70%",
            toggleActions: "restart none restart none"
        }
    });

    tl.from(".general-section-one .image img[src*='mac-1.png']", {
        opacity: 0,
        scale: 0.9,
        duration: 1,
        ease: "power2.out"
    })
        .from(".general-section-one .image .mobile-image img", {
            x: 150,
            opacity: 0,
            duration: 1,
            ease: "power2.out"
        }, "-=0.5")
        .from(".general-section-one .info-card.two", {
            x: 150,
            opacity: 0,
            duration: 1,
            ease: "power2.out"
        }, "-=0.5")
        .from(".general-section-one .info-card.one", {
            x: -150,
            opacity: 0,
            duration: 1,
            ease: "power2.out"
        }, "-=0.5")
        .from(".general-section-one .info-card.three", {
            x: -150,
            opacity: 0,
            duration: 1,
            ease: "power2.out"
        }, "-=0.5");
});

// General Section Three Animation
document.addEventListener("DOMContentLoaded", () => {
    if (typeof gsap === "undefined" || typeof ScrollTrigger === "undefined") {
        console.error("GSAP or ScrollTrigger not found.");
        return;
    }

    gsap.registerPlugin(ScrollTrigger);

    const colNodes = Array.from(document.querySelectorAll(".general-section-three .row > .col-lg-4"));
    const leftCol = colNodes[0];
    const centerCol = colNodes[1];
    const rightCol = colNodes[2];

    const getVisibleImage = (container) => {
        if (!container) return null;
        const imgs = Array.from(container.querySelectorAll("img"));
        return imgs.find(img => img.offsetParent !== null) || imgs[0] || null;
    };

    const centerImg = getVisibleImage(centerCol && centerCol.querySelector(".image"));

    const tl = gsap.timeline({
        scrollTrigger: {
            trigger: ".general-section-three",
            start: "top 70%",
            toggleActions: "play none none reverse"
        }
    });

    if (leftCol) {
        const leftCards = leftCol.querySelectorAll(".content-card");
        if (leftCards.length) {
            tl.from(leftCards, {
                x: -150,
                opacity: 0,
                duration: 1,
                ease: "power2.out",
                stagger: 0.25
            });
        }
    }

    if (centerImg) {
        tl.from(centerImg, {
            scale: 0,
            opacity: 0,
            duration: 1.1,
            ease: "back.out(1.4)"
        }, "-=0.6");
    }

    if (rightCol) {
        const rightCards = rightCol.querySelectorAll(".content-card");
        if (rightCards.length) {
            tl.from(rightCards, {
                x: 150,
                opacity: 0,
                duration: 1,
                ease: "power2.out",
                stagger: 0.25
            }, "-=0.9");
        }
    }
});

// CTA Animation
document.addEventListener("DOMContentLoaded", () => {
    gsap.registerPlugin(ScrollTrigger);

    gsap.from(".cta .content", {
        scale: 0,
        opacity: 0,
        duration: 1,
        ease: "back.out(1.2)",
        scrollTrigger: {
            trigger: ".cta",
            start: "top 80%",
            toggleActions: "play none none reverse"
        }
    });
});

// General Section Four Animation
document.addEventListener("DOMContentLoaded", () => {
    gsap.registerPlugin(ScrollTrigger);

    gsap.from(".general-section-four .card-content", {
        y: 100,
        opacity: 0,
        duration: 0.8,
        ease: "power3.out",
        stagger: 0.3,
        scrollTrigger: {
            trigger: ".general-section-four",
            start: "top 80%",
            toggleActions: "play none none reverse"
        }
    });
});
