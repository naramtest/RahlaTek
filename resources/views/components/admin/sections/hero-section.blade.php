<section
    class="relative bg-gradient-to-br from-[#D9E2E4] to-[#D9E2E4]/70 px-4 pb-16 pt-20"
    x-data="heroSection()"
    x-init="initHero()"
>
    <div class="main-padding text-center">
        <!-- Badge -->
        <div
            x-ref="badge"
            class="mb-8 inline-flex items-center gap-x-2 rounded-full border-0 bg-gradient-to-r from-[#32BA9A]/20 to-[#233446]/20 px-4 py-2 text-[#233446] opacity-0 shadow-lg"
        >
            <!-- Zap Icon -->
            <svg
                class="h-4 w-4"
                fill="none"
                stroke="currentColor"
                viewBox="0 0 24 24"
            >
                <path
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    stroke-width="2"
                    d="M13 10V3L4 14h7v7l9-11h-7z"
                ></path>
            </svg>
            <span class="text-sm font-medium">
                🚀 {{ __("front.Complete Car Rental Management Solution") }}
            </span>
        </div>

        <!-- Main Title -->
        <h1
            x-ref="title"
            class="mb-8 text-6xl font-extrabold leading-tight text-[#151D26] opacity-0 md:text-7xl"
        >
            {{ __("front.Transform Your Car Rental Business") }}
            <span
                class="block animate-pulse bg-gradient-to-r from-[#32BA9A] via-[#233446] to-[#151D26] bg-clip-text text-transparent"
            >
                {{ __("front.Today") }}
            </span>
        </h1>

        <!-- Description -->
        <p
            x-ref="description"
            class="mx-auto mb-12 max-w-4xl text-xl font-light leading-relaxed text-[#233446]/80 opacity-0 md:text-2xl"
        >
            {{-- TODO: change name --}}
            Streamline all aspects of your rental operations with Carviex smart
            platform. From bookings to billing, customer management to fleet
            tracking—everything in one powerful dashboard.
        </p>

        <!-- Action Buttons -->
        <div
            x-ref="buttons"
            class="mb-16 flex flex-col items-center justify-center gap-6 opacity-0 sm:flex-row"
        >
            <button
                class="group flex items-center gap-x-3 rounded-md bg-gradient-to-r from-[#32BA9A] to-[#233446] px-10 py-3 text-xl font-semibold text-white shadow-2xl transition-all duration-300 hover:scale-105 hover:from-[#32BA9A]/90 hover:to-[#233446]/90 hover:shadow-[#32BA9A]/25"
                @click="startDemo()"
            >
                <!-- Play Icon -->
                <x-gmdi-play-arrow-o
                    @class(["mt-[2px] h-6 w-6", "rotate-180" => app()->getLocale() == "en"])
                />
                <span>{{ __("front.Try Demo Now") }}</span>
            </button>

            <button
                class="group flex items-center gap-x-3 rounded-md border-2 border-[#233446] px-10 py-3 text-xl text-[#233446] transition-all duration-300 hover:scale-105 hover:bg-[#D9E2E4]"
                @click="bookTour()"
            >
                <span>
                    {{ __("front.Book a Tour") }}
                </span>
                <!-- Arrow Right Icon -->
                <x-gmdi-east-o class="mt-[2px] h-6 w-6" />
            </button>
        </div>

        <!-- Stats Section -->
        {{-- TODO: move to helper class or dashboard --}}
        <div x-ref="stats" class="mb-16 grid grid-cols-2 gap-8 md:grid-cols-4">
            @php
                $stats = [
                    [
                        "icon" => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"></path>',
                        "value" => "95%",
                        "label_ar" => "رضا العملاء",
                        "label_en" => "Customer Satisfaction",
                    ],
                    [
                        "icon" => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path>',
                        "value" => "150%",
                        "label_ar" => "متوسط زيادة الإيرادات",
                        "label_en" => "Average Revenue Increase",
                    ],
                    [
                        "icon" => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path>',
                        "value" => "24/7",
                        "label_ar" => "وقت تشغيل النظام",
                        "label_en" => "System Uptime",
                    ],
                    [
                        "icon" => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-9a2.5 2.5 0 11-5 0 2.5 2.5 0 015 0z"></path>',
                        "value" => "500+",
                        "label_ar" => "عميل سعيد",
                        "label_en" => "Happy Customers",
                    ],
                ];
            @endphp

            @foreach ($stats as $index => $stat)
                <div
                    class="rounded-lg border-0 bg-white/80 p-6 text-center shadow-xl backdrop-blur-sm transition-all duration-300 hover:!scale-105 hover:shadow-2xl"
                    x-ref="stat{{ $index }}"
                >
                    <svg
                        class="mx-auto mb-3 h-8 w-8 text-[#32BA9A]"
                        fill="none"
                        stroke="currentColor"
                        viewBox="0 0 24 24"
                    >
                        {!! $stat["icon"] !!}
                    </svg>
                    <div class="mb-2 text-3xl font-bold text-[#151D26]">
                        {{ $stat["value"] }}
                    </div>
                    <p class="text-sm font-medium text-[#233446]">
                        {{ app()->getLocale() === "ar" ? $stat["label_ar"] : $stat["label_en"] }}
                    </p>
                </div>
            @endforeach
        </div>

        <!-- Dashboard Preview Card -->
        <div
            x-ref="preview"
            class="mx-auto max-w-5xl rounded-lg border-0 bg-white/80 p-8 opacity-0 shadow-2xl backdrop-blur-sm transition-all duration-500 hover:shadow-[#32BA9A]/20"
        >
            <div
                class="relative overflow-hidden rounded-xl bg-gradient-to-br from-[#32BA9A] via-[#233446] to-[#151D26]"
            >
                {{-- TODO:change images --}}
                <img
                    src="https://images.unsplash.com/photo-1551288049-bebda4e38f71?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=2070&q=80"
                    alt="Car Rental Management Dashboard"
                    class="h-72 w-full object-cover opacity-90 transition-opacity duration-500 hover:opacity-100 md:h-96"
                />
                <div
                    class="absolute inset-0 bg-gradient-to-br from-[#32BA9A]/30 via-transparent to-[#233446]/30"
                ></div>
                <div
                    class="{{ app()->getLocale() === "ar" ? "right-6" : "left-6" }} absolute bottom-6 z-10 text-white"
                >
                    {{-- TODO:change name --}}
                    <p class="mb-2 text-xl font-bold">
                        Carviex Dashboard Preview
                    </p>
                    <p class="text-sm opacity-90">
                        {{ __("front.Comprehensive Car Rental Management System") }}
                    </p>
                </div>
                <div
                    class="absolute right-4 top-4 h-16 w-16 animate-pulse rounded-full bg-white/10 blur-2xl"
                ></div>
                <div
                    class="absolute bottom-4 right-4 h-12 w-12 animate-pulse rounded-full bg-white/10 blur-xl"
                    style="animation-delay: 1000ms"
                ></div>
            </div>
        </div>
    </div>
</section>
