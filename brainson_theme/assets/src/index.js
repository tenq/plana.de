// Entry file for stylesheets
import './styles/index.pcss';

// Process images Webpack otherwise wouldn't know about:
import './scripts/static-import';

// Component scripts
import "./scripts/scroll-tiles.js";
import "./scripts/gallery.js";
import "./scripts/slider.js";

// Vendor dependencies
import Alpine from 'alpinejs'
import 'lazysizes';
import "lightgallery.js";
import "lg-thumbnail.js";

// Init Alpine.js
window.Alpine = Alpine;
Alpine.start();