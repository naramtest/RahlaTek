export const footerAnimation = () => {
    return {
        initFooter() {
            // Animate sections on scroll
            const sections = [
                this.$refs.logoSection,
                this.$refs.productSection,
                this.$refs.supportSection,
                this.$refs.companySection,
            ];

            // Animate each section with stagger
            gsap.fromTo(
                sections,
                {
                    opacity: 0,
                    y: 50,
                },
                {
                    opacity: 1,
                    y: 0,
                    duration: 0.8,
                    stagger: 0.2,
                    ease: "power2.out",
                    scrollTrigger: {
                        trigger: this.$el,
                        start: "top 80%",
                        end: "bottom 20%",
                        toggleActions: "play none none reverse",
                    },
                },
            );

            // Animate copyright
            gsap.fromTo(
                this.$refs.copyright,
                {
                    opacity: 0,
                    y: 30,
                },
                {
                    opacity: 1,
                    y: 0,
                    duration: 0.6,
                    delay: 0.8,
                    ease: "power2.out",
                    scrollTrigger: {
                        trigger: this.$el,
                        start: "top 70%",
                        toggleActions: "play none none reverse",
                    },
                },
            );

            // Car icon rotation on hover
            this.$refs.carIcon.addEventListener("mouseenter", () => {
                gsap.to(this.$refs.carIcon, {
                    rotation: 360,
                    duration: 0.6,
                    ease: "power2.out",
                });
            });
        },
    };
};
