import "./bootstrap";
import "./vendor/dom";
import "./vendor/tailwind-merge";
import "./vendor/svg-loader";
import jQuery from 'jquery';
window.$ = jQuery;

// Load static files
import.meta.glob(["../images/**"]);