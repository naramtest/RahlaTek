import "./bootstrap";
import {
    Alpine,
    Livewire,
} from "../../vendor/livewire/livewire/dist/livewire.esm";
import { gsap } from "gsap";
import { ScrollTrigger } from "gsap/ScrollTrigger";

window.Alpine = Alpine;
window.Livewire = Livewire;

gsap.registerPlugin(ScrollTrigger);
window.gsap = gsap;
window.ScrollTrigger = ScrollTrigger;
