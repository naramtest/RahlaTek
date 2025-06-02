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
        },
    };
};
