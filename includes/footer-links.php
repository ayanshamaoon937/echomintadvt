<!-- JS Libraries -->
<script src="assets/js/jquery-3.7.1.js"></script>
<script src="assets/js/popper.min.js"></script>
<script src="assets/js/bootstrap.min.js"></script>
<script src="assets/js/swiper-bundle.min.js"></script>

<!-- Project Scripts -->
<script src="assets/js/main.js"></script>

<!-- Offcanvas Body Scroll Control -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    const offcanvasElement = document.getElementById('mobileNav');
    
    if (offcanvasElement) {
        // Add class when offcanvas is shown
        offcanvasElement.addEventListener('show.bs.offcanvas', function() {
            document.body.classList.add('offcanvas-open');
        });
        
        // Remove class when offcanvas is hidden
        offcanvasElement.addEventListener('hide.bs.offcanvas', function() {
            document.body.classList.remove('offcanvas-open');
        });
        
        // Fallback: remove class when offcanvas is completely hidden
        offcanvasElement.addEventListener('hidden.bs.offcanvas', function() {
            document.body.classList.remove('offcanvas-open');
        });
    }
});
</script>
<script>
document.addEventListener("DOMContentLoaded", () => {
    const testimonialSwiper = new Swiper(".testimonial-slider", {
        slidesPerView: 1,
        centeredSlides: false,
        loop: true,
        speed: 800, // transition speed in milliseconds
        autoplay: {
            delay: 5000, // 5 seconds between slides
            disableOnInteraction: false,
        },
        navigation: {
            nextEl: "#testimonial-slider-next",
            prevEl: "#testimonial-slider-prev",
        },
        breakpoints: {
            2300: { slidesPerView: 2, spaceBetween: 20 },
            1700: { slidesPerView: 2, spaceBetween: 20 },
            1024: { slidesPerView: 2, spaceBetween: 20 },
            767:  { slidesPerView: 2, spaceBetween: 20 },
            390:  { slidesPerView: 1, spaceBetween: 20 },
        },
    });
});


 </script>
<script>
    const heroSwiper = new Swiper(".hero-swiper", {
        loop: true,
        autoplay: {
            delay: 3000,
            disableOnInteraction: false,
        },
        effect: "fade",
        speed: 1000,
    });
</script>
<script>
    const aboutSwiper = new Swiper('.about-swiper', {
        loop: true,
        spaceBetween: 20,
        autoplay: {
            delay: 3000,
            disableOnInteraction: false,
        },
        // Removed pagination & navigation
        breakpoints: {
            0: {
                slidesPerView: 1, // Mobile
            },
            768: {
                slidesPerView: 2, // Tablets
            },
            992: {
                slidesPerView: 3, // Desktop
            },
        },
    });
</script>
<script>
    document.addEventListener("DOMContentLoaded", () => {
        const swiper = new Swiper(".foundation-slider", {
            slidesPerView: 1,
            centeredSlides: false,
            spaceBetween: 20,
            loop: true,
            autoplay: {
                delay: 3000,
                disableOnInteraction: false,
            },
            navigation: {
                nextEl: "#next",
                prevEl: "#prev",
            },
            breakpoints: {
                1440: { slidesPerView: 4 },
                1200: { slidesPerView: 3 },
                767: { slidesPerView: 2 },
                390: { slidesPerView: 1 },
            },
        });
    });
</script>


<?php if (basename($_SERVER['PHP_SELF']) === 'contact.php'): ?>
<script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
<script src="assets/js/contact.js"></script>
<?php endif; ?>



<script src="assets/js/gsap.min.js"></script>
<script src="assets/js/ScrollTrigger.min.js"></script>

<script>
    window.addEventListener("load", () => {
        gsap.registerPlugin(ScrollTrigger);

        const section = document.querySelector(".contact-us-wrapper");
        
        // Only run animation if the section exists
        if (section) {
            // Animate when the section enters the viewport
            const tl = gsap.timeline({
                scrollTrigger: {
                    trigger: section,
                    start: "top 80%", // when section is 80% visible
                    end: "bottom 20%", // end near bottom
                    toggleActions: "play none none reverse", // play once, reverse when leaving
                    markers: false, // set to true for debugging
                },
            });

            // Hero content (subtitle, h1, and paragraph)
            tl.from(".contact-us-wrapper .hero-content .subtitle", {
                opacity: 0,
                y: 30,
                duration: 0.5,
                ease: "power2.out",
            })
                .from(".contact-us-wrapper .hero-content h1", {
                    opacity: 0,
                    y: 40,
                    duration: 0.6,
                    ease: "power2.out",
                }, "-=0.3")
                .from(".contact-us-wrapper .hero-content p", {
                    opacity: 0,
                    y: 40,
                    duration: 0.6,
                    ease: "power2.out",
                }, "-=0.3");

            // Map and form cards
            tl.from(".contact-us-wrapper .map-card", {
                opacity: 0,
                x: -50,
                duration: 0.8,
                ease: "power2.out",
            }, "-=0.2")
                .from(".contact-us-wrapper .form", {
                    opacity: 0,
                    x: 50,
                    duration: 0.8,
                    ease: "power2.out",
                }, "-=0.6");
        }
    });
