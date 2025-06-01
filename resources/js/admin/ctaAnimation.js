// resources/js/admin/ctaAnimation.js

export const ctaSection = () => {
    return {
        initCTA() {
            // Set up timeline for sequential animations
            const timeline = gsap.timeline({
                scrollTrigger: {
                    trigger: this.$el,
                    start: "top 80%",
                    end: "bottom 20%",
                    toggleActions: "play none none reverse",
                    onComplete: () => {
                        this.addInteractiveAnimations();
                    },
                },
            });

            // Animate heading
            timeline.fromTo(
                this.$refs.heading,
                {
                    opacity: 0,
                    y: 50,
                    scale: 0.8,
                },
                {
                    opacity: 1,
                    y: 0,
                    scale: 1,
                    duration: 1,
                    ease: "power3.out",
                },
            );

            // Animate description
            timeline.fromTo(
                this.$refs.description,
                {
                    opacity: 0,
                    y: 30,
                },
                {
                    opacity: 0.9,
                    y: 0,
                    duration: 0.8,
                    ease: "power2.out",
                },
                "-=0.5",
            );

            // Animate buttons
            timeline.fromTo(
                this.$refs.buttons,
                {
                    opacity: 0,
                    y: 40,
                    scale: 0.9,
                },
                {
                    opacity: 1,
                    y: 0,
                    scale: 1,
                    duration: 0.8,
                    ease: "back.out(1.7)",
                },
                "-=0.4",
            );

            // Animate note
            timeline.fromTo(
                this.$refs.note,
                {
                    opacity: 0,
                    y: 20,
                },
                {
                    opacity: 0.75,
                    y: 0,
                    duration: 0.6,
                    ease: "power2.out",
                },
                "-=0.3",
            );

            // Animate floating elements
            this.animateFloatingElements();
        },

        addInteractiveAnimations() {
            // Add hover animations for buttons
            const buttons = this.$refs.buttons.querySelectorAll("button");

            buttons.forEach((button) => {
                button.addEventListener("mouseenter", () => {
                    gsap.to(button, {
                        scale: 1.05,
                        duration: 0.3,
                        ease: "power2.out",
                    });
                });

                button.addEventListener("mouseleave", () => {
                    gsap.to(button, {
                        scale: 1,
                        duration: 0.3,
                        ease: "power2.out",
                    });
                });
            });

            // Add pulse animation to heading
            gsap.to(this.$refs.heading, {
                scale: 1.02,
                duration: 2,
                ease: "power2.inOut",
                yoyo: true,
                repeat: -1,
            });
        },

        animateFloatingElements() {
            // Floating animation for background elements
            gsap.to(this.$refs.floatingElement1, {
                scale: 1.2,
                duration: 4,
                ease: "power2.inOut",
                yoyo: true,
                repeat: -1,
            });

            gsap.to(this.$refs.floatingElement2, {
                scale: 1.3,
                duration: 3,
                ease: "power2.inOut",
                yoyo: true,
                repeat: -1,
                delay: 1,
            });

            // Background gradient animation
            gsap.to(this.$refs.backgroundGradient, {
                opacity: 0.3,
                duration: 3,
                ease: "power2.inOut",
                yoyo: true,
                repeat: -1,
            });
        },

        startDemo() {
            // Add click animation
            gsap.to(event.target, {
                scale: 0.95,
                duration: 0.1,
                ease: "power2.out",
                yoyo: true,
                repeat: 1,
            });

            // Add your demo logic here
            console.log("Starting demo...");
            // Example: window.location.href = '/demo';
        },

        contactSales() {
            // Add click animation
            gsap.to(event.target, {
                scale: 0.95,
                duration: 0.1,
                ease: "power2.out",
                yoyo: true,
                repeat: 1,
            });

            // Add your contact sales logic here
            console.log("Contacting sales...");
            // Example: window.location.href = '/contact-sales';
        },
    };
};
