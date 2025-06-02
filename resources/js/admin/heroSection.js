// resources/js/admin/heroSection.js
export const heroSection = () => {
    return {
        initHero() {
            // Animate badge
            gsap.fromTo(
                this.$refs.badge,
                {
                    opacity: 0,
                    y: -30,
                    scale: 0.8,
                },
                {
                    opacity: 1,
                    y: 0,
                    scale: 1,
                    duration: 0.8,
                    ease: "back.out(1.7)",
                    delay: 0.2,
                },
            );

            // Animate title with typing effect
            gsap.fromTo(
                this.$refs.title,
                {
                    opacity: 0,
                    y: 50,
                },
                {
                    opacity: 1,
                    y: 0,
                    duration: 1,
                    ease: "power2.out",
                    delay: 0.5,
                },
            );

            // Animate description
            gsap.fromTo(
                this.$refs.description,
                {
                    opacity: 0,
                    y: 30,
                },
                {
                    opacity: 1,
                    y: 0,
                    duration: 0.8,
                    ease: "power2.out",
                    delay: 0.8,
                },
            );

            // Animate buttons
            gsap.fromTo(
                this.$refs.buttons,
                {
                    opacity: 0,
                    y: 40,
                },
                {
                    opacity: 1,
                    y: 0,
                    duration: 0.8,
                    ease: "power2.out",
                    delay: 1.1,
                },
            );

            // Animate stats with stagger
            const statRefs = [
                this.$refs.stat0,
                this.$refs.stat1,
                this.$refs.stat2,
                this.$refs.stat3,
            ].filter((ref) => ref); // Filter out undefined refs

            gsap.fromTo(
                statRefs,
                {
                    opacity: 0,
                    y: 50,
                    scale: 0.8,
                },
                {
                    opacity: 1,
                    y: 0,
                    scale: 1,
                    duration: 0.6,
                    ease: "back.out(1.7)",
                    stagger: 0.15,
                    delay: 1.4,
                },
            );

            // Animate preview card
            gsap.fromTo(
                this.$refs.preview,
                {
                    opacity: 0,
                    y: 60,
                    scale: 0.9,
                },
                {
                    opacity: 1,
                    y: 0,
                    scale: 1,
                    duration: 1,
                    ease: "power2.out",
                    delay: 1.8,
                },
            );

            // Add floating animation to background elements
            this.addFloatingAnimation();
        },

        addFloatingAnimation() {
            // Create floating particles animation
            const particles = document.querySelectorAll(".hero-particle");
            particles.forEach((particle, index) => {
                gsap.to(particle, {
                    y: "random(-20, 20)",
                    x: "random(-10, 10)",
                    rotation: "random(-5, 5)",
                    duration: "random(3, 5)",
                    repeat: -1,
                    yoyo: true,
                    ease: "sine.inOut",
                    delay: index * 0.2,
                });
            });
        },
    };
};
