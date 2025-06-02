import { footerAnimation } from "./footerAnimation.js";
import { ctaSection } from "./ctaAnimation.js";
import { heroSection } from "./heroSection.js";

Alpine.data("footerAnimation", footerAnimation);
Alpine.data("ctaSection", ctaSection);
Alpine.data("heroSection", heroSection);
Livewire.start();
