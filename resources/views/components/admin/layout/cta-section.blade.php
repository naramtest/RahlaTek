<section
    class="relative overflow-hidden bg-gradient-to-br from-[#32BA9A] via-[#233446] to-[#151D26] px-4 py-20 text-white"
    x-data="ctaSection()"
    x-init="initCTA()"
>
    <!-- Animated Background -->
    <div
        class="absolute inset-0 animate-pulse bg-gradient-to-br from-[#32BA9A]/20 to-[#233446]/20"
        x-ref="backgroundGradient"
    ></div>

    <div class="container relative z-10 mx-auto text-center">
        <!-- Main Heading -->
        <h2
            x-ref="heading"
            class="mb-8 text-5xl font-bold opacity-0 md:text-6xl"
        >
            {{ __("front.Ready to Transform Your Business?") }}
        </h2>

        <!-- Description -->
        {{-- TODO: change name here --}}
        <p
            x-ref="description"
            class="mx-auto mb-12 max-w-3xl text-xl leading-relaxed"
        >
            Join hundreds of car rental companies already using Carviex to
            streamline their operations and increase revenue
        </p>

        <!-- CTA Buttons -->
        <div
            x-ref="buttons"
            class="flex flex-col items-center justify-center gap-6 opacity-0 sm:flex-row"
        >
            <!-- Primary Demo Button -->
            <button
                class="group flex items-center rounded-lg bg-white px-10 py-4 text-xl font-bold text-gray-800 shadow-2xl transition-all duration-300 hover:scale-105 hover:bg-gray-100 hover:text-gray-900"
                @click="startDemo()"
            >
                <!-- Play Icon -->
                <x-gmdi-play-arrow-o
                    @class(["me-1 mt-[1px] h-6 w-6", "rotate-180" => app()->getLocale() == "en"])
                />
                <span>{{ __("front.Start Free Demo") }}</span>
            </button>

            <!-- Secondary Sales Button -->
            <button
                class="rounded-lg border-2 border-white px-10 py-4 text-xl font-semibold text-white transition-all duration-300 hover:scale-105 hover:bg-white hover:text-[#32BA9A]"
                @click="contactSales()"
            >
                {{ __("front.Contact Sales Team") }}
            </button>
        </div>

        <!-- Note -->
        <p x-ref="note" class="mt-8 text-sm opacity-75">
            {{ __("front.No credit card required • 14-day free trial") }}
        </p>
    </div>
</section>
