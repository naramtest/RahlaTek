<?php
// resources/views/components/admin/layout/footer.blade.php
?>

<footer
    id="support"
    class="relative bg-[#151D26] px-4 py-16 text-white"
    x-data="footerAnimation()"
    x-init="initFooter()"
>
    <div class="container mx-auto">
        <div class="grid gap-10 md:grid-cols-4">
            <!-- Logo and Description -->
            <div x-ref="logoSection" class="opacity-0">
                <div class="group mb-6 flex items-center gap-x-3">
                    <div class="relative">
                        <!-- Car Icon with hover animation -->
                        <svg
                            class="h-8 w-8 text-[#32BA9A] transition-transform duration-300 group-hover:scale-110"
                            fill="none"
                            stroke="currentColor"
                            viewBox="0 0 24 24"
                            x-ref="carIcon"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="2"
                                d="M9 17a2 2 0 11-4 0 2 2 0 014 0zM19 17a2 2 0 11-4 0 2 2 0 014 0z"
                            ></path>
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="2"
                                d="M13 6h3l4 4v5H4V9l4-4h3V4a1 1 0 011-1h1a1 1 0 011 1v2z"
                            ></path>
                        </svg>
                        <div
                            class="absolute inset-0 rounded-full bg-[#32BA9A] opacity-20 blur-xl transition-opacity duration-300 group-hover:opacity-40"
                        ></div>
                    </div>
                    <span
                        class="bg-gradient-to-r from-[#32BA9A] to-white bg-clip-text text-2xl font-bold text-transparent"
                    >
                        Carviex
                    </span>
                </div>
                <p class="leading-relaxed text-[#D9E2E4]">
                    {{-- TODO: info description --}}
                </p>
            </div>

            <!-- Product Links -->
            <div x-ref="productSection" class="opacity-0">
                <h3 class="mb-6 text-lg font-bold text-[#32BA9A]">
                    {{ __("front.Product") }}
                </h3>
                <ul class="space-y-3 text-[#D9E2E4]">
                    @foreach (\App\Helpers\Nav::get() as $navItem)
                        <x-admin.layout.footer-item
                            href="{{$navItem['route']}}"
                        >
                            {{ $navItem["title"] }}
                        </x-admin.layout.footer-item>
                    @endforeach
                </ul>
            </div>

            {{-- TODO: add those pages --}}
            <!-- Support Links -->
            <div x-ref="supportSection" class="opacity-0">
                <h3 class="mb-6 text-lg font-bold text-[#32BA9A]">
                    {{ __("front.Support") }}
                </h3>
                <ul class="space-y-3 text-[#D9E2E4]">
                    <li>
                        <a
                            href="#help"
                            class="group inline-block transition-all duration-300 hover:translate-x-1 hover:text-[#32BA9A]"
                        >
                            <span
                                class="border-b border-transparent transition-colors duration-300 group-hover:border-[#32BA9A]"
                            >
                                {{ app()->getLocale() === "ar" ? "مركز المساعدة" : "Help Center" }}
                            </span>
                        </a>
                    </li>
                    <li>
                        <a
                            href="#contact"
                            class="group inline-block transition-all duration-300 hover:translate-x-1 hover:text-[#32BA9A]"
                        >
                            <span
                                class="border-b border-transparent transition-colors duration-300 group-hover:border-[#32BA9A]"
                            >
                                {{ app()->getLocale() === "ar" ? "تواصل معنا" : "Contact Us" }}
                            </span>
                        </a>
                    </li>
                    <li>
                        <a
                            href="#training"
                            class="group inline-block transition-all duration-300 hover:translate-x-1 hover:text-[#32BA9A]"
                        >
                            <span
                                class="border-b border-transparent transition-colors duration-300 group-hover:border-[#32BA9A]"
                            >
                                {{ app()->getLocale() === "ar" ? "التدريب" : "Training" }}
                            </span>
                        </a>
                    </li>
                    <li>
                        <a
                            href="#status"
                            class="group inline-block transition-all duration-300 hover:translate-x-1 hover:text-[#32BA9A]"
                        >
                            <span
                                class="border-b border-transparent transition-colors duration-300 group-hover:border-[#32BA9A]"
                            >
                                {{ app()->getLocale() === "ar" ? "الحالة" : "Status" }}
                            </span>
                        </a>
                    </li>
                </ul>
            </div>

            <!-- Company Links -->
            <div x-ref="companySection" class="opacity-0">
                <h3 class="mb-6 text-lg font-bold text-[#32BA9A]">
                    {{ __("front.Company") }}
                </h3>
                <ul class="space-y-3 text-[#D9E2E4]">
                    <li>
                        <a
                            href="#about"
                            class="group inline-block transition-all duration-300 hover:translate-x-1 hover:text-[#32BA9A]"
                        >
                            <span
                                class="border-b border-transparent transition-colors duration-300 group-hover:border-[#32BA9A]"
                            >
                                {{ app()->getLocale() === "ar" ? "عنا" : "About Us" }}
                            </span>
                        </a>
                    </li>
                    <li>
                        <a
                            href="#blog"
                            class="group inline-block transition-all duration-300 hover:translate-x-1 hover:text-[#32BA9A]"
                        >
                            <span
                                class="border-b border-transparent transition-colors duration-300 group-hover:border-[#32BA9A]"
                            >
                                {{ app()->getLocale() === "ar" ? "المدونة" : "Blog" }}
                            </span>
                        </a>
                    </li>
                    <li>
                        <a
                            href="#careers"
                            class="group inline-block transition-all duration-300 hover:translate-x-1 hover:text-[#32BA9A]"
                        >
                            <span
                                class="border-b border-transparent transition-colors duration-300 group-hover:border-[#32BA9A]"
                            >
                                {{ app()->getLocale() === "ar" ? "الوظائف" : "Careers" }}
                            </span>
                        </a>
                    </li>
                    <li>
                        <a
                            href="#partners"
                            class="group inline-block transition-all duration-300 hover:translate-x-1 hover:text-[#32BA9A]"
                        >
                            <span
                                class="border-b border-transparent transition-colors duration-300 group-hover:border-[#32BA9A]"
                            >
                                {{ app()->getLocale() === "ar" ? "الشركاء" : "Partners" }}
                            </span>
                        </a>
                    </li>
                </ul>
            </div>
        </div>

        <!-- Copyright -->
        <div
            x-ref="copyright"
            class="mt-12 border-t border-[#233446] pt-8 text-center text-[#D9E2E4] opacity-0"
        >
            <p>
                © {{ now()->year }} Carviex.
                {{ __("front.All rights reserved") }}.
            </p>
        </div>
    </div>

    <!-- Floating particles animation -->
    <div
        class="absolute right-4 top-4 h-32 w-32 animate-pulse rounded-full bg-[#32BA9A]/10 blur-3xl"
    ></div>
    <div
        class="absolute bottom-4 left-4 h-24 w-24 animate-pulse rounded-full bg-[#233446]/10 blur-2xl"
        style="animation-delay: 1000ms"
    ></div>
</footer>

@push("scripts")
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/gsap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/ScrollTrigger.min.js"></script>

    <script>
        function footerAnimation() {
            return {
                initFooter() {
                    // Register ScrollTrigger plugin
                    gsap.registerPlugin(ScrollTrigger);

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
                            ease: 'power2.out',
                            scrollTrigger: {
                                trigger: this.$el,
                                start: 'top 80%',
                                end: 'bottom 20%',
                                toggleActions: 'play none none reverse',
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
                            ease: 'power2.out',
                            scrollTrigger: {
                                trigger: this.$el,
                                start: 'top 70%',
                                toggleActions: 'play none none reverse',
                            },
                        },
                    );

                    // Car icon rotation on hover
                    this.$refs.carIcon.addEventListener('mouseenter', () => {
                        gsap.to(this.$refs.carIcon, {
                            rotation: 360,
                            duration: 0.6,
                            ease: 'power2.out',
                        });
                    });
                },
            };
        }
    </script>
@endpush