</script>
<script>
    window.addEventListener("load", () => {
        gsap.registerPlugin(ScrollTrigger);

        const heroSection = document.querySelector(".secondary-hero");

        // Only run animation if the section exists
        if (heroSection) {
            // Timeline for hero content animation
            const tl = gsap.timeline({
                scrollTrigger: {
                    trigger: heroSection,
                    start: "top 80%", // when section enters 80% of viewport
                    end: "bottom 20%",
                    toggleActions: "play none none reverse", // play when in view, reverse on leave
                    markers: false // set to true to debug
                }
            });

            // Animate subtitle, h1, and paragraph sequentially
            tl.from(".secondary-hero .content .subtitle", {
                opacity: 0,
                y: 30,
                duration: 0.5,
                ease: "power2.out"
            })
                .from(".secondary-hero .content h1", {
                    opacity: 0,
                    y: 40,
                    duration: 0.6,
                    ease: "power2.out"
                }, "-=0.3")
                .from(".secondary-hero .content p", {
                    opacity: 0,
                    y: 40,
                    duration: 0.6,
                    ease: "power2.out"
                }, "-=0.3");
        }
    });
</script>
<script>
    window.addEventListener("load", () => {
        gsap.registerPlugin(ScrollTrigger);

        const aboutSection = document.querySelector(".about-wrapper");

        // Only run animation if the section exists
        if (aboutSection) {
            const tl = gsap.timeline({
                scrollTrigger: {
                    trigger: aboutSection,
                    start: "top 80%",
                    end: "bottom 20%",
                    toggleActions: "play none none reverse",
                    markers: false
                }
            });

        // Animate left column title and heading
        tl.from(".about-wrapper .col-lg-6:first-child .subtitle", {
            opacity: 0,
            y: 30,
            duration: 0.5,
            ease: "power2.out"
        })
            .from(".about-wrapper .col-lg-6:first-child h2", {
                opacity: 0,
                y: 40,
                duration: 0.6,
                ease: "power2.out"
            }, "-=0.3");

        // Animate right column paragraphs
        tl.from(".about-wrapper .col-lg-6:last-child p", {
            opacity: 0,
            y: 20,
            duration: 0.5,
            stagger: 0.15,
            ease: "power2.out"
        }, "-=0.2");

        // ✅ Button animation (no transform, safe for hover)
        tl.from(".about-wrapper .col-lg-6:last-child a.btn", {
            opacity: 0,
            y: 25,                // slide up effect
            duration: 0.6,
            ease: "power2.out",
            clearProps: "all"     // removes inline styles after animation
        }, "-=0.3");

        // Quote box animation
        tl.from(".about-wrapper .bg-dark-100", {
            opacity: 0,
            x: -60,
            duration: 0.8,
            ease: "power2.out"
        }, "-=0.2");

            // Image slider animation
            tl.from(".about-wrapper .about-swiper", {
                opacity: 0,
                x: 60,
                duration: 0.8,
                ease: "power2.out"
            }, "-=0.6");
        }
    });
