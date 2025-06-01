<li {{ $attributes }}>
    <a
        {{ $attributes->only("href")->merge(["class" => "group inline-block transition-all duration-300 hover:translate-x-1 hover:text-[#32BA9A] hover:text-white"]) }}
    >
        <span
            class="border-b border-transparent transition-colors duration-300 group-hover:border-[#32BA9A]"
        >
            {{ $slot }}
        </span>
    </a>
</li>
