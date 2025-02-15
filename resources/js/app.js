import "./bootstrap";
import "flowbite";
import Alpine from "alpinejs";
import initAlpine from "./init-alpine";

initAlpine(); // Initialize the Alpine data function
Alpine.start();
window.Alpine = Alpine;