</script>
<script>
    window.addEventListener("load", () => {
        gsap.registerPlugin(ScrollTrigger);

        const valuesSection = document.querySelector(".our-values");

        // Only run animation if the section exists
        if (valuesSection) {
            const tl = gsap.timeline({
                scrollTrigger: {
                    trigger: valuesSection,
                    start: "top 80%",
                    end: "bottom 10%",
                    toggleActions: "play none none reverse",
                    markers: false
                }
            });

        // Animate subtitle, heading, and paragraph
        tl.from(".our-values .subtitle", {
            opacity: 0,
            y: 30,
            duration: 0.5,
            ease: "power2.out"
        })
            .from(".our-values h2", {
                opacity: 0,
                y: 40,
                duration: 0.6,
                ease: "power2.out"
            }, "-=0.3")
            .from(".our-values p.font-geist", {
                opacity: 0,
                y: 25,
                duration: 0.6,
                ease: "power2.out"
            }, "-=0.3");

        // 🎬 Left column cards (slide from left)
        tl.from(".our-values .col-lg-3:first-child .content-card", {
            opacity: 0,
            x: -60,
            duration: 0.6,
            stagger: 0.2,
            ease: "power2.out"
        }, "-=0.2");

        // 🖼️ Center image (same as before)
        tl.from(".our-values .image img", {
            opacity: 0,
            scale: 0.9,
            duration: 0.8,
            ease: "power2.out"
        }, "-=0.4");

        // 🎬 Right column cards (slide from right)
        tl.from(".our-values .col-lg-3:last-child .content-card", {
            opacity: 0,
            x: 60,
            duration: 0.6,
            stagger: 0.2,
            ease: "power2.out"
        }, "-=0.5");

            // ✅ Button animation (fade + upward motion, hover safe)
            tl.from(".our-values a.btn", {
                opacity: 0,
                y: 30,
                duration: 0.6,
                ease: "power2.out",
                clearProps: "all"
            }, "-=0.3");
        }
    });
</script>


<script>
    document.addEventListener("DOMContentLoaded", function () {
        gsap.registerPlugin(ScrollTrigger);

        const missionSection = document.querySelector(".our-mission-vission.first");
        
        // Only run animation if the section exists
        if (missionSection) {
            // Animation for Our Mission Section (.our-mission-vission.first)
            const tlMission = gsap.timeline({
                scrollTrigger: {
                    trigger: ".our-mission-vission.first",
                    start: "top 80%",  // starts when section is near viewport
                    end: "bottom 60%",
                    toggleActions: "play none none reverse",
                    once: true // play only once
                }
            });

        tlMission
            .from(".our-mission-vission.first .subtitle", {
                opacity: 0,
                y: 40,
                duration: 0.6,
                ease: "power2.out",
            })
            .from(".our-mission-vission.first h2", {
                opacity: 0,
                y: 40,
                duration: 0.6,
                ease: "power2.out",
            }, "-=0.3")
            .from(".our-mission-vission.first p", {
                opacity: 0,
                y: 40,
                duration: 0.6,
                stagger: 0.2,
                ease: "power2.out",
            }, "-=0.3")
                .from(".our-mission-vission.first .image img", {
                    opacity: 0,
                    scale: 0.9,
                    duration: 0.8,
                    ease: "power2.out",
                }, "-=0.4");
        }
    });
</script>
<script>
    document.addEventListener("DOMContentLoaded", function () {
        gsap.registerPlugin(ScrollTrigger);

        const visionSection = document.querySelector(".our-mission-vission.second");
        
        // Only run animation if the section exists
        if (visionSection) {
            // Animation for Our Vision Section (.our-mission-vission.second)
            const tlVision = gsap.timeline({
                scrollTrigger: {
                    trigger: ".our-mission-vission.second",
                    start: "top 80%",  // when the section enters the viewport
                    end: "bottom 60%",
                    toggleActions: "play none none reverse",
                    once: true
                }
            });

        tlVision
            .from(".our-mission-vission.second .image img", {
                opacity: 0,
                x: -60, // slide in from left
                duration: 0.8,
                ease: "power2.out",
            })
            .from(".our-mission-vission.second .subtitle", {
                opacity: 0,
                x: 40, // slide in from right
                duration: 0.6,
                ease: "power2.out",
            }, "-=0.4")
            .from(".our-mission-vission.second h2", {
                opacity: 0,
                x: 40,
                duration: 0.6,
                ease: "power2.out",
            }, "-=0.3")
                .from(".our-mission-vission.second p", {
                    opacity: 0,
                    x: 40,
                    duration: 0.6,
                    stagger: 0.2,
                    ease: "power2.out",
                }, "-=0.3");
        }
    });
</script>


