import "./bootstrap";
import "flowbite";
import Alpine from "alpinejs";
import initAlpine from "./init-alpine";

initAlpine(); // Initialize the Alpine data function
Alpine.start();
window.Alpine = Alpine;

if (localStorage.getItem('dark') === 'true' ||
    (!localStorage.getItem('dark') && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
    document.documentElement.classList.add('dark');
}