<script>
    document.addEventListener("DOMContentLoaded", function () {
        gsap.registerPlugin(ScrollTrigger);

        const faqsSection = document.querySelector(".faqs");
        
        // Only run animation if the section exists
        if (faqsSection) {
            const tlFaqs = gsap.timeline({
                scrollTrigger: {
                    trigger: ".faqs",
                    start: "top 80%",
                    end: "bottom 40%",
                    toggleActions: "play none none reverse",
                    once: true, // run only once
                }
            });

        // 🧾 Animate subtitle, heading, and paragraph
        tlFaqs.from(".faqs .subtitle", {
            opacity: 0,
            y: 40,
            duration: 0.6,
            ease: "power2.out"
        })
            .from(".faqs h2", {
                opacity: 0,
                y: 40,
                duration: 0.6,
                ease: "power2.out"
            }, "-=0.3")
            .from(".faqs p", {
                opacity: 0,
                y: 30,
                duration: 0.6,
                ease: "power2.out"
            }, "-=0.3");

            // 🎯 Animate accordion items (each fades up slightly staggered)
            tlFaqs.from(".faqs .accordion-item", {
                opacity: 0,
                y: 40,
                duration: 0.6,
                stagger: 0.15,
                ease: "power2.out"
            }, "-=0.2");
        }
    });
</script>

<!-- GSAP Animation -->
<script>
    window.addEventListener("load", () => {
        gsap.registerPlugin(ScrollTrigger);

        const ctaSection = document.querySelector(".cta");
        
        // Only run animation if the section exists
        if (ctaSection) {
            const tl = gsap.timeline({
                scrollTrigger: {
                    trigger: ".cta",
                    start: "top 80%",
                    toggleActions: "play none none reverse",
                },
            });

        // Animate background shape
        tl.from(".cta .shape img", {
            scale: 1.3,
            opacity: 0,
            duration: 1.2,
            ease: "power3.out",
        })
            // Animate heading
            .from(".cta .content h2", {
                y: 40,
                opacity: 0,
                duration: 0.5,
                ease: "power2.out",
            })
            // Animate paragraph
            .from(".cta .content p", {
                y: 30,
                opacity: 0,
                duration: 0.5,
                ease: "power2.out",
            })
                // Animate parent div of button (NOT the <a> itself)
                .from(".cta .content .d-flex.justify-content-center", {
                    y: 20,
                    opacity: 0,
                    duration: 0.5,
                    ease: "power2.out",
                });
        }
    });
</script>

<script>
    window.addEventListener("load", () => {
        gsap.registerPlugin(ScrollTrigger);

        const productDetailSection = document.querySelector(".product-detail");
        
        // Only run animation if the section exists
        if (productDetailSection) {
            const tl = gsap.timeline({
                scrollTrigger: {
                    trigger: ".product-detail",
                    start: "top 50%",
                    once: true,
                    // markers: true, // for debugging
                }
            });

        // Set initial states
        gsap.set(".product-detail .content.text-center .subtitle", { opacity: 0, y: 40 });
        gsap.set(".product-detail .content.text-center h2.display-3", { opacity: 0, y: 40 });
        gsap.set(".product-detail .content.text-center > p", { opacity: 0, y: 40 });
        gsap.set(".product-detail .image img", { opacity: 0, x: -100 });
        gsap.set(".product-detail .col-lg-6.ps-lg-4 h3", { opacity: 0, y: 40 });
        gsap.set(".product-detail ul li", { opacity: 0, y: 50 });
        gsap.set(".product-detail .col-lg-6.ps-lg-4 .mt-4", { opacity: 0, y: 40 });
        gsap.set(".product-detail .col-lg-12.mt-5 .subtitle", { opacity: 0, y: 40 });
        gsap.set(".product-detail .col-lg-12.mt-5 h2", { opacity: 0, y: 40 });
        gsap.set(".product-detail .col-lg-12.mt-5 > .content > p", { opacity: 0, y: 40 });
        gsap.set(".product-detail .col-lg-6 .mb-3", { opacity: 0, y: 50 });

        // 1️⃣ Subtitle (Professional Marketing Excellence)
        tl.to(".product-detail .content.text-center .subtitle", {
            y: 0,
            opacity: 1,
            duration: 0.6
        });

        // 2️⃣ First h2 (Custom Brochure Solutions)
        tl.to(".product-detail .content.text-center h2.display-3", {
            y: 0,
            opacity: 1,
            duration: 0.6
        }, "-=0.3");

        // 3️⃣ First p tag (At EchoMint Advertising...)
        tl.to(".product-detail .content.text-center > p", {
            y: 0,
            opacity: 1,
            duration: 0.6
        }, "-=0.3");

        // 4️⃣ Image slide from left
        tl.to(".product-detail .image img", {
            x: 0,
            opacity: 1,
            duration: 0.8,
            ease: "power2.out"
        }, "-=0.3");

        // 5️⃣ h3 (Premium Brochure Collection)
        tl.to(".product-detail .col-lg-6.ps-lg-4 h3", {
            y: 0,
            opacity: 1,
            duration: 0.6
        }, "-=0.4");

        // 6️⃣ ul li slide from bottom one by one
        tl.to(".product-detail ul li", {
            y: 0,
            opacity: 1,
            stagger: 0.15,
            duration: 0.6,
            ease: "power2.out"
        }, "-=0.3");

        // 7️⃣ Button (Get Your Free Quote)
        tl.to(".product-detail .col-lg-6.ps-lg-4 .mt-4", {
            y: 0,
            opacity: 1,
            duration: 0.6
        }, "-=0.3");

        // 8️⃣ Materials section subtitle
        tl.to(".product-detail .col-lg-12.mt-5 .subtitle", {
            y: 0,
            opacity: 1,
            duration: 0.6
        }, "-=0.2");

        // 9️⃣ Second h2 (Premium Brochure Materials)
        tl.to(".product-detail .col-lg-12.mt-5 h2", {
            y: 0,
            opacity: 1,
            duration: 0.6
        }, "-=0.3");

        // 🔟 P tag after h2 (Calibrated color workflows...)
        tl.to(".product-detail .col-lg-12.mt-5 > .content > p", {
            y: 0,
            opacity: 1,
            duration: 0.6
        }, "-=0.3");

            // 1️⃣1️⃣ All .mb-3 sections (both columns)
            tl.to(".product-detail .col-lg-6 .mb-3", {
                y: 0,
                opacity: 1,
                stagger: 0.1,
                duration: 0.5,
                ease: "power2.out"
            }, "-=0.3");
        }
    });
</script>

<script>
    window.addEventListener("load", () => {
        gsap.registerPlugin(ScrollTrigger);

        const heroSection = document.querySelector(".hero-section");
        
        // Only run animation if the section exists
        if (heroSection) {
            const heroTl = gsap.timeline({
                defaults: { duration: 0.8, ease: "power2.out" }
            });

        // 1. Animate subtitle
        heroTl.from(".hero-section .content .subtitle", {
            opacity: 0,
            y: 30
        })

            // 2. Animate headline
            .from(".hero-section .content h1", {
                opacity: 0,
                y: 50
            }, "-=0.3") // slight overlap for smoothness

            // 3. Animate paragraph
            .from(".hero-section .content p", {
                opacity: 0,
                y: 30
            }, "-=0.3")

            // 4. Animate button
            .from(".hero-section .btn-wrap", {
                opacity: 0,
                y: 20,
                scale: 0.9
            }, "-=0.3")

                // 5. Animate hero slider container
                .from(".hero-section .hero-slider", {
                    opacity: 0,
                    y: 50,
                    duration: 1,
                    ease: "power2.out"
                }, "-=0.3");
        }
    });
</script>
<script>
    window.addEventListener("load", () => {
        gsap.registerPlugin(ScrollTrigger);

        const expertiesSection = document.querySelector(".our-experties-section");
        
        // Only run animation if the section exists
        if (expertiesSection) {
            // Animate the section title content
            gsap.from(".our-experties-section .content .subtitle, .our-experties-section .content h2, .our-experties-section .content p", {
                scrollTrigger: {
                    trigger: ".our-experties-section",
                    start: "top 80%", // when top of section hits 80% of viewport
                },
                opacity: 0,
                y: 30,
                duration: 0.8,
                stagger: 0.2,
                ease: "power2.out"
            });

            // Animate the service cards one by one
            gsap.from(".our-experties-section .services-card", {
                scrollTrigger: {
                    trigger: ".our-experties-section",
                    start: "top 75%", // slightly earlier for cards
                },
                opacity: 0,
                y: 50,
                duration: 0.8,
                stagger: 0.2, // each card appears after the previous
                ease: "power2.out"
            });
        }
    });
</script>
<script>
    window.addEventListener("load", () => {
        gsap.registerPlugin(ScrollTrigger);

        const servicesSection = document.querySelector(".our-services");
        
        // Only run animation if the section exists
        if (servicesSection) {
            // Animate the Our Services section content
            gsap.from(".our-services .content .subtitle, .our-services .content h2, .our-services .content p", {
                scrollTrigger: {
                    trigger: ".our-services",
                    start: "top 80%", // when top of section reaches 80% of viewport
                    toggleActions: "play none none reverse",
                },
                opacity: 0,
                y: 30,
                duration: 0.8,
                stagger: 0.2, // each element animates slightly after the previous
                ease: "power2.out"
            });
        }
    });
</script>

</body>
</html>