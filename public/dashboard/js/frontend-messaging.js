/******/ (function(modules) { // webpackBootstrap
  /******/ 	// The module cache
  /******/ 	var installedModules = {};
  /******/
  /******/ 	// The require function
  /******/ 	function __webpack_require__(moduleId) {
    /******/
    /******/ 		// Check if module is in cache
    /******/ 		if(installedModules[moduleId]) {
      /******/ 			return installedModules[moduleId].exports;
      /******/ 		}
    /******/ 		// Create a new module (and put it into the cache)
    /******/ 		var module = installedModules[moduleId] = {
      /******/ 			i: moduleId,
      /******/ 			l: false,
      /******/ 			exports: {}
      /******/ 		};
    /******/
    /******/ 		// Execute the module function
    /******/ 		modules[moduleId].call(module.exports, module, module.exports, __webpack_require__);
    /******/
    /******/ 		// Flag the module as loaded
    /******/ 		module.l = true;
    /******/
    /******/ 		// Return the exports of the module
    /******/ 		return module.exports;
    /******/ 	}
  /******/
  /******/
  /******/ 	// expose the modules object (__webpack_modules__)
  /******/ 	__webpack_require__.m = modules;
  /******/
  /******/ 	// expose the module cache
  /******/ 	__webpack_require__.c = installedModules;
  /******/
  /******/ 	// define getter function for harmony exports
  /******/ 	__webpack_require__.d = function(exports, name, getter) {
    /******/ 		if(!__webpack_require__.o(exports, name)) {
      /******/ 			Object.defineProperty(exports, name, { enumerable: true, get: getter });
      /******/ 		}
    /******/ 	};
  /******/
  /******/ 	// define __esModule on exports
  /******/ 	__webpack_require__.r = function(exports) {
    /******/ 		if(typeof Symbol !== 'undefined' && Symbol.toStringTag) {
      /******/ 			Object.defineProperty(exports, Symbol.toStringTag, { value: 'Module' });
      /******/ 		}
    /******/ 		Object.defineProperty(exports, '__esModule', { value: true });
    /******/ 	};
  /******/
  /******/ 	// create a fake namespace object
  /******/ 	// mode & 1: value is a module id, require it
  /******/ 	// mode & 2: merge all properties of value into the ns
  /******/ 	// mode & 4: return value when already ns object
  /******/ 	// mode & 8|1: behave like require
  /******/ 	__webpack_require__.t = function(value, mode) {
    /******/ 		if(mode & 1) value = __webpack_require__(value);
    /******/ 		if(mode & 8) return value;
    /******/ 		if((mode & 4) && typeof value === 'object' && value && value.__esModule) return value;
    /******/ 		var ns = Object.create(null);
    /******/ 		__webpack_require__.r(ns);
    /******/ 		Object.defineProperty(ns, 'default', { enumerable: true, value: value });
    /******/ 		if(mode & 2 && typeof value != 'string') for(var key in value) __webpack_require__.d(ns, key, function(key) { return value[key]; }.bind(null, key));
    /******/ 		return ns;
    /******/ 	};
  /******/
  /******/ 	// getDefaultExport function for compatibility with non-harmony modules
  /******/ 	__webpack_require__.n = function(module) {
    /******/ 		var getter = module && module.__esModule ?
      /******/ 			function getDefault() { return module['default']; } :
      /******/ 			function getModuleExports() { return module; };
    /******/ 		__webpack_require__.d(getter, 'a', getter);
    /******/ 		return getter;
    /******/ 	};
  /******/
  /******/ 	// Object.prototype.hasOwnProperty.call
  /******/ 	__webpack_require__.o = function(object, property) { return Object.prototype.hasOwnProperty.call(object, property); };
  /******/
  /******/ 	// __webpack_public_path__
  /******/ 	__webpack_require__.p = "/";
  /******/
  /******/
  /******/ 	// Load entry module and return exports
  /******/ 	return __webpack_require__(__webpack_require__.s = 1);
  /******/ })
  /************************************************************************/
  /******/ ({

    /***/ "./node_modules/@joeattardi/emoji-button/dist/index.js":
    /*!*************************************************************!*\
      !*** ./node_modules/@joeattardi/emoji-button/dist/index.js ***!
      \*************************************************************/
    /*! no libs exports found */
    /***/ (function(module, exports, __webpack_require__) {

      /* WEBPACK VAR INJECTION */(function(global) {!function(e,o){ true?module.exports=o():undefined}(this,(function(){"use strict";
        var e=function(){return(e=Object.assign||function(e){for(var o,n=1,a=arguments.length;n<a;n++)for(var i in o=arguments[n])Object.prototype.hasOwnProperty.call(o,i)&&(e[i]=o[i]);return e}).apply(this,arguments)};function o(){for(var e=0,o=0,n=arguments.length;o<n;o++)e+=arguments[o].length;var a=Array(e),i=0;for(o=0;o<n;o++)for(var r=arguments[o],t=0,m=r.length;t<m;t++,i++)a[i]=r[t];return a}!function(e,o){void 0===o&&(o={});var n=o.insertAt;if(e&&"undefined"!=typeof document){var a=document.head||document.getElementsByTagName("head")[0],i=document.createElement("style");i.type="text/css","top"===n&&a.firstChild?a.insertBefore(i,a.firstChild):a.appendChild(i),i.styleSheet?i.styleSheet.cssText=e:i.appendChild(document.createTextNode(e))}}('@keyframes show {\n  0% {\n    opacity: 0;\n    transform: scale3d(0.8, 0.8, 0.8);\n  }\n\n  50% {\n    transform: scale3d(1.05, 1.05, 1.05);\n  }\n\n  100% {\n    transform: scale3d(1, 1, 1);\n  }\n}\n\n@keyframes hide {\n  0% {\n    opacity: 1;\n    transform: scale3d(1, 1, 1);\n  }\n\n  100% {\n    opacity: 0;\n    transform: scale3d(0.8, 0.8, 0.8);\n  }\n}\n\n@keyframes grow {\n  0% {\n    opacity: 0;\n    transform: scale3d(0.8, 0.8, 0.8); \n  }\n\n  100% { \n    opacity: 1;\n    transform: scale3d(1, 1, 1); \n  }\n}\n\n@keyframes shrink {\n  0% { \n    opacity: 1;\n    transform: scale3d(1, 1, 1);\n  }\n\n  100% { \n    opacity: 0;\n    transform: scale3d(0.8, 0.8, 0.8); \n  }\n}\n\n@keyframes fade-in {\n  0% { opacity: 0; }\n  100% { opacity: 1; }\n}\n\n@keyframes fade-out {\n  0% { opacity: 1; }\n  100% { opacity: 0; }\n}\n\n.emoji-picker {\n  --animation-duration: 0.2s;\n  --animation-easing: ease-in-out;\n\n  --emoji-size: 1.8em;\n  --emoji-size-multiplier: 1.5;\n  --emoji-preview-size: 2em;\n  --emoji-per-row: 8;\n  --row-count: 6;\n\n  --content-height: calc((var(--emoji-size) * var(--emoji-size-multiplier)) * var(--row-count) + var(--category-name-size) + var(--category-button-height) + 0.5em);\n\n  --category-name-size: 0.85em;\n\n  --category-button-height: 2em;\n  --category-button-size: 1.1em;\n  --category-border-bottom-size: 4px;\n\n  --focus-indicator-color: #999999;\n\n  --search-height: 2em;\n\n  --blue-color: #4F81E5;\n\n  --border-color: #CCCCCC;\n  --background-color: #FFFFFF;\n  --text-color: #000000;\n  --secondary-text-color: #666666;\n  --hover-color: #E8F4F9;\n  --search-focus-border-color: var(--blue-color);\n  --search-icon-color: #CCCCCC;\n  --overlay-background-color: rgba(0, 0, 0, 0.8);\n  --popup-background-color: #FFFFFF;\n  --category-button-color: #666666;\n  --category-button-active-color: var(--blue-color);\n\n  --dark-border-color: #666666;\n  --dark-background-color: #333333;\n  --dark-text-color: #FFFFFF;\n  --dark-secondary-text-color: #999999;\n  --dark-hover-color: #666666;\n  --dark-search-background-color: #666666;\n  --dark-search-border-color: #999999;\n  --dark-search-placeholder-color: #999999;\n  --dark-search-focus-border-color: #DBE5F9;\n  --dark-popup-background-color: #333333;\n  --dark-category-button-color: #FFFFFF;\n}\n\n.emoji-picker {\n  font-size: 16px;\n\n  border: 1px solid var(--border-color);\n  border-radius: 5px;\n  background: var(--background-color);\n  width: calc(var(--emoji-per-row) * var(--emoji-size) * var(--emoji-size-multiplier) + 1em + 2px);\n  font-family: Arial, Helvetica, sans-serif;\n  overflow: hidden;\n  animation: show var(--animation-duration) var(--animation-easing);\n}\n\n.emoji-picker.hiding {\n  animation: hide var(--animation-duration) var(--animation-easing);\n}\n\n.emoji-picker.dark {\n  background: var(--dark-background-color);\n  color: var(--dark-text-color);\n  border-color: var(--dark-border-color);\n}\n\n.emoji-picker__content {\n  padding: 0.5em;\n  height: var(--content-height);\n  position: relative;\n}\n\n.emoji-picker__preview {\n  height: var(--emoji-preview-size);\n  padding: 0.5em;\n  border-top: 1px solid var(--border-color);\n  display: flex;\n  flex-direction: row;\n  align-items: center;\n}\n\n.emoji-picker.dark .emoji-picker__preview {\n  border-top-color: var(--dark-border-color);\n}\n\n.emoji-picker__preview-emoji {\n  font-size: var(--emoji-preview-size);\n  margin-right: 0.25em;\n  font-family: "Segoe UI Emoji", "Segoe UI Symbol", "Segoe UI", "Apple Color Emoji", "Twemoji Mozilla", "Noto Color Emoji", "EmojiOne Color", "Android Emoji";\n}\n\n.emoji-picker__preview-emoji img.emoji {\n  height: 1em;\n  width: 1em;\n  margin: 0 .05em 0 .1em;\n  vertical-align: -0.1em;\n}\n\n.emoji-picker__preview-name {\n  color: var(--text-color);\n  font-size: 0.85em;\n  overflow-wrap: break-word;\n  word-break: break-all;\n}\n\n.emoji-picker.dark .emoji-picker__preview-name {\n  color: var(--dark-text-color);\n}\n\n.emoji-picker__container {\n  display: grid;\n  grid-template-columns: repeat(var(--emoji-per-row), 1fr);\n  grid-auto-rows: calc(var(--emoji-size) * var(--emoji-size-multiplier));\n}\n\n.emoji-picker__container.search-results {\n  height: var(--content-height);\n  overflow-y: scroll;\n}\n\n.emoji-picker__emoji {\n  background: transparent;\n  border: none;\n  cursor: pointer;\n  font-size: var(--emoji-size);\n  width: 1.5em;\n  height: 1.5em;\n  padding: 0;\n  margin: 0;\n  outline: none;\n  font-family: "Segoe UI Emoji", "Segoe UI Symbol", "Segoe UI", "Apple Color Emoji", "Twemoji Mozilla", "Noto Color Emoji", "EmojiOne Color", "Android Emoji";\n}\n\n.emoji-picker__emoji img.emoji {\n  height: 1em;\n  width: 1em;\n  margin: 0 .05em 0 .1em;\n  vertical-align: -0.1em;\n}\n\n.emoji-picker__emoji:focus, .emoji-picker__emoji:hover {\n  background: var(--hover-color);\n}\n\n.emoji-picker__emoji:focus {\n  outline: 1px dotted var(--focus-indicator-color);\n}\n\n.emoji-picker.dark .emoji-picker__emoji:focus, .emoji-picker.dark .emoji-picker__emoji:hover {\n  background: var(--dark-hover-color);\n}\n\n.emoji-picker__search-container {\n  margin: 0.5em;\n  position: relative;\n  height: var(--search-height);\n  display: flex;\n}\n\n.emoji-picker__search {\n  box-sizing: border-box;\n  width: 100%;\n  border-radius: 3px;\n  border: 1px solid var(--border-color);\n  padding-right: 2em;\n  padding: 0.5em 2.25em 0.5em 0.5em;\n  font-size: 0.85em;\n  outline: none;\n}\n\n.emoji-picker.dark .emoji-picker__search {\n  background: var(--dark-search-background-color);\n  color: var(--dark-text-color);\n  border-color: var(--dark-search-border-color);\n}\n\n.emoji-picker.dark .emoji-picker__search::placeholder {\n  color: var(--dark-search-placeholder-color);\n}\n\n.emoji-picker__search:focus {\n  border: 1px solid var(--search-focus-border-color);\n}\n\n.emoji-picker.dark .emoji-picker__search:focus {\n  border-color: var(--dark-search-focus-border-color);\n}\n\n.emoji-picker__search-icon {\n  position: absolute;\n  color: var(--search-icon-color);\n  width: 1em;\n  height: 1em;\n  right: 0.75em;\n  top: calc(50% - 0.5em);\n}\n\n.emoji-picker__search-not-found {\n  color: var(--secondary-text-color);\n  text-align: center;\n  height: 100%;\n  display: flex;\n  flex-direction: column;\n  justify-content: center;\n}\n\n.emoji-picker__search-not-found h2 {\n  color: var(--secondary-text-color);\n}\n\n.emoji-picker.dark .emoji-picker__search-not-found {\n  color: var(--dark-secondary-text-color);\n}\n\n.emoji-picker.dark .emoji-picker__search-not-found h2 {\n  color: var(--dark-secondary-text-color);\n}\n\n.emoji-picker__search-not-found-icon {\n  font-size: 3em;\n}\n\n.emoji-picker__search-not-found h2 {\n  margin: 0.5em 0;\n  font-size: 1em;\n}\n\n.emoji-picker__variant-overlay {\n  background: var(--overlay-background-color);\n  position: absolute;\n  top: 0;\n  left: 0;\n  width: 100%;\n  height: 100%;\n  border-radius: 5px;\n  display: flex;\n  flex-direction: column;\n  justify-content: center;\n  animation: fade-in var(--animation-duration) var(--animation-easing);\n}\n\n.emoji-picker__variant-overlay.hiding {\n  animation: fade-out var(--animation-duration) var(--animation-easing);\n}\n\n.emoji-picker__variant-popup {\n  background: var(--popup-background-color);\n  margin: 0.5em;\n  padding: 0.5em;\n  text-align: center;\n  border-radius: 5px;\n  animation: grow var(--animation-duration) var(--animation-easing);\n  user-select: none;\n}\n\n.emoji-picker__variant-overlay.hiding .emoji-picker__variant-popup {\n  animation: shrink var(--animation-duration) var(--animation-easing);\n}\n\n.emoji-picker.dark .emoji-picker__variant-popup {\n  background: var(--dark-popup-background-color);\n}\n\n.emoji-picker__emojis {\n  overflow-y: scroll;\n  position: relative;\n  height: calc((var(--emoji-size) * var(--emoji-size-multiplier)) * var(--row-count) + var(--category-name-size));\n  padding-left: 1px;\n  padding-right: 1px;\n}\n\n.emoji-picker__emojis.hiding {\n  animation: fade-out 0.05s var(--animation-easing);\n}\n\n.emoji-picker__emojis h2.emoji-picker__category-name {\n  font-size: 0.85em;\n  color: var(--secondary-text-color);\n  text-transform: uppercase;\n  margin: 0.25em 0;\n  text-align: left;\n}\n\n.emoji-picker.dark h2.emoji-picker__category-name {\n  color: var(--dark-secondary-text-color);\n}\n\n.emoji-picker__category-buttons {\n  display: flex;\n  flex-direction: row;\n  justify-content: space-around;\n  height: var(--category-button-height);\n  margin-bottom: 0.5em;\n}\n\nbutton.emoji-picker__category-button {\n  flex-grow: 1;\n  background: transparent;\n  border: none;\n  cursor: pointer;\n  font-size: var(--category-button-size);\n  vertical-align: middle;\n  color: var(--category-button-color);\n  border-bottom: var(--category-border-bottom-size) solid transparent;\n  outline: none;\n}\n\n.emoji-picker.keyboard button.emoji-picker__category-button:focus {\n  outline: 1px dotted var(--focus-indicator-color);\n}\n\n.emoji-picker.dark button.emoji-picker__category-button.active {\n  color: var(--category-button-active-color);\n}\n\n.emoji-picker.dark button.emoji-picker__category-button {\n  color: var(--dark-category-button-color);\n}\n\nbutton.emoji-picker__category-button.active {\n  color: var(--category-button-active-color);\n  border-bottom: var(--category-border-bottom-size) solid var(--category-button-active-color);\n}\n\n@media (prefers-color-scheme: dark) {\n  .emoji-picker.auto {\n    background: var(--dark-background-color);\n    color: var(--dark-text-color);\n    border-color: var(--dark-border-color);\n  }\n\n  .emoji-picker.auto .emoji-picker__preview {\n    border-top-color: var(--dark-border-color);\n  }\n\n  .emoji-picker.auto .emoji-picker__preview-name {\n    color: var(--dark-text-color);\n  }\n\n  .emoji-picker.auto button.emoji-picker__category-button {\n    color: var(--dark-category-button-color);\n  }\n\n  .emoji-picker.auto button.emoji-picker__category-button {\n    color: var(--category-button-active-color);\n  }\n\n  .emoji-picker.auto .emoji-picker__emoji:focus, .emoji-picker.auto .emoji-picker__emoji:hover {\n    background: var(--dark-hover-color);\n  }\n\n  .emoji-picker.auto .emoji-picker__search {\n    background: var(--dark-search-background-color);\n    color: var(--dark-text-color);\n    border-color: var(--dark-search-border-color);\n  }\n \n  .emoji-picker.auto h2.emoji-picker__category-name {\n    color: var(--dark-secondary-text-color);\n  }\n\n  .emoji-picker.auto .emoji-picker__search::placeholder {\n    color: var(--dark-search-placeholder-color);\n  }\n\n  .emoji-picker.auto .emoji-picker__search:focus {\n    border-color: var(--dark-search-focus-border-color);\n  }\n\n  .emoji-picker.auto .emoji-picker__search-not-found {\n    color: var(--dark-secondary-text-color);\n  }\n\n  .emoji-picker.auto .emoji-picker__search-not-found h2 {\n    color: var(--dark-secondary-text-color);\n  }\n\n  .emoji-picker.auto .emoji-picker__variant-popup {\n    background: var(--dark-popup-background-color);\n  }\n}');var n=["input","select","textarea","a[href]","button","[tabindex]","audio[controls]","video[controls]",'[contenteditable]:not([contenteditable="false"])'],a=n.join(","),i="undefined"==typeof Element?function(){}:Element.prototype.matches||Element.prototype.msMatchesSelector||Element.prototype.webkitMatchesSelector;function r(e,o){o=o||{};var n,r,m,s=[],u=[],g=e.querySelectorAll(a);for(o.includeContainer&&i.call(e,a)&&(g=Array.prototype.slice.apply(g)).unshift(e),n=0;n<g.length;n++)t(r=g[n])&&(0===(m=c(r))?s.push(r):u.push({documentOrder:n,tabIndex:m,node:r}));return u.sort(d).map((function(e){return e.node})).concat(s)}function t(e){return!(!m(e)||function(e){return function(e){return u(e)&&"radio"===e.type}(e)&&!function(e){if(!e.name)return!0;var o=function(e){for(var o=0;o<e.length;o++)if(e[o].checked)return e[o]}(e.ownerDocument.querySelectorAll('input[type="radio"][name="'+e.name+'"]'));return!o||o===e}(e)}(e)||c(e)<0)}function m(e){return!(e.disabled||function(e){return u(e)&&"hidden"===e.type}(e)||function(e){return null===e.offsetParent||"hidden"===getComputedStyle(e).visibility}(e))}r.isTabbable=function(e){if(!e)throw new Error("No node provided");return!1!==i.call(e,a)&&t(e)},r.isFocusable=function(e){if(!e)throw new Error("No node provided");return!1!==i.call(e,s)&&m(e)};var s=n.concat("iframe").join(",");function c(e){var o=parseInt(e.getAttribute("tabindex"),10);return isNaN(o)?function(e){return"true"===e.contentEditable}(e)?0:e.tabIndex:o}function d(e,o){return e.tabIndex===o.tabIndex?e.documentOrder-o.documentOrder:e.tabIndex-o.tabIndex}function u(e){return"INPUT"===e.tagName}var g,v=r,l=function(){for(var e={},o=0;o<arguments.length;o++){var n=arguments[o];for(var a in n)f.call(n,a)&&(e[a]=n[a])}return e},f=Object.prototype.hasOwnProperty;var y,j=(y=[],{activateTrap:function(e){if(y.length>0){var o=y[y.length-1];o!==e&&o.pause()}var n=y.indexOf(e);-1===n?y.push(e):(y.splice(n,1),y.push(e))},deactivateTrap:function(e){var o=y.indexOf(e);-1!==o&&y.splice(o,1),y.length>0&&y[y.length-1].unpause()}});function p(e){return setTimeout(e,0)}var h=function(e,o){var n=document,a="string"==typeof e?n.querySelector(e):e,i=l({returnFocusOnDeactivate:!0,escapeDeactivates:!0},o),r={firstTabbableNode:null,lastTabbableNode:null,nodeFocusedBeforeActivation:null,mostRecentlyFocusedNode:null,active:!1,paused:!1},t={activate:function(e){if(r.active)return;w(),r.active=!0,r.paused=!1,r.nodeFocusedBeforeActivation=n.activeElement;var o=e&&e.onActivate?e.onActivate:i.onActivate;o&&o();return s(),t},deactivate:m,pause:function(){if(r.paused||!r.active)return;r.paused=!0,c()},unpause:function(){if(!r.paused||!r.active)return;r.paused=!1,w(),s()}};return t;function m(e){if(r.active){clearTimeout(g),c(),r.active=!1,r.paused=!1,j.deactivateTrap(t);var o=e&&void 0!==e.onDeactivate?e.onDeactivate:i.onDeactivate;return o&&o(),(e&&void 0!==e.returnFocus?e.returnFocus:i.returnFocusOnDeactivate)&&p((function(){var e;k((e=r.nodeFocusedBeforeActivation,d("setReturnFocus")||e))})),t}}function s(){if(r.active)return j.activateTrap(t),g=p((function(){k(u())})),n.addEventListener("focusin",y,!0),n.addEventListener("mousedown",f,{capture:!0,passive:!1}),n.addEventListener("touchstart",f,{capture:!0,passive:!1}),n.addEventListener("click",b,{capture:!0,passive:!1}),n.addEventListener("keydown",h,{capture:!0,passive:!1}),t}function c(){if(r.active)return n.removeEventListener("focusin",y,!0),n.removeEventListener("mousedown",f,!0),n.removeEventListener("touchstart",f,!0),n.removeEventListener("click",b,!0),n.removeEventListener("keydown",h,!0),t}function d(e){var o=i[e],a=o;if(!o)return null;if("string"==typeof o&&!(a=n.querySelector(o)))throw new Error("`"+e+"` refers to no known node");if("function"==typeof o&&!(a=o()))throw new Error("`"+e+"` did not return a node");return a}function u(){var e;if(!(e=null!==d("initialFocus")?d("initialFocus"):a.contains(n.activeElement)?n.activeElement:r.firstTabbableNode||d("fallbackFocus")))throw new Error("Your focus-trap needs to have at least one focusable element");return e}function f(e){a.contains(e.target)||(i.clickOutsideDeactivates?m({returnFocus:!v.isFocusable(e.target)}):i.allowOutsideClick&&i.allowOutsideClick(e)||e.preventDefault())}function y(e){a.contains(e.target)||e.target instanceof Document||(e.stopImmediatePropagation(),k(r.mostRecentlyFocusedNode||u()))}function h(e){if(!1!==i.escapeDeactivates&&function(e){return"Escape"===e.key||"Esc"===e.key||27===e.keyCode}(e))return e.preventDefault(),void m();(function(e){return"Tab"===e.key||9===e.keyCode})(e)&&function(e){if(w(),e.shiftKey&&e.target===r.firstTabbableNode)return e.preventDefault(),void k(r.lastTabbableNode);if(!e.shiftKey&&e.target===r.lastTabbableNode)e.preventDefault(),k(r.firstTabbableNode)}(e)}function b(e){i.clickOutsideDeactivates||a.contains(e.target)||i.allowOutsideClick&&i.allowOutsideClick(e)||(e.preventDefault(),e.stopImmediatePropagation())}function w(){var e=v(a);r.firstTabbableNode=e[0]||u(),r.lastTabbableNode=e[e.length-1]||u()}function k(e){e!==n.activeElement&&(e&&e.focus?(e.focus(),r.mostRecentlyFocusedNode=e,function(e){return e.tagName&&"input"===e.tagName.toLowerCase()&&"function"==typeof e.select}(e)&&e.select()):k(u()))}};function b(){}b.prototype={on:function(e,o,n){var a=this.e||(this.e={});return(a[e]||(a[e]=[])).push({fn:o,ctx:n}),this},once:function(e,o,n){var a=this;function i(){a.off(e,i),o.apply(n,arguments)}return i._=o,this.on(e,i,n)},emit:function(e){for(var o=[].slice.call(arguments,1),n=((this.e||(this.e={}))[e]||[]).slice(),a=0,i=n.length;a<i;a++)n[a].fn.apply(n[a].ctx,o);return this},off:function(e,o){var n=this.e||(this.e={}),a=n[e],i=[];if(a&&o)for(var r=0,t=a.length;r<t;r++)a[r].fn!==o&&a[r].fn._!==o&&i.push(a[r]);return i.length?n[e]=i:delete n[e],this}};var w=b;function k(e){var o=e.getBoundingClientRect();return{width:o.width,height:o.height,top:o.top,right:o.right,bottom:o.bottom,left:o.left,x:o.left,y:o.top}}function x(e){if("[object Window]"!=={}.toString.call(e)){var o=e.ownerDocument;return o?o.defaultView:window}return e}function E(e){var o=x(e);return{scrollLeft:o.pageXOffset,scrollTop:o.pageYOffset}}function _(e){return e instanceof x(e).Element}function C(e){return e instanceof x(e).HTMLElement}function z(e){return e?(e.nodeName||"").toLowerCase():null}function O(e){return x(e).getComputedStyle(e)}function S(e){return parseFloat(e)||0}function M(e){var o=C(e)?O(e):{};return{top:S(o.borderTopWidth),right:S(o.borderRightWidth),bottom:S(o.borderBottomWidth),left:S(o.borderLeftWidth)}}function I(e,o,n){void 0===n&&(n=!1);var a,i,r=k(e),t={scrollLeft:0,scrollTop:0},m={x:0,y:0};return n||("body"!==z(o)&&(t=(a=o)!==x(a)&&C(a)?{scrollLeft:(i=a).scrollLeft,scrollTop:i.scrollTop}:E(a)),C(o)&&(m=function(e){var o=k(e),n=M(e);return{x:o.x+n.left,y:o.y+n.top}}(o))),{x:r.left+t.scrollLeft-m.x,y:r.top+t.scrollTop-m.y,width:r.width,height:r.height}}function P(e){return{x:e.offsetLeft,y:e.offsetTop,width:e.offsetWidth,height:e.offsetHeight}}function L(e){return"html"===z(e)?e:e.parentNode||e.host||document.ownerDocument||document.documentElement}function A(e,o){void 0===o&&(o=[]);var n=function e(o){if(["html","body","#document"].includes(z(o)))return o.ownerDocument.body;if(C(o)){var n=O(o),a=n.overflow,i=n.overflowX,r=n.overflowY;if(/auto|scroll|overlay|hidden/.test(a+r+i))return o}return e(L(o))}(e),a="body"===z(n),i=a?x(n):n,r=o.concat(i);return a?r:r.concat(A(L(i)))}function N(e){return["table","td","th"].includes(z(e))}b.TinyEmitter=w;function F(e){var o;return!C(e)||!(o=e.offsetParent)||void 0!==window.InstallTrigger&&"fixed"===O(o).position?null:o}function T(e){for(var o=x(e),n=F(e);n&&N(n);)n=F(n);return n&&"body"===z(n)&&"static"===O(n).position?o:n||o}var B="top",D="bottom",R="right",q="left",V=[B,D,R,q],H=V.reduce((function(e,o){return e.concat([o+"-start",o+"-end"])}),[]),K=[].concat(V,["auto"]).reduce((function(e,o){return e.concat([o,o+"-start",o+"-end"])}),[]),U=["beforeRead","read","afterRead","beforeMain","main","afterMain","beforeWrite","write","afterWrite"];function W(e){var o=new Map,n=new Set,a=[];return e.forEach((function(e){o.set(e.name,e)})),e.forEach((function(e){n.has(e.name)||function e(i){n.add(i.name),[].concat(i.requires||[],i.requiresIfExists||[]).forEach((function(a){if(!n.has(a)){var i=o.get(a);i&&e(i)}})),a.push(i)}(e)})),a}function J(e){return e.split("-")[0]}var G={placement:"bottom",modifiers:[],strategy:"absolute"};function X(){for(var e=arguments.length,o=new Array(e),n=0;n<e;n++)o[n]=arguments[n];return!o.some((function(e){return!(e&&"function"==typeof e.getBoundingClientRect)}))}function Y(e){void 0===e&&(e={});var o=e,n=o.defaultModifiers,a=void 0===n?[]:n,i=o.defaultOptions,r=void 0===i?G:i;return function(e,o,n){void 0===n&&(n=r);var i,t,m={placement:"bottom",orderedModifiers:[],options:Object.assign({},G,{},r),modifiersData:{},elements:{reference:e,popper:o},attributes:{},styles:{}},s=[],c=!1,d={state:m,setOptions:function(n){u(),m.options=Object.assign({},r,{},m.options,{},n),m.scrollParents={reference:_(e)?A(e):[],popper:A(o)};var i=function(e){var o=W(e);return U.reduce((function(e,n){return e.concat(o.filter((function(e){return e.phase===n})))}),[])}([].concat(m.options.modifiers.filter((function(e){return!a.find((function(o){return o.name===e.name}))})),a.map((function(e){return Object.assign({},e,{},m.options.modifiers.find((function(o){return o.name===e.name})))}))));return m.orderedModifiers=i.filter((function(e){return e.enabled})),m.orderedModifiers.forEach((function(e){var o=e.name,n=e.options,a=void 0===n?{}:n,i=e.effect;if("function"==typeof i){var r=i({state:m,name:o,instance:d,options:a});s.push(r||function(){})}})),d.update()},forceUpdate:function(){if(!c){var e=m.elements,o=e.reference,n=e.popper;if(X(o,n)){m.rects={reference:I(o,T(n),"fixed"===m.options.strategy),popper:P(n)},m.reset=!1,m.placement=m.options.placement,m.orderedModifiers.forEach((function(e){return m.modifiersData[e.name]=Object.assign({},e.data)}));for(var a=0;a<m.orderedModifiers.length;a++)if(!0!==m.reset){var i=m.orderedModifiers[a],r=i.fn,t=i.options,s=void 0===t?{}:t,u=i.name;"function"==typeof r&&(m=r({state:m,options:s,name:u,instance:d})||m)}else m.reset=!1,a=-1}}},update:(i=function(){return new Promise((function(e){d.forceUpdate(),e(m)}))},function(){return t||(t=new Promise((function(e){Promise.resolve().then((function(){t=void 0,e(i())}))}))),t}),destroy:function(){u(),c=!0}};if(!X(e,o))return d;function u(){s.forEach((function(e){return e()})),s=[]}return d.setOptions(n).then((function(e){!c&&n.onFirstUpdate&&n.onFirstUpdate(e)})),d}}var Z={passive:!0};function Q(e){return e.split("-")[1]}function $(e){return["top","bottom"].includes(e)?"x":"y"}function ee(e){var o,n=e.reference,a=e.element,i=e.placement,r=i?J(i):null,t=i?Q(i):null,m=n.x+n.width/2-a.width/2,s=n.y+n.height/2-a.height/2;switch(r){case B:o={x:m,y:n.y-a.height};break;case D:o={x:m,y:n.y+n.height};break;case R:o={x:n.x+n.width,y:s};break;case q:o={x:n.x-a.width,y:s};break;default:o={x:n.x,y:n.y}}var c=r?$(r):null;if(null!=c){var d="y"===c?"height":"width";switch(t){case"start":o[c]=Math.floor(o[c])-Math.floor(n[d]/2-a[d]/2);break;case"end":o[c]=Math.floor(o[c])+Math.ceil(n[d]/2-a[d]/2)}}return o}function oe(e){return e.ownerDocument.documentElement}var ne={top:"auto",right:"auto",bottom:"auto",left:"auto"};function ae(e){var o,n=e.popper,a=e.popperRect,i=e.placement,r=e.offsets,t=e.position,m=e.gpuAcceleration,s=e.adaptive,c=function(e){var o=e.x,n=e.y,a=window.devicePixelRatio||1;return{x:Math.round(o*a)/a||0,y:Math.round(n*a)/a||0}}(r),d=c.x,u=c.y,g=r.hasOwnProperty("x"),v=r.hasOwnProperty("y"),l=q,f=B;if(s){var y=T(n);y===x(n)&&(y=oe(n)),i===B&&(u=u-y.clientHeight+a.height,f=D),i===q&&(d=d-y.clientWidth+a.width,l=R)}var j,p=Object.assign({position:t},s&&ne);return m?Object.assign({},p,((j={})[f]=v?"0":"",j[l]=g?"0":"",j.transform=(window.devicePixelRatio||1)<2?"translate("+d+"px, "+u+"px)":"translate3d("+d+"px, "+u+"px, 0)",j)):Object.assign({},p,((o={})[f]=v?u+"px":"",o[l]=g?d+"px":"",o.transform="",o))}var ie={left:"right",right:"left",bottom:"top",top:"bottom"};function re(e){return e.replace(/left|right|bottom|top/g,(function(e){return ie[e]}))}var te={start:"end",end:"start"};function me(e){return e.replace(/start|end/g,(function(e){return te[e]}))}function se(e,o){var n=Boolean(o.getRootNode&&o.getRootNode().host);if(e.contains(o))return!0;if(n){var a=o;do{if(a&&a.isSameNode(e))return!0;a=a.parentNode||a.host}while(a)}return!1}function ce(e){return Object.assign({},e,{left:e.x,top:e.y,right:e.x+e.width,bottom:e.y+e.height})}function de(e,o){return"viewport"===o?ce(function(e){var o=x(e);return{width:o.innerWidth,height:o.innerHeight,x:0,y:0}}(e)):C(o)?k(o):ce(function(e){var o=x(e),n=E(e),a=I(oe(e),o);return a.height=Math.max(a.height,o.innerHeight),a.width=Math.max(a.width,o.innerWidth),a.x=-n.scrollLeft,a.y=-n.scrollTop,a}(oe(e)))}function ue(e,o,n){var a="clippingParents"===o?function(e){var o=A(e),n=["absolute","fixed"].includes(O(e).position)&&C(e)?T(e):e;return _(n)?o.filter((function(e){return _(e)&&se(e,n)})):[]}(e):[].concat(o),i=[].concat(a,[n]),r=i[0],t=i.reduce((function(o,n){var a=de(e,n),i=C(n)?function(e){var o=M(e);return{top:o.top,right:e.offsetWidth-(e.clientWidth+o.right),bottom:e.offsetHeight-(e.clientHeight+o.bottom),left:o.left}}(n):{top:0,right:0,bottom:0,left:0};return o.top=Math.max(a.top+i.top,o.top),o.right=Math.min(a.right-i.right,o.right),o.bottom=Math.min(a.bottom-i.bottom,o.bottom),o.left=Math.max(a.left+i.left,o.left),o}),de(e,r));return t.width=t.right-t.left,t.height=t.bottom-t.top,t.x=t.left,t.y=t.top,t}function ge(e){return Object.assign({},{top:0,right:0,bottom:0,left:0},{},e)}function ve(e,o){return o.reduce((function(o,n){return o[n]=e,o}),{})}function le(e,o){void 0===o&&(o={});var n=o,a=n.placement,i=void 0===a?e.placement:a,r=n.boundary,t=void 0===r?"clippingParents":r,m=n.rootBoundary,s=void 0===m?"viewport":m,c=n.elementContext,d=void 0===c?"popper":c,u=n.altBoundary,g=void 0!==u&&u,v=n.padding,l=void 0===v?0:v,f=ge("number"!=typeof l?l:ve(l,V)),y="popper"===d?"reference":"popper",j=e.elements.reference,p=e.rects.popper,h=e.elements[g?y:d],b=ue(_(h)?h:oe(e.elements.popper),t,s),w=k(j),x=ee({reference:w,element:p,strategy:"absolute",placement:i}),E=ce(Object.assign({},p,{},x)),C="popper"===d?E:w,z={top:b.top-C.top+f.top,bottom:C.bottom-b.bottom+f.bottom,left:b.left-C.left+f.left,right:C.right-b.right+f.right},O=e.modifiersData.offset;if("popper"===d&&O){var S=O[i];Object.keys(z).forEach((function(e){var o=[R,D].includes(e)?1:-1,n=[B,D].includes(e)?"y":"x";z[e]+=S[n]*o}))}return z}function fe(e,o,n){return Math.max(e,Math.min(o,n))}function ye(e,o,n){return void 0===n&&(n={x:0,y:0}),{top:e.top-o.height-n.y,right:e.right-o.width+n.x,bottom:e.bottom-o.height+n.y,left:e.left-o.width-n.x}}function je(e){return[B,R,D,q].some((function(o){return e[o]>=0}))}var pe=Y({defaultModifiers:[{name:"eventListeners",enabled:!0,phase:"write",fn:function(){},effect:function(e){var o=e.state,n=e.instance,a=e.options,i=a.scroll,r=void 0===i||i,t=a.resize,m=void 0===t||t,s=x(o.elements.popper),c=[].concat(o.scrollParents.reference,o.scrollParents.popper);return r&&c.forEach((function(e){e.addEventListener("scroll",n.update,Z)})),m&&s.addEventListener("resize",n.update,Z),function(){r&&c.forEach((function(e){e.removeEventListener("scroll",n.update,Z)})),m&&s.removeEventListener("resize",n.update,Z)}},data:{}},{name:"popperOffsets",enabled:!0,phase:"read",fn:function(e){var o=e.state,n=e.name;o.modifiersData[n]=ee({reference:o.rects.reference,element:o.rects.popper,strategy:"absolute",placement:o.placement})},data:{}},{name:"computeStyles",enabled:!0,phase:"beforeWrite",fn:function(e){var o=e.state,n=e.options,a=n.gpuAcceleration,i=void 0===a||a,r=n.adaptive,t=void 0===r||r,m={placement:J(o.placement),popper:o.elements.popper,popperRect:o.rects.popper,gpuAcceleration:i};o.styles.popper=Object.assign({},o.styles.popper,{},ae(Object.assign({},m,{offsets:o.modifiersData.popperOffsets,position:o.options.strategy,adaptive:t}))),null!=o.modifiersData.arrow&&(o.styles.arrow=Object.assign({},o.styles.arrow,{},ae(Object.assign({},m,{offsets:o.modifiersData.arrow,position:"absolute",adaptive:!1})))),o.attributes.popper=Object.assign({},o.attributes.popper,{"data-popper-placement":o.placement})},data:{}},{name:"applyStyles",enabled:!0,phase:"write",fn:function(e){var o=e.state;Object.keys(o.elements).forEach((function(e){var n=o.styles[e]||{},a=o.attributes[e]||{},i=o.elements[e];C(i)&&z(i)&&(Object.assign(i.style,n),Object.entries(a).forEach((function(e){var o=e[0],n=e[1];!1===n?i.removeAttribute(o):i.setAttribute(o,!0===n?"":n)})))}))},effect:function(e){var o=e.state,n={position:"absolute",left:"0",top:"0"};return Object.assign(o.elements.popper.style,n),function(){Object.keys(o.elements).forEach((function(e){var a=o.elements[e],i=Object.keys(o.styles.hasOwnProperty(e)?Object.assign({},o.styles[e]):n),r=o.attributes[e]||{},t=i.reduce((function(e,o){var n;return Object.assign({},e,((n={})[String(o)]="",n))}),{});C(a)&&z(a)&&(Object.assign(a.style,t),Object.keys(r).forEach((function(e){return a.removeAttribute(e)})))}))}},requires:["computeStyles"]},{name:"offset",enabled:!0,phase:"main",requires:["popperOffsets"],fn:function(e){var o=e.state,n=e.options,a=e.name,i=n.offset,r=void 0===i?[0,0]:i,t=K.reduce((function(e,n){return e[n]=function(e,o,n){var a=J(e),i=[q,B].includes(a)?-1:1,r="function"==typeof n?n(Object.assign({},o,{placement:e})):n,t=r[0],m=r[1];return t=t||0,m=(m||0)*i,[q,R].includes(a)?{x:m,y:t}:{x:t,y:m}}(n,o.rects,r),e}),{}),m=t[o.placement],s=m.x,c=m.y;o.modifiersData.popperOffsets.x+=s,o.modifiersData.popperOffsets.y+=c,o.modifiersData[a]=t}},{name:"flip",enabled:!0,phase:"main",fn:function(e){var o=e.state,n=e.options,a=e.name;if(!o.modifiersData[a]._skip){for(var i,r,t,m=n.fallbackPlacements,s=n.padding,c=n.boundary,d=n.rootBoundary,u=n.flipVariations,g=void 0===u||u,v=o.options.placement,l=J(v),f=m||(l===v?[re(v)]:function(e){if("auto"===J(e))return[];var o=re(e);return[me(e),o,me(o)]}(v)),y=(i=[v].concat(f).reduce((function(e,n){return"auto"===J(n)?e.concat(function(e,o){void 0===o&&(o={});var n=o,a=n.placement,i=n.boundary,r=n.rootBoundary,t=n.padding,m=n.flipVariations,s=Q(a),c=(s?m?H:H.filter((function(e){return e.includes(s)})):V).reduce((function(o,n){return o[n]=le(e,{placement:n,boundary:i,rootBoundary:r,padding:t})[J(n)],o}),{});return Object.keys(c).sort((function(e,o){return c[e]-c[o]}))}(o,{placement:n,boundary:c,rootBoundary:d,padding:s,flipVariations:g})):e.concat(n)}),[]),r=function(e){return e},t=new Set,i.filter((function(e){var o=r(e);if(!t.has(o))return t.add(o),!0}))),j=o.rects.reference,p=o.rects.popper,h=new Map,b=!0,w=y[0],k=0;k<y.length;k++){var x=y[k],E=J(x),_="start"===Q(x),C=[B,D].includes(E),z=C?"width":"height",O=le(o,{placement:x,boundary:c,rootBoundary:d,padding:s}),S=C?_?R:q:_?D:B;j[z]>p[z]&&(S=re(S));var M=re(S),I=[O[E]<=0,O[S]<=0,O[M]<=0];if(I.every((function(e){return e}))){w=x,b=!1;break}h.set(x,I)}if(b)for(var P=function(e){var o=y.find((function(o){var n=h.get(o);if(n)return n.slice(0,e).every((function(e){return e}))}));if(o)return w=o,"break"},L=g?3:1;L>0;L--){if("break"===P(L))break}o.placement!==w&&(o.modifiersData[a]._skip=!0,o.placement=w,o.reset=!0)}},requiresIfExists:["offset"],data:{_skip:!1}},{name:"preventOverflow",enabled:!0,phase:"main",fn:function(e){var o=e.state,n=e.options,a=e.name,i=n.mainAxis,r=void 0===i||i,t=n.altAxis,m=void 0!==t&&t,s=n.boundary,c=n.rootBoundary,d=n.padding,u=n.tether,g=void 0===u||u,v=n.tetherOffset,l=void 0===v?0:v,f=le(o,{boundary:s,rootBoundary:c,padding:d}),y=J(o.placement),j=Q(o.placement),p=!j,h=$(y),b="x"===h?"y":"x",w=o.modifiersData.popperOffsets,k=o.rects.reference,x=o.rects.popper,E="function"==typeof l?l(Object.assign({},o.rects,{placement:o.placement})):l,_={x:0,y:0};if(r){var C="y"===h?B:q,z="y"===h?D:R,O="y"===h?"height":"width",S=w[h],M=w[h]+f[C],I=w[h]-f[z],L=g?-x[O]/2:0,A="start"===j?k[O]:x[O],N="start"===j?-x[O]:-k[O],F=o.elements.arrow,T=g&&F?P(F):{width:0,height:0},V=o.modifiersData["arrow#persistent"]?o.modifiersData["arrow#persistent"].padding:{top:0,right:0,bottom:0,left:0},H=V[C],K=V[z],U=fe(0,Math.abs(k[O]-T[O]),T[O]),W=p?k[O]/2-L-U-H-E:A-U-H-E,G=p?-k[O]/2+L+U+K+E:N+U+K+E,X=o.modifiersData.offset?o.modifiersData.offset[o.placement][h]:0,Y=o.modifiersData.popperOffsets[h]+W-X,Z=o.modifiersData.popperOffsets[h]+G-X,ee=fe(g?Math.min(M,Y):M,S,g?Math.max(I,Z):I);o.modifiersData.popperOffsets[h]=ee,_[h]=ee-S}if(m){var oe="x"===h?B:q,ne="x"===h?D:R,ae=w[b],ie=fe(ae+f[oe],ae,ae-f[ne]);o.modifiersData.popperOffsets[b]=ie,_[b]=ie-ae}o.modifiersData[a]=_},requiresIfExists:["offset"]},{name:"arrow",enabled:!0,phase:"main",fn:function(e){var o,n=e.state,a=e.name,i=n.elements.arrow,r=n.modifiersData.popperOffsets,t=J(n.placement),m=$(t),s=[q,R].includes(t)?"height":"width";if(i){var c=n.modifiersData[a+"#persistent"].padding,d=P(i),u="y"===m?B:q,g="y"===m?D:R,v=(n.rects.reference[s]+n.rects.reference[m]-r[m]-n.rects.popper[s])/2-(r[m]-n.rects.reference[m])/2,l=fe(c[u],n.rects.popper[s]/2-d[s]/2+v,n.rects.popper[s]-d[s]-c[g]),f=m;n.modifiersData[a]=((o={})[f]=l,o)}},effect:function(e){var o=e.state,n=e.options,a=e.name,i=n.element,r=void 0===i?"[data-popper-arrow]":i,t=n.padding,m=void 0===t?0:t;("string"!=typeof r||(r=o.elements.popper.querySelector(r)))&&se(o.elements.popper,r)&&(o.elements.arrow=r,o.modifiersData[a+"#persistent"]={padding:ge("number"!=typeof m?m:ve(m,V))})},requires:["popperOffsets"],requiresIfExists:["preventOverflow"]},{name:"hide",enabled:!0,phase:"main",requiresIfExists:["preventOverflow"],fn:function(e){var o=e.state,n=e.name,a=o.rects.reference,i=o.rects.popper,r=o.modifiersData.preventOverflow,t=le(o,{elementContext:"reference"}),m=le(o,{altBoundary:!0}),s=ye(t,a),c=ye(m,i,r),d=je(s),u=je(c);o.modifiersData[n]={referenceClippingOffsets:s,popperEscapeOffsets:c,isReferenceHidden:d,hasPopperEscaped:u},o.attributes.popper=Object.assign({},o.attributes.popper,{"data-popper-reference-hidden":d,"data-popper-escaped":u})}}]}),he=("undefined"!=typeof globalThis?globalThis:"undefined"!=typeof window?window:"undefined"!=typeof global?global:"undefined"!=typeof self?self:{}).location||{},be=function(){var e={base:"https://twemoji.maxcdn.com/v/12.1.5/",ext:".png",size:"72x72",className:"emoji",convert:{fromCodePoint:function(e){var o="string"==typeof e?parseInt(e,16):e;if(o<65536)return m(o);return m(55296+((o-=65536)>>10),56320+(1023&o))},toCodePoint:y},onerror:function(){this.parentNode&&this.parentNode.replaceChild(s(this.alt,!1),this)},parse:function(o,n){n&&"function"!=typeof n||(n={callback:n});return("string"==typeof o?g:u)(o,{callback:n.callback||c,attributes:"function"==typeof n.attributes?n.attributes:l,base:"string"==typeof n.base?n.base:e.base,ext:n.ext||e.ext,size:n.folder||(a=n.size||e.size,"number"==typeof a?a+"x"+a:a),className:n.className||e.className,onerror:n.onerror||e.onerror});var a},replace:f,test:function(e){n.lastIndex=0;var o=n.test(e);return n.lastIndex=0,o}},o={"&":"&amp;","<":"&lt;",">":"&gt;","'":"&#39;",'"':"&quot;"},n=/(?:\ud83d\udc68\ud83c\udffb\u200d\ud83e\udd1d\u200d\ud83d\udc68\ud83c[\udffc-\udfff]|\ud83d\udc68\ud83c\udffc\u200d\ud83e\udd1d\u200d\ud83d\udc68\ud83c[\udffb\udffd-\udfff]|\ud83d\udc68\ud83c\udffd\u200d\ud83e\udd1d\u200d\ud83d\udc68\ud83c[\udffb\udffc\udffe\udfff]|\ud83d\udc68\ud83c\udffe\u200d\ud83e\udd1d\u200d\ud83d\udc68\ud83c[\udffb-\udffd\udfff]|\ud83d\udc68\ud83c\udfff\u200d\ud83e\udd1d\u200d\ud83d\udc68\ud83c[\udffb-\udffe]|\ud83d\udc69\ud83c\udffb\u200d\ud83e\udd1d\u200d\ud83d\udc68\ud83c[\udffc-\udfff]|\ud83d\udc69\ud83c\udffb\u200d\ud83e\udd1d\u200d\ud83d\udc69\ud83c[\udffc-\udfff]|\ud83d\udc69\ud83c\udffc\u200d\ud83e\udd1d\u200d\ud83d\udc68\ud83c[\udffb\udffd-\udfff]|\ud83d\udc69\ud83c\udffc\u200d\ud83e\udd1d\u200d\ud83d\udc69\ud83c[\udffb\udffd-\udfff]|\ud83d\udc69\ud83c\udffd\u200d\ud83e\udd1d\u200d\ud83d\udc68\ud83c[\udffb\udffc\udffe\udfff]|\ud83d\udc69\ud83c\udffd\u200d\ud83e\udd1d\u200d\ud83d\udc69\ud83c[\udffb\udffc\udffe\udfff]|\ud83d\udc69\ud83c\udffe\u200d\ud83e\udd1d\u200d\ud83d\udc68\ud83c[\udffb-\udffd\udfff]|\ud83d\udc69\ud83c\udffe\u200d\ud83e\udd1d\u200d\ud83d\udc69\ud83c[\udffb-\udffd\udfff]|\ud83d\udc69\ud83c\udfff\u200d\ud83e\udd1d\u200d\ud83d\udc68\ud83c[\udffb-\udffe]|\ud83d\udc69\ud83c\udfff\u200d\ud83e\udd1d\u200d\ud83d\udc69\ud83c[\udffb-\udffe]|\ud83e\uddd1\ud83c\udffb\u200d\ud83e\udd1d\u200d\ud83e\uddd1\ud83c[\udffb-\udfff]|\ud83e\uddd1\ud83c\udffc\u200d\ud83e\udd1d\u200d\ud83e\uddd1\ud83c[\udffb-\udfff]|\ud83e\uddd1\ud83c\udffd\u200d\ud83e\udd1d\u200d\ud83e\uddd1\ud83c[\udffb-\udfff]|\ud83e\uddd1\ud83c\udffe\u200d\ud83e\udd1d\u200d\ud83e\uddd1\ud83c[\udffb-\udfff]|\ud83e\uddd1\ud83c\udfff\u200d\ud83e\udd1d\u200d\ud83e\uddd1\ud83c[\udffb-\udfff]|\ud83e\uddd1\u200d\ud83e\udd1d\u200d\ud83e\uddd1|\ud83d\udc6b\ud83c[\udffb-\udfff]|\ud83d\udc6c\ud83c[\udffb-\udfff]|\ud83d\udc6d\ud83c[\udffb-\udfff]|\ud83d[\udc6b-\udc6d])|(?:\ud83d[\udc68\udc69]|\ud83e\uddd1)(?:\ud83c[\udffb-\udfff])?\u200d(?:\u2695\ufe0f|\u2696\ufe0f|\u2708\ufe0f|\ud83c[\udf3e\udf73\udf93\udfa4\udfa8\udfeb\udfed]|\ud83d[\udcbb\udcbc\udd27\udd2c\ude80\ude92]|\ud83e[\uddaf-\uddb3\uddbc\uddbd])|(?:\ud83c[\udfcb\udfcc]|\ud83d[\udd74\udd75]|\u26f9)((?:\ud83c[\udffb-\udfff]|\ufe0f)\u200d[\u2640\u2642]\ufe0f)|(?:\ud83c[\udfc3\udfc4\udfca]|\ud83d[\udc6e\udc71\udc73\udc77\udc81\udc82\udc86\udc87\ude45-\ude47\ude4b\ude4d\ude4e\udea3\udeb4-\udeb6]|\ud83e[\udd26\udd35\udd37-\udd39\udd3d\udd3e\uddb8\uddb9\uddcd-\uddcf\uddd6-\udddd])(?:\ud83c[\udffb-\udfff])?\u200d[\u2640\u2642]\ufe0f|(?:\ud83d\udc68\u200d\u2764\ufe0f\u200d\ud83d\udc8b\u200d\ud83d\udc68|\ud83d\udc68\u200d\ud83d\udc68\u200d\ud83d\udc66\u200d\ud83d\udc66|\ud83d\udc68\u200d\ud83d\udc68\u200d\ud83d\udc67\u200d\ud83d[\udc66\udc67]|\ud83d\udc68\u200d\ud83d\udc69\u200d\ud83d\udc66\u200d\ud83d\udc66|\ud83d\udc68\u200d\ud83d\udc69\u200d\ud83d\udc67\u200d\ud83d[\udc66\udc67]|\ud83d\udc69\u200d\u2764\ufe0f\u200d\ud83d\udc8b\u200d\ud83d[\udc68\udc69]|\ud83d\udc69\u200d\ud83d\udc69\u200d\ud83d\udc66\u200d\ud83d\udc66|\ud83d\udc69\u200d\ud83d\udc69\u200d\ud83d\udc67\u200d\ud83d[\udc66\udc67]|\ud83d\udc68\u200d\u2764\ufe0f\u200d\ud83d\udc68|\ud83d\udc68\u200d\ud83d\udc66\u200d\ud83d\udc66|\ud83d\udc68\u200d\ud83d\udc67\u200d\ud83d[\udc66\udc67]|\ud83d\udc68\u200d\ud83d\udc68\u200d\ud83d[\udc66\udc67]|\ud83d\udc68\u200d\ud83d\udc69\u200d\ud83d[\udc66\udc67]|\ud83d\udc69\u200d\u2764\ufe0f\u200d\ud83d[\udc68\udc69]|\ud83d\udc69\u200d\ud83d\udc66\u200d\ud83d\udc66|\ud83d\udc69\u200d\ud83d\udc67\u200d\ud83d[\udc66\udc67]|\ud83d\udc69\u200d\ud83d\udc69\u200d\ud83d[\udc66\udc67]|\ud83c\udff3\ufe0f\u200d\u26a7\ufe0f|\ud83c\udff3\ufe0f\u200d\ud83c\udf08|\ud83c\udff4\u200d\u2620\ufe0f|\ud83d\udc15\u200d\ud83e\uddba|\ud83d\udc41\u200d\ud83d\udde8|\ud83d\udc68\u200d\ud83d[\udc66\udc67]|\ud83d\udc69\u200d\ud83d[\udc66\udc67]|\ud83d\udc6f\u200d\u2640\ufe0f|\ud83d\udc6f\u200d\u2642\ufe0f|\ud83e\udd3c\u200d\u2640\ufe0f|\ud83e\udd3c\u200d\u2642\ufe0f|\ud83e\uddde\u200d\u2640\ufe0f|\ud83e\uddde\u200d\u2642\ufe0f|\ud83e\udddf\u200d\u2640\ufe0f|\ud83e\udddf\u200d\u2642\ufe0f)|[#*0-9]\ufe0f?\u20e3|(?:[©®\u2122\u265f]\ufe0f)|(?:\ud83c[\udc04\udd70\udd71\udd7e\udd7f\ude02\ude1a\ude2f\ude37\udf21\udf24-\udf2c\udf36\udf7d\udf96\udf97\udf99-\udf9b\udf9e\udf9f\udfcd\udfce\udfd4-\udfdf\udff3\udff5\udff7]|\ud83d[\udc3f\udc41\udcfd\udd49\udd4a\udd6f\udd70\udd73\udd76-\udd79\udd87\udd8a-\udd8d\udda5\udda8\uddb1\uddb2\uddbc\uddc2-\uddc4\uddd1-\uddd3\udddc-\uddde\udde1\udde3\udde8\uddef\uddf3\uddfa\udecb\udecd-\udecf\udee0-\udee5\udee9\udef0\udef3]|[\u203c\u2049\u2139\u2194-\u2199\u21a9\u21aa\u231a\u231b\u2328\u23cf\u23ed-\u23ef\u23f1\u23f2\u23f8-\u23fa\u24c2\u25aa\u25ab\u25b6\u25c0\u25fb-\u25fe\u2600-\u2604\u260e\u2611\u2614\u2615\u2618\u2620\u2622\u2623\u2626\u262a\u262e\u262f\u2638-\u263a\u2640\u2642\u2648-\u2653\u2660\u2663\u2665\u2666\u2668\u267b\u267f\u2692-\u2697\u2699\u269b\u269c\u26a0\u26a1\u26a7\u26aa\u26ab\u26b0\u26b1\u26bd\u26be\u26c4\u26c5\u26c8\u26cf\u26d1\u26d3\u26d4\u26e9\u26ea\u26f0-\u26f5\u26f8\u26fa\u26fd\u2702\u2708\u2709\u270f\u2712\u2714\u2716\u271d\u2721\u2733\u2734\u2744\u2747\u2757\u2763\u2764\u27a1\u2934\u2935\u2b05-\u2b07\u2b1b\u2b1c\u2b50\u2b55\u3030\u303d\u3297\u3299])(?:\ufe0f|(?!\ufe0e))|(?:(?:\ud83c[\udfcb\udfcc]|\ud83d[\udd74\udd75\udd90]|[\u261d\u26f7\u26f9\u270c\u270d])(?:\ufe0f|(?!\ufe0e))|(?:\ud83c[\udf85\udfc2-\udfc4\udfc7\udfca]|\ud83d[\udc42\udc43\udc46-\udc50\udc66-\udc69\udc6e\udc70-\udc78\udc7c\udc81-\udc83\udc85-\udc87\udcaa\udd7a\udd95\udd96\ude45-\ude47\ude4b-\ude4f\udea3\udeb4-\udeb6\udec0\udecc]|\ud83e[\udd0f\udd18-\udd1c\udd1e\udd1f\udd26\udd30-\udd39\udd3d\udd3e\uddb5\uddb6\uddb8\uddb9\uddbb\uddcd-\uddcf\uddd1-\udddd]|[\u270a\u270b]))(?:\ud83c[\udffb-\udfff])?|(?:\ud83c\udff4\udb40\udc67\udb40\udc62\udb40\udc65\udb40\udc6e\udb40\udc67\udb40\udc7f|\ud83c\udff4\udb40\udc67\udb40\udc62\udb40\udc73\udb40\udc63\udb40\udc74\udb40\udc7f|\ud83c\udff4\udb40\udc67\udb40\udc62\udb40\udc77\udb40\udc6c\udb40\udc73\udb40\udc7f|\ud83c\udde6\ud83c[\udde8-\uddec\uddee\uddf1\uddf2\uddf4\uddf6-\uddfa\uddfc\uddfd\uddff]|\ud83c\udde7\ud83c[\udde6\udde7\udde9-\uddef\uddf1-\uddf4\uddf6-\uddf9\uddfb\uddfc\uddfe\uddff]|\ud83c\udde8\ud83c[\udde6\udde8\udde9\uddeb-\uddee\uddf0-\uddf5\uddf7\uddfa-\uddff]|\ud83c\udde9\ud83c[\uddea\uddec\uddef\uddf0\uddf2\uddf4\uddff]|\ud83c\uddea\ud83c[\udde6\udde8\uddea\uddec\udded\uddf7-\uddfa]|\ud83c\uddeb\ud83c[\uddee-\uddf0\uddf2\uddf4\uddf7]|\ud83c\uddec\ud83c[\udde6\udde7\udde9-\uddee\uddf1-\uddf3\uddf5-\uddfa\uddfc\uddfe]|\ud83c\udded\ud83c[\uddf0\uddf2\uddf3\uddf7\uddf9\uddfa]|\ud83c\uddee\ud83c[\udde8-\uddea\uddf1-\uddf4\uddf6-\uddf9]|\ud83c\uddef\ud83c[\uddea\uddf2\uddf4\uddf5]|\ud83c\uddf0\ud83c[\uddea\uddec-\uddee\uddf2\uddf3\uddf5\uddf7\uddfc\uddfe\uddff]|\ud83c\uddf1\ud83c[\udde6-\udde8\uddee\uddf0\uddf7-\uddfb\uddfe]|\ud83c\uddf2\ud83c[\udde6\udde8-\udded\uddf0-\uddff]|\ud83c\uddf3\ud83c[\udde6\udde8\uddea-\uddec\uddee\uddf1\uddf4\uddf5\uddf7\uddfa\uddff]|\ud83c\uddf4\ud83c\uddf2|\ud83c\uddf5\ud83c[\udde6\uddea-\udded\uddf0-\uddf3\uddf7-\uddf9\uddfc\uddfe]|\ud83c\uddf6\ud83c\udde6|\ud83c\uddf7\ud83c[\uddea\uddf4\uddf8\uddfa\uddfc]|\ud83c\uddf8\ud83c[\udde6-\uddea\uddec-\uddf4\uddf7-\uddf9\uddfb\uddfd-\uddff]|\ud83c\uddf9\ud83c[\udde6\udde8\udde9\uddeb-\udded\uddef-\uddf4\uddf7\uddf9\uddfb\uddfc\uddff]|\ud83c\uddfa\ud83c[\udde6\uddec\uddf2\uddf3\uddf8\uddfe\uddff]|\ud83c\uddfb\ud83c[\udde6\udde8\uddea\uddec\uddee\uddf3\uddfa]|\ud83c\uddfc\ud83c[\uddeb\uddf8]|\ud83c\uddfd\ud83c\uddf0|\ud83c\uddfe\ud83c[\uddea\uddf9]|\ud83c\uddff\ud83c[\udde6\uddf2\uddfc]|\ud83c[\udccf\udd8e\udd91-\udd9a\udde6-\uddff\ude01\ude32-\ude36\ude38-\ude3a\ude50\ude51\udf00-\udf20\udf2d-\udf35\udf37-\udf7c\udf7e-\udf84\udf86-\udf93\udfa0-\udfc1\udfc5\udfc6\udfc8\udfc9\udfcf-\udfd3\udfe0-\udff0\udff4\udff8-\udfff]|\ud83d[\udc00-\udc3e\udc40\udc44\udc45\udc51-\udc65\udc6a\udc6f\udc79-\udc7b\udc7d-\udc80\udc84\udc88-\udca9\udcab-\udcfc\udcff-\udd3d\udd4b-\udd4e\udd50-\udd67\udda4\uddfb-\ude44\ude48-\ude4a\ude80-\udea2\udea4-\udeb3\udeb7-\udebf\udec1-\udec5\uded0-\uded2\uded5\udeeb\udeec\udef4-\udefa\udfe0-\udfeb]|\ud83e[\udd0d\udd0e\udd10-\udd17\udd1d\udd20-\udd25\udd27-\udd2f\udd3a\udd3c\udd3f-\udd45\udd47-\udd71\udd73-\udd76\udd7a-\udda2\udda5-\uddaa\uddae-\uddb4\uddb7\uddba\uddbc-\uddca\uddd0\uddde-\uddff\ude70-\ude73\ude78-\ude7a\ude80-\ude82\ude90-\ude95]|[\u23e9-\u23ec\u23f0\u23f3\u267e\u26ce\u2705\u2728\u274c\u274e\u2753-\u2755\u2795-\u2797\u27b0\u27bf\ue50a])|\ufe0f/g,a=/\uFE0F/g,i=String.fromCharCode(8205),r=/[&<>'"]/g,t=/^(?:iframe|noframes|noscript|script|select|style|textarea)$/,m=String.fromCharCode;return e;function s(e,o){return document.createTextNode(o?e.replace(a,""):e)}function c(e,o){return"".concat(o.base,o.size,"/",e,o.ext)}function d(e){return y(e.indexOf(i)<0?e.replace(a,""):e)}function u(e,o){for(var a,i,r,m,c,u,g,v,l,f,y,j,p,h=function e(o,n){for(var a,i,r=o.childNodes,m=r.length;m--;)3===(i=(a=r[m]).nodeType)?n.push(a):1!==i||"ownerSVGElement"in a||t.test(a.nodeName.toLowerCase())||e(a,n);return n}(e,[]),b=h.length;b--;){for(r=!1,m=document.createDocumentFragment(),u=(c=h[b]).nodeValue,v=0;g=n.exec(u);){if((l=g.index)!==v&&m.appendChild(s(u.slice(v,l),!0)),j=d(y=g[0]),v=l+y.length,p=o.callback(j,o),j&&p){for(i in(f=new Image).onerror=o.onerror,f.setAttribute("draggable","false"),a=o.attributes(y,j))a.hasOwnProperty(i)&&0!==i.indexOf("on")&&!f.hasAttribute(i)&&f.setAttribute(i,a[i]);f.className=o.className,f.alt=y,f.src=p,r=!0,m.appendChild(f)}f||m.appendChild(s(y,!1)),f=null}r&&(v<u.length&&m.appendChild(s(u.slice(v),!0)),c.parentNode.replaceChild(m,c))}return e}function g(e,o){return f(e,(function(e){var n,a,i=e,t=d(e),m=o.callback(t,o);if(t&&m){for(a in i="<img ".concat('class="',o.className,'" ','draggable="false" ','alt="',e,'"',' src="',m,'"'),n=o.attributes(e,t))n.hasOwnProperty(a)&&0!==a.indexOf("on")&&-1===i.indexOf(" "+a+"=")&&(i=i.concat(" ",a,'="',n[a].replace(r,v),'"'));i=i.concat("/>")}return i}))}function v(e){return o[e]}function l(){return null}function f(e,o){return String(e).replace(n,o)}function y(e,o){for(var n=[],a=0,i=0,r=0;r<e.length;)a=e.charCodeAt(r++),i?(n.push((65536+(i-55296<<10)+(a-56320)).toString(16)),i=0):55296<=a&&a<=56319?i=a:n.push(a.toString(16));return n.join(o||"-")}}();he.protocol||(be.base=be.base.replace(/^http:/,""));var we=be,ke={categories:["smileys","people","animals","food","travel","activities","objects","symbols","flags"],emoji:[{emoji:"😀",category:0,name:"grinning face",version:"1.0"},{emoji:"😃",category:0,name:"grinning face with big eyes",version:"1.0"},{emoji:"😄",category:0,name:"grinning face with smiling eyes",version:"1.0"},{emoji:"😁",category:0,name:"beaming face with smiling eyes",version:"1.0"},{emoji:"😆",category:0,name:"grinning squinting face",version:"1.0"},{emoji:"😅",category:0,name:"grinning face with sweat",version:"1.0"},{emoji:"🤣",category:0,name:"rolling on the floor laughing",version:"3.0"},{emoji:"😂",category:0,name:"face with tears of joy",version:"1.0"},{emoji:"🙂",category:0,name:"slightly smiling face",version:"1.0"},{emoji:"🙃",category:0,name:"upside-down face",version:"1.0"},{emoji:"😉",category:0,name:"winking face",version:"1.0"},{emoji:"😊",category:0,name:"smiling face with smiling eyes",version:"1.0"},{emoji:"😇",category:0,name:"smiling face with halo",version:"1.0"},{emoji:"🥰",category:0,name:"smiling face with hearts",version:"11.0"},{emoji:"😍",category:0,name:"smiling face with heart-eyes",version:"1.0"},{emoji:"🤩",category:0,name:"star-struck",version:"5.0"},{emoji:"😘",category:0,name:"face blowing a kiss",version:"1.0"},{emoji:"😗",category:0,name:"kissing face",version:"1.0"},{emoji:"☺️",category:0,name:"smiling face",version:"1.0"},{emoji:"😚",category:0,name:"kissing face with closed eyes",version:"1.0"},{emoji:"😙",category:0,name:"kissing face with smiling eyes",version:"1.0"},{emoji:"🥲",category:0,name:"smiling face with tear",version:"13.0"},{emoji:"😋",category:0,name:"face savoring food",version:"1.0"},{emoji:"😛",category:0,name:"face with tongue",version:"1.0"},{emoji:"😜",category:0,name:"winking face with tongue",version:"1.0"},{emoji:"😝",category:0,name:"squinting face with tongue",version:"1.0"},{emoji:"🤑",category:0,name:"money-mouth face",version:"1.0"},{emoji:"🤗",category:0,name:"hugging face",version:"1.0"},{emoji:"🤭",category:0,name:"face with hand over mouth",version:"5.0"},{emoji:"🤫",category:0,name:"shushing face",version:"5.0"},{emoji:"🤔",category:0,name:"thinking face",version:"1.0"},{emoji:"🤐",category:0,name:"zipper-mouth face",version:"1.0"},{emoji:"🤨",category:0,name:"face with raised eyebrow",version:"5.0"},{emoji:"😐",category:0,name:"neutral face",version:"1.0"},{emoji:"😑",category:0,name:"expressionless face",version:"1.0"},{emoji:"😶",category:0,name:"face without mouth",version:"1.0"},{emoji:"😏",category:0,name:"smirking face",version:"1.0"},{emoji:"😒",category:0,name:"unamused face",version:"1.0"},{emoji:"🙄",category:0,name:"face with rolling eyes",version:"1.0"},{emoji:"😬",category:0,name:"grimacing face",version:"1.0"},{emoji:"🤥",category:0,name:"lying face",version:"3.0"},{emoji:"😌",category:0,name:"relieved face",version:"1.0"},{emoji:"😔",category:0,name:"pensive face",version:"1.0"},{emoji:"😪",category:0,name:"sleepy face",version:"1.0"},{emoji:"🤤",category:0,name:"drooling face",version:"3.0"},{emoji:"🥶",category:0,name:"cold face",version:"11.0"},{emoji:"🥴",category:0,name:"woozy face",version:"11.0"},{emoji:"😵",category:0,name:"dizzy face",version:"1.0"},{emoji:"💚",category:0,name:"green heart",version:"1.0"}]};function xe(e,o){var n=document.createElement(e);return o&&(n.className=o),n}function Ee(e){for(;e.firstChild;)e.removeChild(e.firstChild)}var _e=function(){function e(e,o){this.events=e,this.options=o}return e.prototype.render=function(){var e=this,o=xe("div","emoji-picker__preview");return this.emoji=xe("div","emoji-picker__preview-emoji"),o.appendChild(this.emoji),this.name=xe("div","emoji-picker__preview-name"),o.appendChild(this.name),this.events.on("showPreview",(function(o){return e.showPreview(o)})),this.events.on("hidePreview",(function(){return e.hidePreview()})),o},e.prototype.showPreview=function(e){this.emoji.innerHTML="native"===this.options.style?e.emoji:we.parse(e.emoji),this.name.innerHTML=e.name},e.prototype.hidePreview=function(){this.emoji.innerHTML="",this.name.innerHTML=""},e}();function Ce(e,o){for(var n=0;n<o.length;n++){var a=o[n];a.enumerable=a.enumerable||!1,a.configurable=!0,"value"in a&&(a.writable=!0),Object.defineProperty(e,a.key,a)}}function ze(e,o,n){return o in e?Object.defineProperty(e,o,{value:n,enumerable:!0,configurable:!0,writable:!0}):e[o]=n,e}function Oe(e){for(var o=1;o<arguments.length;o++){var n=null!=arguments[o]?arguments[o]:{},a=Object.keys(n);"function"==typeof Object.getOwnPropertySymbols&&(a=a.concat(Object.getOwnPropertySymbols(n).filter((function(e){return Object.getOwnPropertyDescriptor(n,e).enumerable})))),a.forEach((function(o){ze(e,o,n[o])}))}return e}function Se(e,o){return function(e){if(Array.isArray(e))return e}(e)||function(e,o){var n=[],a=!0,i=!1,r=void 0;try{for(var t,m=e[Symbol.iterator]();!(a=(t=m.next()).done)&&(n.push(t.value),!o||n.length!==o);a=!0);}catch(e){i=!0,r=e}finally{try{a||null==m.return||m.return()}finally{if(i)throw r}}return n}(e,o)||function(){throw new TypeError("Invalid attempt to destructure non-iterable instance")}()}var Me=function(){},Ie={},Pe={},Le={mark:Me,measure:Me};try{"undefined"!=typeof window&&(Ie=window),"undefined"!=typeof document&&(Pe=document),"undefined"!=typeof MutationObserver&&MutationObserver,"undefined"!=typeof performance&&(Le=performance)}catch(e){}var Ae=(Ie.navigator||{}).userAgent,Ne=void 0===Ae?"":Ae,Fe=Ie,Te=Pe,Be=Le,De=(Fe.document,!!Te.documentElement&&!!Te.head&&"function"==typeof Te.addEventListener&&"function"==typeof Te.createElement),Re=(~Ne.indexOf("MSIE")||Ne.indexOf("Trident/"),function(){try{}catch(e){return!1}}(),"group"),qe="primary",Ve="secondary",He=Fe.FontAwesomeConfig||{};if(Te&&"function"==typeof Te.querySelector){[["data-family-prefix","familyPrefix"],["data-replacement-class","replacementClass"],["data-auto-replace-svg","autoReplaceSvg"],["data-auto-add-css","autoAddCss"],["data-auto-a11y","autoA11y"],["data-search-pseudo-elements","searchPseudoElements"],["data-observe-mutations","observeMutations"],["data-mutate-approach","mutateApproach"],["data-keep-original-source","keepOriginalSource"],["data-measure-performance","measurePerformance"],["data-show-missing-icons","showMissingIcons"]].forEach((function(e){var o=Se(e,2),n=o[0],a=o[1],i=function(e){return""===e||"false"!==e&&("true"===e||e)}(function(e){var o=Te.querySelector("script["+e+"]");if(o)return o.getAttribute(e)}(n));null!=i&&(He[a]=i)}))}var Ke=Oe({},{familyPrefix:"fa",replacementClass:"svg-inline--fa",autoReplaceSvg:!0,autoAddCss:!0,autoA11y:!0,searchPseudoElements:!1,observeMutations:!0,mutateApproach:"async",keepOriginalSource:!0,measurePerformance:!1,showMissingIcons:!0},He);Ke.autoReplaceSvg||(Ke.observeMutations=!1);var Ue=Oe({},Ke);Fe.FontAwesomeConfig=Ue;var We=Fe||{};We.___FONT_AWESOME___||(We.___FONT_AWESOME___={}),We.___FONT_AWESOME___.styles||(We.___FONT_AWESOME___.styles={}),We.___FONT_AWESOME___.hooks||(We.___FONT_AWESOME___.hooks={}),We.___FONT_AWESOME___.shims||(We.___FONT_AWESOME___.shims=[]);var Je=We.___FONT_AWESOME___,Ge=[];De&&((Te.documentElement.doScroll?/^loaded|^c/:/^loaded|^i|^c/).test(Te.readyState)||Te.addEventListener("DOMContentLoaded",(function e(){Te.removeEventListener("DOMContentLoaded",e),1,Ge.map((function(e){return e()}))})));"undefined"!=typeof global&&void 0!==global.process&&global.process.emit;var Xe={size:16,x:0,y:0,rotate:0,flipX:!1,flipY:!1};function Ye(){for(var e=12,o="";e-- >0;)o+="0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"[62*Math.random()|0];return o}function Ze(e){return"".concat(e).replace(/&/g,"&amp;").replace(/"/g,"&quot;").replace(/'/g,"&#39;").replace(/</g,"&lt;").replace(/>/g,"&gt;")}function Qe(e){return Object.keys(e||{}).reduce((function(o,n){return o+"".concat(n,": ").concat(e[n],";")}),"")}function $e(e){return e.size!==Xe.size||e.x!==Xe.x||e.y!==Xe.y||e.rotate!==Xe.rotate||e.flipX||e.flipY}function eo(e){var o=e.transform,n=e.containerWidth,a=e.iconWidth,i={transform:"translate(".concat(n/2," 256)")},r="translate(".concat(32*o.x,", ").concat(32*o.y,") "),t="scale(".concat(o.size/16*(o.flipX?-1:1),", ").concat(o.size/16*(o.flipY?-1:1),") "),m="rotate(".concat(o.rotate," 0 0)");return{outer:i,inner:{transform:"".concat(r," ").concat(t," ").concat(m)},path:{transform:"translate(".concat(a/2*-1," -256)")}}}var oo={x:0,y:0,width:"100%",height:"100%"};function no(e){var o=!(arguments.length>1&&void 0!==arguments[1])||arguments[1];return e.attributes&&(e.attributes.fill||o)&&(e.attributes.fill="black"),e}function ao(e){var o=e.icons,n=o.main,a=o.mask,i=e.prefix,r=e.iconName,t=e.transform,m=e.symbol,s=e.title,c=e.extra,d=e.watchable,u=void 0!==d&&d,g=a.found?a:n,v=g.width,l=g.height,f="fa-w-".concat(Math.ceil(v/l*16)),y=[Ue.replacementClass,r?"".concat(Ue.familyPrefix,"-").concat(r):"",f].filter((function(e){return-1===c.classes.indexOf(e)})).concat(c.classes).join(" "),j={children:[],attributes:Oe({},c.attributes,{"data-prefix":i,"data-icon":r,class:y,role:c.attributes.role||"img",xmlns:"http://www.w3.org/2000/svg",viewBox:"0 0 ".concat(v," ").concat(l)})};u&&(j.attributes["data-fa-i2svg"]=""),s&&j.children.push({tag:"title",attributes:{id:j.attributes["aria-labelledby"]||"title-".concat(Ye())},children:[s]});var p=Oe({},j,{prefix:i,iconName:r,main:n,mask:a,transform:t,symbol:m,styles:c.styles}),h=a.found&&n.found?function(e){var o,n=e.children,a=e.attributes,i=e.main,r=e.mask,t=e.transform,m=i.width,s=i.icon,c=r.width,d=r.icon,u=eo({transform:t,containerWidth:c,iconWidth:m}),g={tag:"rect",attributes:Oe({},oo,{fill:"white"})},v=s.children?{children:s.children.map(no)}:{},l={tag:"g",attributes:Oe({},u.inner),children:[no(Oe({tag:s.tag,attributes:Oe({},s.attributes,u.path)},v))]},f={tag:"g",attributes:Oe({},u.outer),children:[l]},y="mask-".concat(Ye()),j="clip-".concat(Ye()),p={tag:"mask",attributes:Oe({},oo,{id:y,maskUnits:"userSpaceOnUse",maskContentUnits:"userSpaceOnUse"}),children:[g,f]},h={tag:"defs",children:[{tag:"clipPath",attributes:{id:j},children:(o=d,"g"===o.tag?o.children:[o])},p]};return n.push(h,{tag:"rect",attributes:Oe({fill:"currentColor","clip-path":"url(#".concat(j,")"),mask:"url(#".concat(y,")")},oo)}),{children:n,attributes:a}}(p):function(e){var o=e.children,n=e.attributes,a=e.main,i=e.transform,r=Qe(e.styles);if(r.length>0&&(n.style=r),$e(i)){var t=eo({transform:i,containerWidth:a.width,iconWidth:a.width});o.push({tag:"g",attributes:Oe({},t.outer),children:[{tag:"g",attributes:Oe({},t.inner),children:[{tag:a.icon.tag,children:a.icon.children,attributes:Oe({},a.icon.attributes,t.path)}]}]})}else o.push(a.icon);return{children:o,attributes:n}}(p),b=h.children,w=h.attributes;return p.children=b,p.attributes=w,m?function(e){var o=e.prefix,n=e.iconName,a=e.children,i=e.attributes,r=e.symbol;return[{tag:"svg",attributes:{style:"display: none;"},children:[{tag:"symbol",attributes:Oe({},i,{id:!0===r?"".concat(o,"-").concat(Ue.familyPrefix,"-").concat(n):r}),children:a}]}]}(p):function(e){var o=e.children,n=e.main,a=e.mask,i=e.attributes,r=e.styles,t=e.transform;if($e(t)&&n.found&&!a.found){var m={x:n.width/n.height/2,y:.5};i.style=Qe(Oe({},r,{"transform-origin":"".concat(m.x+t.x/16,"em ").concat(m.y+t.y/16,"em")}))}return[{tag:"svg",attributes:i,children:o}]}(p)}var io=function(){},ro=(Ue.measurePerformance&&Be&&Be.mark&&Be.measure,function(e,o,n,a){var i,r,t,m=Object.keys(e),s=m.length,c=void 0!==a?function(e,o){return function(n,a,i,r){return e.call(o,n,a,i,r)}}(o,a):o;for(void 0===n?(i=1,t=e[m[0]]):(i=0,t=n);i<s;i++)t=c(t,e[r=m[i]],r,e);return t});function to(e,o){var n=arguments.length>2&&void 0!==arguments[2]?arguments[2]:{},a=n.skipHooks,i=void 0!==a&&a,r=Object.keys(o).reduce((function(e,n){var a=o[n];return!!a.icon?e[a.iconName]=a.icon:e[n]=a,e}),{});"function"!=typeof Je.hooks.addPack||i?Je.styles[e]=Oe({},Je.styles[e]||{},r):Je.hooks.addPack(e,r),"fas"===e&&to("fa",o)}var mo=Je.styles,so=Je.shims,co=function(){var e=function(e){return ro(mo,(function(o,n,a){return o[a]=ro(n,e,{}),o}),{})};e((function(e,o,n){return o[3]&&(e[o[3]]=n),e})),e((function(e,o,n){var a=o[2];return e[n]=n,a.forEach((function(o){e[o]=n})),e}));var o="far"in mo;ro(so,(function(e,n){var a=n[0],i=n[1],r=n[2];return"far"!==i||o||(i="fas"),e[a]={prefix:i,iconName:r},e}),{})};co();Je.styles;function uo(e,o,n){if(e&&e[o]&&e[o][n])return{prefix:o,iconName:n,icon:e[o][n]}}function go(e){var o=e.tag,n=e.attributes,a=void 0===n?{}:n,i=e.children,r=void 0===i?[]:i;return"string"==typeof e?Ze(e):"<".concat(o," ").concat(function(e){return Object.keys(e||{}).reduce((function(o,n){return o+"".concat(n,'="').concat(Ze(e[n]),'" ')}),"").trim()}(a),">").concat(r.map(go).join(""),"</").concat(o,">")}function vo(e){this.name="MissingIcon",this.message=e||"Icon unavailable",this.stack=(new Error).stack}vo.prototype=Object.create(Error.prototype),vo.prototype.constructor=vo;var lo={fill:"currentColor"},fo={attributeType:"XML",repeatCount:"indefinite",dur:"2s"},yo=(Oe({},lo,{d:"M156.5,447.7l-12.6,29.5c-18.7-9.5-35.9-21.2-51.5-34.9l22.7-22.7C127.6,430.5,141.5,440,156.5,447.7z M40.6,272H8.5 c1.4,21.2,5.4,41.7,11.7,61.1L50,321.2C45.1,305.5,41.8,289,40.6,272z M40.6,240c1.4-18.8,5.2-37,11.1-54.1l-29.5-12.6 C14.7,194.3,10,216.7,8.5,240H40.6z M64.3,156.5c7.8-14.9,17.2-28.8,28.1-41.5L69.7,92.3c-13.7,15.6-25.5,32.8-34.9,51.5 L64.3,156.5z M397,419.6c-13.9,12-29.4,22.3-46.1,30.4l11.9,29.8c20.7-9.9,39.8-22.6,56.9-37.6L397,419.6z M115,92.4 c13.9-12,29.4-22.3,46.1-30.4l-11.9-29.8c-20.7,9.9-39.8,22.6-56.8,37.6L115,92.4z M447.7,355.5c-7.8,14.9-17.2,28.8-28.1,41.5 l22.7,22.7c13.7-15.6,25.5-32.9,34.9-51.5L447.7,355.5z M471.4,272c-1.4,18.8-5.2,37-11.1,54.1l29.5,12.6 c7.5-21.1,12.2-43.5,13.6-66.8H471.4z M321.2,462c-15.7,5-32.2,8.2-49.2,9.4v32.1c21.2-1.4,41.7-5.4,61.1-11.7L321.2,462z M240,471.4c-18.8-1.4-37-5.2-54.1-11.1l-12.6,29.5c21.1,7.5,43.5,12.2,66.8,13.6V471.4z M462,190.8c5,15.7,8.2,32.2,9.4,49.2h32.1 c-1.4-21.2-5.4-41.7-11.7-61.1L462,190.8z M92.4,397c-12-13.9-22.3-29.4-30.4-46.1l-29.8,11.9c9.9,20.7,22.6,39.8,37.6,56.9 L92.4,397z M272,40.6c18.8,1.4,36.9,5.2,54.1,11.1l12.6-29.5C317.7,14.7,295.3,10,272,8.5V40.6z M190.8,50 c15.7-5,32.2-8.2,49.2-9.4V8.5c-21.2,1.4-41.7,5.4-61.1,11.7L190.8,50z M442.3,92.3L419.6,115c12,13.9,22.3,29.4,30.5,46.1 l29.8-11.9C470,128.5,457.3,109.4,442.3,92.3z M397,92.4l22.7-22.7c-15.6-13.7-32.8-25.5-51.5-34.9l-12.6,29.5 C370.4,72.1,384.4,81.5,397,92.4z"}),Oe({},fo,{attributeName:"opacity"}));Oe({},lo,{cx:"256",cy:"364",r:"28"}),Oe({},fo,{attributeName:"r",values:"28;14;28;28;14;28;"}),Oe({},yo,{values:"1;0;1;1;0;1;"}),Oe({},lo,{opacity:"1",d:"M263.7,312h-16c-6.6,0-12-5.4-12-12c0-71,77.4-63.9,77.4-107.8c0-20-17.8-40.2-57.4-40.2c-29.1,0-44.3,9.6-59.2,28.7 c-3.9,5-11.1,6-16.2,2.4l-13.1-9.2c-5.6-3.9-6.9-11.8-2.6-17.2c21.2-27.2,46.4-44.7,91.2-44.7c52.3,0,97.4,29.8,97.4,80.2 c0,67.6-77.4,63.5-77.4,107.8C275.7,306.6,270.3,312,263.7,312z"}),Oe({},yo,{values:"1;0;0;0;0;1;"}),Oe({},lo,{opacity:"0",d:"M232.5,134.5l7,168c0.3,6.4,5.6,11.5,12,11.5h9c6.4,0,11.7-5.1,12-11.5l7-168c0.3-6.8-5.2-12.5-12-12.5h-23 C237.7,122,232.2,127.7,232.5,134.5z"}),Oe({},yo,{values:"0;0;1;1;0;0;"}),Je.styles;function jo(e){var o=e[0],n=e[1],a=Se(e.slice(4),1)[0];return{found:!0,width:o,height:n,icon:Array.isArray(a)?{tag:"g",attributes:{class:"".concat(Ue.familyPrefix,"-").concat(Re)},children:[{tag:"path",attributes:{class:"".concat(Ue.familyPrefix,"-").concat(Ve),fill:"currentColor",d:a[0]}},{tag:"path",attributes:{class:"".concat(Ue.familyPrefix,"-").concat(qe),fill:"currentColor",d:a[1]}}]}:{tag:"path",attributes:{fill:"currentColor",d:a}}}}Je.styles;function po(){Ue.autoAddCss&&!xo&&(!function(e){if(e&&De){var o=Te.createElement("style");o.setAttribute("type","text/css"),o.innerHTML=e;for(var n=Te.head.childNodes,a=null,i=n.length-1;i>-1;i--){var r=n[i],t=(r.tagName||"").toUpperCase();["STYLE","LINK"].indexOf(t)>-1&&(a=r)}Te.head.insertBefore(o,a)}}(function(){var e="svg-inline--fa",o=Ue.familyPrefix,n=Ue.replacementClass,a='svg:not(:root).svg-inline--fa {\n  overflow: visible;\n}\n\n.svg-inline--fa {\n  display: inline-block;\n  font-size: inherit;\n  height: 1em;\n  overflow: visible;\n  vertical-align: -0.125em;\n}\n.svg-inline--fa.fa-lg {\n  vertical-align: -0.225em;\n}\n.svg-inline--fa.fa-w-1 {\n  width: 0.0625em;\n}\n.svg-inline--fa.fa-w-2 {\n  width: 0.125em;\n}\n.svg-inline--fa.fa-w-3 {\n  width: 0.1875em;\n}\n.svg-inline--fa.fa-w-4 {\n  width: 0.25em;\n}\n.svg-inline--fa.fa-w-5 {\n  width: 0.3125em;\n}\n.svg-inline--fa.fa-w-6 {\n  width: 0.375em;\n}\n.svg-inline--fa.fa-w-7 {\n  width: 0.4375em;\n}\n.svg-inline--fa.fa-w-8 {\n  width: 0.5em;\n}\n.svg-inline--fa.fa-w-9 {\n  width: 0.5625em;\n}\n.svg-inline--fa.fa-w-10 {\n  width: 0.625em;\n}\n.svg-inline--fa.fa-w-11 {\n  width: 0.6875em;\n}\n.svg-inline--fa.fa-w-12 {\n  width: 0.75em;\n}\n.svg-inline--fa.fa-w-13 {\n  width: 0.8125em;\n}\n.svg-inline--fa.fa-w-14 {\n  width: 0.875em;\n}\n.svg-inline--fa.fa-w-15 {\n  width: 0.9375em;\n}\n.svg-inline--fa.fa-w-16 {\n  width: 1em;\n}\n.svg-inline--fa.fa-w-17 {\n  width: 1.0625em;\n}\n.svg-inline--fa.fa-w-18 {\n  width: 1.125em;\n}\n.svg-inline--fa.fa-w-19 {\n  width: 1.1875em;\n}\n.svg-inline--fa.fa-w-20 {\n  width: 1.25em;\n}\n.svg-inline--fa.fa-pull-left {\n  margin-right: 0.3em;\n  width: auto;\n}\n.svg-inline--fa.fa-pull-right {\n  margin-left: 0.3em;\n  width: auto;\n}\n.svg-inline--fa.fa-border {\n  height: 1.5em;\n}\n.svg-inline--fa.fa-li {\n  width: 2em;\n}\n.svg-inline--fa.fa-fw {\n  width: 1.25em;\n}\n\n.fa-layers svg.svg-inline--fa {\n  bottom: 0;\n  left: 0;\n  margin: auto;\n  position: absolute;\n  right: 0;\n  top: 0;\n}\n\n.fa-layers {\n  display: inline-block;\n  height: 1em;\n  position: relative;\n  text-align: center;\n  vertical-align: -0.125em;\n  width: 1em;\n}\n.fa-layers svg.svg-inline--fa {\n  -webkit-transform-origin: center center;\n          transform-origin: center center;\n}\n\n.fa-layers-counter, .fa-layers-text {\n  display: inline-block;\n  position: absolute;\n  text-align: center;\n}\n\n.fa-layers-text {\n  left: 50%;\n  top: 50%;\n  -webkit-transform: translate(-50%, -50%);\n          transform: translate(-50%, -50%);\n  -webkit-transform-origin: center center;\n          transform-origin: center center;\n}\n\n.fa-layers-counter {\n  background-color: #ff253a;\n  border-radius: 1em;\n  -webkit-box-sizing: border-box;\n          box-sizing: border-box;\n  color: #fff;\n  height: 1.5em;\n  line-height: 1;\n  max-width: 5em;\n  min-width: 1.5em;\n  overflow: hidden;\n  padding: 0.25em;\n  right: 0;\n  text-overflow: ellipsis;\n  top: 0;\n  -webkit-transform: scale(0.25);\n          transform: scale(0.25);\n  -webkit-transform-origin: top right;\n          transform-origin: top right;\n}\n\n.fa-layers-bottom-right {\n  bottom: 0;\n  right: 0;\n  top: auto;\n  -webkit-transform: scale(0.25);\n          transform: scale(0.25);\n  -webkit-transform-origin: bottom right;\n          transform-origin: bottom right;\n}\n\n.fa-layers-bottom-left {\n  bottom: 0;\n  left: 0;\n  right: auto;\n  top: auto;\n  -webkit-transform: scale(0.25);\n          transform: scale(0.25);\n  -webkit-transform-origin: bottom left;\n          transform-origin: bottom left;\n}\n\n.fa-layers-top-right {\n  right: 0;\n  top: 0;\n  -webkit-transform: scale(0.25);\n          transform: scale(0.25);\n  -webkit-transform-origin: top right;\n          transform-origin: top right;\n}\n\n.fa-layers-top-left {\n  left: 0;\n  right: auto;\n  top: 0;\n  -webkit-transform: scale(0.25);\n          transform: scale(0.25);\n  -webkit-transform-origin: top left;\n          transform-origin: top left;\n}\n\n.fa-lg {\n  font-size: 1.3333333333em;\n  line-height: 0.75em;\n  vertical-align: -0.0667em;\n}\n\n.fa-xs {\n  font-size: 0.75em;\n}\n\n.fa-sm {\n  font-size: 0.875em;\n}\n\n.fa-1x {\n  font-size: 1em;\n}\n\n.fa-2x {\n  font-size: 2em;\n}\n\n.fa-3x {\n  font-size: 3em;\n}\n\n.fa-4x {\n  font-size: 4em;\n}\n\n.fa-5x {\n  font-size: 5em;\n}\n\n.fa-6x {\n  font-size: 6em;\n}\n\n.fa-7x {\n  font-size: 7em;\n}\n\n.fa-8x {\n  font-size: 8em;\n}\n\n.fa-9x {\n  font-size: 9em;\n}\n\n.fa-10x {\n  font-size: 10em;\n}\n\n.fa-fw {\n  text-align: center;\n  width: 1.25em;\n}\n\n.fa-ul {\n  list-style-type: none;\n  margin-left: 2.5em;\n  padding-left: 0;\n}\n.fa-ul > li {\n  position: relative;\n}\n\n.fa-li {\n  left: -2em;\n  position: absolute;\n  text-align: center;\n  width: 2em;\n  line-height: inherit;\n}\n\n.fa-border {\n  border: solid 0.08em #eee;\n  border-radius: 0.1em;\n  padding: 0.2em 0.25em 0.15em;\n}\n\n.fa-pull-left {\n  float: left;\n}\n\n.fa-pull-right {\n  float: right;\n}\n\n.fa.fa-pull-left,\n.fas.fa-pull-left,\n.far.fa-pull-left,\n.fal.fa-pull-left,\n.fab.fa-pull-left {\n  margin-right: 0.3em;\n}\n.fa.fa-pull-right,\n.fas.fa-pull-right,\n.far.fa-pull-right,\n.fal.fa-pull-right,\n.fab.fa-pull-right {\n  margin-left: 0.3em;\n}\n\n.fa-spin {\n  -webkit-animation: fa-spin 2s infinite linear;\n          animation: fa-spin 2s infinite linear;\n}\n\n.fa-pulse {\n  -webkit-animation: fa-spin 1s infinite steps(8);\n          animation: fa-spin 1s infinite steps(8);\n}\n\n@-webkit-keyframes fa-spin {\n  0% {\n    -webkit-transform: rotate(0deg);\n            transform: rotate(0deg);\n  }\n  100% {\n    -webkit-transform: rotate(360deg);\n            transform: rotate(360deg);\n  }\n}\n\n@keyframes fa-spin {\n  0% {\n    -webkit-transform: rotate(0deg);\n            transform: rotate(0deg);\n  }\n  100% {\n    -webkit-transform: rotate(360deg);\n            transform: rotate(360deg);\n  }\n}\n.fa-rotate-90 {\n  -ms-filter: "progid:DXImageTransform.Microsoft.BasicImage(rotation=1)";\n  -webkit-transform: rotate(90deg);\n          transform: rotate(90deg);\n}\n\n.fa-rotate-180 {\n  -ms-filter: "progid:DXImageTransform.Microsoft.BasicImage(rotation=2)";\n  -webkit-transform: rotate(180deg);\n          transform: rotate(180deg);\n}\n\n.fa-rotate-270 {\n  -ms-filter: "progid:DXImageTransform.Microsoft.BasicImage(rotation=3)";\n  -webkit-transform: rotate(270deg);\n          transform: rotate(270deg);\n}\n\n.fa-flip-horizontal {\n  -ms-filter: "progid:DXImageTransform.Microsoft.BasicImage(rotation=0, mirror=1)";\n  -webkit-transform: scale(-1, 1);\n          transform: scale(-1, 1);\n}\n\n.fa-flip-vertical {\n  -ms-filter: "progid:DXImageTransform.Microsoft.BasicImage(rotation=2, mirror=1)";\n  -webkit-transform: scale(1, -1);\n          transform: scale(1, -1);\n}\n\n.fa-flip-both, .fa-flip-horizontal.fa-flip-vertical {\n  -ms-filter: "progid:DXImageTransform.Microsoft.BasicImage(rotation=2, mirror=1)";\n  -webkit-transform: scale(-1, -1);\n          transform: scale(-1, -1);\n}\n\n:root .fa-rotate-90,\n:root .fa-rotate-180,\n:root .fa-rotate-270,\n:root .fa-flip-horizontal,\n:root .fa-flip-vertical,\n:root .fa-flip-both {\n  -webkit-filter: none;\n          filter: none;\n}\n\n.fa-stack {\n  display: inline-block;\n  height: 2em;\n  position: relative;\n  width: 2.5em;\n}\n\n.fa-stack-1x,\n.fa-stack-2x {\n  bottom: 0;\n  left: 0;\n  margin: auto;\n  position: absolute;\n  right: 0;\n  top: 0;\n}\n\n.svg-inline--fa.fa-stack-1x {\n  height: 1em;\n  width: 1.25em;\n}\n.svg-inline--fa.fa-stack-2x {\n  height: 2em;\n  width: 2.5em;\n}\n\n.fa-inverse {\n  color: #fff;\n}\n\n.sr-only {\n  border: 0;\n  clip: rect(0, 0, 0, 0);\n  height: 1px;\n  margin: -1px;\n  overflow: hidden;\n  padding: 0;\n  position: absolute;\n  width: 1px;\n}\n\n.sr-only-focusable:active, .sr-only-focusable:focus {\n  clip: auto;\n  height: auto;\n  margin: 0;\n  overflow: visible;\n  position: libs;\n  width: auto;\n}\n\n.svg-inline--fa .fa-primary {\n  fill: var(--fa-primary-color, currentColor);\n  opacity: 1;\n  opacity: var(--fa-primary-opacity, 1);\n}\n\n.svg-inline--fa .fa-secondary {\n  fill: var(--fa-secondary-color, currentColor);\n  opacity: 0.4;\n  opacity: var(--fa-secondary-opacity, 0.4);\n}\n\n.svg-inline--fa.fa-swap-opacity .fa-primary {\n  opacity: 0.4;\n  opacity: var(--fa-secondary-opacity, 0.4);\n}\n\n.svg-inline--fa.fa-swap-opacity .fa-secondary {\n  opacity: 1;\n  opacity: var(--fa-primary-opacity, 1);\n}\n\n.svg-inline--fa mask .fa-primary,\n.svg-inline--fa mask .fa-secondary {\n  fill: black;\n}\n\n.fad.fa-inverse {\n  color: #fff;\n}';if("fa"!==o||n!==e){var i=new RegExp("\\.".concat("fa","\\-"),"g"),r=new RegExp("\\--".concat("fa","\\-"),"g"),t=new RegExp("\\.".concat(e),"g");a=a.replace(i,".".concat(o,"-")).replace(r,"--".concat(o,"-")).replace(t,".".concat(n))}return a}()),xo=!0)}function ho(e,o){return Object.defineProperty(e,"abstract",{get:o}),Object.defineProperty(e,"html",{get:function(){return e.abstract.map((function(e){return go(e)}))}}),Object.defineProperty(e,"node",{get:function(){if(De){var o=Te.createElement("div");return o.innerHTML=e.html,o.children}}}),e}function bo(e){var o=e.prefix,n=void 0===o?"fa":o,a=e.iconName;if(a)return uo(ko.definitions,n,a)||uo(Je.styles,n,a)}var wo,ko=new(function(){function e(){!function(e,o){if(!(e instanceof o))throw new TypeError("Cannot call a class as a function")}(this,e),this.definitions={}}var o,n,a;return o=e,(n=[{key:"add",value:function(){for(var e=this,o=arguments.length,n=new Array(o),a=0;a<o;a++)n[a]=arguments[a];var i=n.reduce(this._pullDefinitions,{});Object.keys(i).forEach((function(o){e.definitions[o]=Oe({},e.definitions[o]||{},i[o]),to(o,i[o]),co()}))}},{key:"reset",value:function(){this.definitions={}}},{key:"_pullDefinitions",value:function(e,o){var n=o.prefix&&o.iconName&&o.icon?{0:o}:o;return Object.keys(n).map((function(o){var a=n[o],i=a.prefix,r=a.iconName,t=a.icon;e[i]||(e[i]={}),e[i][r]=t})),e}}])&&Ce(o.prototype,n),a&&Ce(o,a),e}()),xo=!1,Eo=(wo=function(e){var o=arguments.length>1&&void 0!==arguments[1]?arguments[1]:{},n=o.transform,a=void 0===n?Xe:n,i=o.symbol,r=void 0!==i&&i,t=o.mask,m=void 0===t?null:t,s=o.title,c=void 0===s?null:s,d=o.classes,u=void 0===d?[]:d,g=o.attributes,v=void 0===g?{}:g,l=o.styles,f=void 0===l?{}:l;if(e){var y=e.prefix,j=e.iconName,p=e.icon;return ho(Oe({type:"icon"},e),(function(){return po(),Ue.autoA11y&&(c?v["aria-labelledby"]="".concat(Ue.replacementClass,"-title-").concat(Ye()):(v["aria-hidden"]="true",v.focusable="false")),ao({icons:{main:jo(p),mask:m?jo(m.icon):{found:!1,width:null,height:null,icon:{}}},prefix:y,iconName:j,transform:Oe({},Xe,a),symbol:r,title:c,extra:{attributes:v,styles:f,classes:u}})}))}},function(e){var o=arguments.length>1&&void 0!==arguments[1]?arguments[1]:{},n=(e||{}).icon?e:bo(e||{}),a=o.mask;return a&&(a=(a||{}).icon?a:bo(a||{})),wo(n,Oe({},o,{mask:a}))});ko.add({prefix:"far",iconName:"building",icon:[448,512,[],"f1ad","M128 148v-40c0-6.6 5.4-12 12-12h40c6.6 0 12 5.4 12 12v40c0 6.6-5.4 12-12 12h-40c-6.6 0-12-5.4-12-12zm140 12h40c6.6 0 12-5.4 12-12v-40c0-6.6-5.4-12-12-12h-40c-6.6 0-12 5.4-12 12v40c0 6.6 5.4 12 12 12zm-128 96h40c6.6 0 12-5.4 12-12v-40c0-6.6-5.4-12-12-12h-40c-6.6 0-12 5.4-12 12v40c0 6.6 5.4 12 12 12zm128 0h40c6.6 0 12-5.4 12-12v-40c0-6.6-5.4-12-12-12h-40c-6.6 0-12 5.4-12 12v40c0 6.6 5.4 12 12 12zm-76 84v-40c0-6.6-5.4-12-12-12h-40c-6.6 0-12 5.4-12 12v40c0 6.6 5.4 12 12 12h40c6.6 0 12-5.4 12-12zm76 12h40c6.6 0 12-5.4 12-12v-40c0-6.6-5.4-12-12-12h-40c-6.6 0-12 5.4-12 12v40c0 6.6 5.4 12 12 12zm180 124v36H0v-36c0-6.6 5.4-12 12-12h19.5V24c0-13.3 10.7-24 24-24h337c13.3 0 24 10.7 24 24v440H436c6.6 0 12 5.4 12 12zM79.5 463H192v-67c0-6.6 5.4-12 12-12h40c6.6 0 12 5.4 12 12v67h112.5V49L80 48l-.5 415z"]},{prefix:"fas",iconName:"cat",icon:[512,512,[],"f6be","M290.59 192c-20.18 0-106.82 1.98-162.59 85.95V192c0-52.94-43.06-96-96-96-17.67 0-32 14.33-32 32s14.33 32 32 32c17.64 0 32 14.36 32 32v256c0 35.3 28.7 64 64 64h176c8.84 0 16-7.16 16-16v-16c0-17.67-14.33-32-32-32h-32l128-96v144c0 8.84 7.16 16 16 16h32c8.84 0 16-7.16 16-16V289.86c-10.29 2.67-20.89 4.54-32 4.54-61.81 0-113.52-44.05-125.41-102.4zM448 96h-64l-64-64v134.4c0 53.02 42.98 96 96 96s96-42.98 96-96V32l-64 64zm-72 80c-8.84 0-16-7.16-16-16s7.16-16 16-16 16 7.16 16 16-7.16 16-16 16zm80 0c-8.84 0-16-7.16-16-16s7.16-16 16-16 16 7.16 16 16-7.16 16-16 16z"]},{prefix:"fas",iconName:"coffee",icon:[640,512,[],"f0f4","M192 384h192c53 0 96-43 96-96h32c70.6 0 128-57.4 128-128S582.6 32 512 32H120c-13.3 0-24 10.7-24 24v232c0 53 43 96 96 96zM512 96c35.3 0 64 28.7 64 64s-28.7 64-64 64h-32V96h32zm47.7 384H48.3c-47.6 0-61-64-36-64h583.3c25 0 11.8 64-35.9 64z"]},{prefix:"far",iconName:"flag",icon:[512,512,[],"f024","M336.174 80c-49.132 0-93.305-32-161.913-32-31.301 0-58.303 6.482-80.721 15.168a48.04 48.04 0 0 0 2.142-20.727C93.067 19.575 74.167 1.594 51.201.104 23.242-1.71 0 20.431 0 48c0 17.764 9.657 33.262 24 41.562V496c0 8.837 7.163 16 16 16h16c8.837 0 16-7.163 16-16v-83.443C109.869 395.28 143.259 384 199.826 384c49.132 0 93.305 32 161.913 32 58.479 0 101.972-22.617 128.548-39.981C503.846 367.161 512 352.051 512 335.855V95.937c0-34.459-35.264-57.768-66.904-44.117C409.193 67.309 371.641 80 336.174 80zM464 336c-21.783 15.412-60.824 32-102.261 32-59.945 0-102.002-32-161.913-32-43.361 0-96.379 9.403-127.826 24V128c21.784-15.412 60.824-32 102.261-32 59.945 0 102.002 32 161.913 32 43.271 0 96.32-17.366 127.826-32v240z"]},{prefix:"far",iconName:"frown",icon:[496,512,[],"f119","M248 8C111 8 0 119 0 256s111 248 248 248 248-111 248-248S385 8 248 8zm0 448c-110.3 0-200-89.7-200-200S137.7 56 248 56s200 89.7 200 200-89.7 200-200 200zm-80-216c17.7 0 32-14.3 32-32s-14.3-32-32-32-32 14.3-32 32 14.3 32 32 32zm160-64c-17.7 0-32 14.3-32 32s14.3 32 32 32 32-14.3 32-32-14.3-32-32-32zm-80 128c-40.2 0-78 17.7-103.8 48.6-8.5 10.2-7.1 25.3 3.1 33.8 10.2 8.4 25.3 7.1 33.8-3.1 16.6-19.9 41-31.4 66.9-31.4s50.3 11.4 66.9 31.4c8.1 9.7 23.1 11.9 33.8 3.1 10.2-8.5 11.5-23.6 3.1-33.8C326 321.7 288.2 304 248 304z"]},{prefix:"fas",iconName:"futbol",icon:[512,512,[],"f1e3","M504 256c0 136.967-111.033 248-248 248S8 392.967 8 256 119.033 8 256 8s248 111.033 248 248zm-48 0l-.003-.282-26.064 22.741-62.679-58.5 16.454-84.355 34.303 3.072c-24.889-34.216-60.004-60.089-100.709-73.141l13.651 31.939L256 139l-74.953-41.525 13.651-31.939c-40.631 13.028-75.78 38.87-100.709 73.141l34.565-3.073 16.192 84.355-62.678 58.5-26.064-22.741-.003.282c0 43.015 13.497 83.952 38.472 117.991l7.704-33.897 85.138 10.447 36.301 77.826-29.902 17.786c40.202 13.122 84.29 13.148 124.572 0l-29.902-17.786 36.301-77.826 85.138-10.447 7.704 33.897C442.503 339.952 456 299.015 456 256zm-248.102 69.571l-29.894-91.312L256 177.732l77.996 56.527-29.622 91.312h-96.476z"]},{prefix:"fas",iconName:"history",icon:[512,512,[],"f1da","M504 255.531c.253 136.64-111.18 248.372-247.82 248.468-59.015.042-113.223-20.53-155.822-54.911-11.077-8.94-11.905-25.541-1.839-35.607l11.267-11.267c8.609-8.609 22.353-9.551 31.891-1.984C173.062 425.135 212.781 440 256 440c101.705 0 184-82.311 184-184 0-101.705-82.311-184-184-184-48.814 0-93.149 18.969-126.068 49.932l50.754 50.754c10.08 10.08 2.941 27.314-11.313 27.314H24c-8.837 0-16-7.163-16-16V38.627c0-14.254 17.234-21.393 27.314-11.314l49.372 49.372C129.209 34.136 189.552 8 256 8c136.81 0 247.747 110.78 248 247.531zm-180.912 78.784l9.823-12.63c8.138-10.463 6.253-25.542-4.21-33.679L288 256.349V152c0-13.255-10.745-24-24-24h-16c-13.255 0-24 10.745-24 24v135.651l65.409 50.874c10.463 8.137 25.541 6.253 33.679-4.21z"]},{prefix:"far",iconName:"lightbulb",icon:[352,512,[],"f0eb","M176 80c-52.94 0-96 43.06-96 96 0 8.84 7.16 16 16 16s16-7.16 16-16c0-35.3 28.72-64 64-64 8.84 0 16-7.16 16-16s-7.16-16-16-16zM96.06 459.17c0 3.15.93 6.22 2.68 8.84l24.51 36.84c2.97 4.46 7.97 7.14 13.32 7.14h78.85c5.36 0 10.36-2.68 13.32-7.14l24.51-36.84c1.74-2.62 2.67-5.7 2.68-8.84l.05-43.18H96.02l.04 43.18zM176 0C73.72 0 0 82.97 0 176c0 44.37 16.45 84.85 43.56 115.78 16.64 18.99 42.74 58.8 52.42 92.16v.06h48v-.12c-.01-4.77-.72-9.51-2.15-14.07-5.59-17.81-22.82-64.77-62.17-109.67-20.54-23.43-31.52-53.15-31.61-84.14-.2-73.64 59.67-128 127.95-128 70.58 0 128 57.42 128 128 0 30.97-11.24 60.85-31.65 84.14-39.11 44.61-56.42 91.47-62.1 109.46a47.507 47.507 0 0 0-2.22 14.3v.1h48v-.05c9.68-33.37 35.78-73.18 52.42-92.16C335.55 260.85 352 220.37 352 176 352 78.8 273.2 0 176 0z"]},{prefix:"fas",iconName:"music",icon:[512,512,[],"f001","M511.99 32.01c0-21.71-21.1-37.01-41.6-30.51L150.4 96c-13.3 4.2-22.4 16.5-22.4 30.5v261.42c-10.05-2.38-20.72-3.92-32-3.92-53.02 0-96 28.65-96 64s42.98 64 96 64 96-28.65 96-64V214.31l256-75.02v184.63c-10.05-2.38-20.72-3.92-32-3.92-53.02 0-96 28.65-96 64s42.98 64 96 64 96-28.65 96-64l-.01-351.99z"]},{prefix:"fas",iconName:"search",icon:[512,512,[],"f002","M505 442.7L405.3 343c-4.5-4.5-10.6-7-17-7H372c27.6-35.3 44-79.7 44-128C416 93.1 322.9 0 208 0S0 93.1 0 208s93.1 208 208 208c48.3 0 92.7-16.4 128-44v16.3c0 6.4 2.5 12.5 7 17l99.7 99.7c9.4 9.4 24.6 9.4 33.9 0l28.3-28.3c9.4-9.4 9.4-24.6.1-34zM208 336c-70.7 0-128-57.2-128-128 0-70.7 57.2-128 128-128 70.7 0 128 57.2 128 128 0 70.7-57.2 128-128 128z"]},{prefix:"far",iconName:"smile",icon:[496,512,[],"f118","M248 8C111 8 0 119 0 256s111 248 248 248 248-111 248-248S385 8 248 8zm0 448c-110.3 0-200-89.7-200-200S137.7 56 248 56s200 89.7 200 200-89.7 200-200 200zm-80-216c17.7 0 32-14.3 32-32s-14.3-32-32-32-32 14.3-32 32 14.3 32 32 32zm160 0c17.7 0 32-14.3 32-32s-14.3-32-32-32-32 14.3-32 32 14.3 32 32 32zm4 72.6c-20.8 25-51.5 39.4-84 39.4s-63.2-14.3-84-39.4c-8.5-10.2-23.7-11.5-33.8-3.1-10.2 8.5-11.5 23.6-3.1 33.8 30 36 74.1 56.6 120.9 56.6s90.9-20.6 120.9-56.6c8.5-10.2 7.1-25.3-3.1-33.8-10.1-8.4-25.3-7.1-33.8 3.1z"]},{prefix:"fas",iconName:"times",icon:[352,512,[],"f00d","M242.72 256l100.07-100.07c12.28-12.28 12.28-32.19 0-44.48l-22.24-22.24c-12.28-12.28-32.19-12.28-44.48 0L176 189.28 75.93 89.21c-12.28-12.28-32.19-12.28-44.48 0L9.21 111.45c-12.28 12.28-12.28 32.19 0 44.48L109.28 256 9.21 356.07c-12.28 12.28-12.28 32.19 0 44.48l22.24 22.24c12.28 12.28 32.2 12.28 44.48 0L176 322.72l100.07 100.07c12.28 12.28 32.2 12.28 44.48 0l22.24-22.24c12.28-12.28 12.28-32.19 0-44.48L242.72 256z"]},{prefix:"fas",iconName:"user",icon:[448,512,[],"f007","M224 256c70.7 0 128-57.3 128-128S294.7 0 224 0 96 57.3 96 128s57.3 128 128 128zm89.6 32h-16.7c-22.2 10.2-46.9 16-72.9 16s-50.6-5.8-72.9-16h-16.7C60.2 288 0 348.2 0 422.4V464c0 26.5 21.5 48 48 48h352c26.5 0 48-21.5 48-48v-41.6c0-74.2-60.2-134.4-134.4-134.4z"]});var _o=Eo({prefix:"far",iconName:"building"}).html[0],Co=Eo({prefix:"fas",iconName:"cat"}).html[0],zo=Eo({prefix:"fas",iconName:"coffee"}).html[0],Oo=Eo({prefix:"far",iconName:"flag"}).html[0],So=Eo({prefix:"fas",iconName:"futbol"}).html[0],Mo=Eo({prefix:"far",iconName:"frown"}).html[0],Io=Eo({prefix:"fas",iconName:"history"}).html[0],Po=Eo({prefix:"far",iconName:"lightbulb"}).html[0],Lo=Eo({prefix:"fas",iconName:"music"}).html[0],Ao=Eo({prefix:"fas",iconName:"search"}).html[0],No=Eo({prefix:"far",iconName:"smile"}).html[0],Fo=Eo({prefix:"fas",iconName:"times"}).html[0],To=Eo({prefix:"fas",iconName:"user"}).html[0];function Bo(){var e=localStorage.getItem("emojiPicker.recent");return(e?JSON.parse(e):[]).filter((function(e){return!!e.emoji}))}var Do=function(){function e(e,o,n,a,i){this.emoji=e,this.showVariants=o,this.showPreview=n,this.events=a,this.options=i}return e.prototype.render=function(){var e=this;return this.emojiButton=xe("button","emoji-picker__emoji"),this.emojiButton.innerHTML="native"===this.options.style?this.emoji.emoji:we.parse(this.emoji.emoji),this.emojiButton.tabIndex=-1,this.emojiButton.title=this.emoji.name,this.emojiButton.addEventListener("focus",(function(){return e.onEmojiHover()})),this.emojiButton.addEventListener("blur",(function(){return e.onEmojiLeave()})),this.emojiButton.addEventListener("click",(function(){return e.onEmojiClick()})),this.emojiButton.addEventListener("mouseover",(function(){return e.onEmojiHover()})),this.emojiButton.addEventListener("mouseout",(function(){return e.onEmojiLeave()})),this.emojiButton},e.prototype.onEmojiClick=function(){var e,n,a,i;this.emoji.variations&&this.showVariants&&this.options.showVariants||!this.options.showRecents||(e=this.emoji,n=this.options,a=Bo(),i={emoji:e.emoji,name:e.name,key:e.key||e.name},localStorage.setItem("emojiPicker.recent",JSON.stringify(o([i],a.filter((function(e){return!!e.emoji&&e.key!==i.key}))).slice(0,n.recentsCount)))),this.events.emit("emoji",{emoji:this.emoji,showVariants:this.showVariants,button:this.emojiButton})},e.prototype.onEmojiHover=function(){this.showPreview&&this.events.emit("showPreview",this.emoji)},e.prototype.onEmojiLeave=function(){this.showPreview&&this.events.emit("hidePreview")},e}(),Ro=function(){function e(e,o,n,a){this.showVariants=o,this.events=n,this.options=a,this.emojis=e.filter((function(e){return!e.version||parseFloat(e.version)<=parseFloat(a.emojiVersion)}))}return e.prototype.render=function(){var e=this,o=xe("div","emoji-picker__container");return this.emojis.forEach((function(n){return o.appendChild(new Do(n,e.showVariants,!0,e.events,e.options).render())})),o},e}(),qo=function(){function e(e){this.message=e}return e.prototype.render=function(){var e=xe("div","emoji-picker__search-not-found"),o=xe("div","emoji-picker__search-not-found-icon");o.innerHTML=Mo,e.appendChild(o);var n=xe("h2");return n.innerHTML=this.message,e.appendChild(n),e},e}(),Vo=function(){function e(e,o,n,a,i){var r=this;this.events=e,this.i18n=o,this.options=n,this.focusedEmojiIndex=0,this.emojisPerRow=this.options.emojisPerRow||8,this.emojiData=a.filter((function(e){return e.version&&parseFloat(e.version)<=parseFloat(n.emojiVersion)&&void 0!==e.category&&i.indexOf(e.category)>=0})),this.events.on("hideVariantPopup",(function(){setTimeout((function(){return r.setFocusedEmoji(r.focusedEmojiIndex)}))}))}return e.prototype.render=function(){var e=this;return this.searchContainer=xe("div","emoji-picker__search-container"),this.searchField=xe("input","emoji-picker__search"),this.searchField.placeholder=this.i18n.search,this.searchContainer.appendChild(this.searchField),this.searchIcon=xe("span","emoji-picker__search-icon"),this.searchIcon.innerHTML=Ao,this.searchIcon.addEventListener("click",(function(o){return e.onClearSearch(o)})),this.searchContainer.appendChild(this.searchIcon),this.searchField.addEventListener("keydown",(function(o){return e.onKeyDown(o)})),this.searchField.addEventListener("keyup",(function(){return e.onKeyUp()})),this.searchContainer},e.prototype.onClearSearch=function(e){var o=this;e.stopPropagation(),this.searchField.value&&(this.searchField.value="",this.resultsContainer=null,this.searchIcon.innerHTML=Ao,this.searchIcon.style.cursor="default",this.events.emit("hideSearchResults"),setTimeout((function(){return o.searchField.focus()})))},e.prototype.setFocusedEmoji=function(e){if(this.resultsContainer){var o=this.resultsContainer.querySelectorAll(".emoji-picker__emoji");o[this.focusedEmojiIndex].tabIndex=-1,this.focusedEmojiIndex=e;var n=o[this.focusedEmojiIndex];n.tabIndex=0,n.focus()}},e.prototype.handleResultsKeydown=function(e){if(this.resultsContainer){var o=this.resultsContainer.querySelectorAll(".emoji-picker__emoji");"ArrowRight"===e.key?this.setFocusedEmoji(Math.min(this.focusedEmojiIndex+1,o.length-1)):"ArrowLeft"===e.key?this.setFocusedEmoji(Math.max(0,this.focusedEmojiIndex-1)):"ArrowDown"===e.key?(e.preventDefault(),this.focusedEmojiIndex<o.length-this.emojisPerRow&&this.setFocusedEmoji(this.focusedEmojiIndex+this.emojisPerRow)):"ArrowUp"===e.key?(e.preventDefault(),this.focusedEmojiIndex>=this.emojisPerRow&&this.setFocusedEmoji(this.focusedEmojiIndex-this.emojisPerRow)):"Escape"===e.key&&this.onClearSearch(e)}},e.prototype.onKeyDown=function(e){"Escape"===e.key&&this.searchField.value&&this.onClearSearch(e)},e.prototype.onKeyUp=function(){var e=this;if(this.searchField.value){this.searchIcon.innerHTML=Fo,this.searchIcon.style.cursor="pointer";var o=this.emojiData.filter((function(o){return o.name.toLowerCase().indexOf(e.searchField.value.toLowerCase())>=0}));this.events.emit("hidePreview"),o.length?(this.resultsContainer=new Ro(o,!0,this.events,this.options).render(),this.resultsContainer&&(this.resultsContainer.querySelector(".emoji-picker__emoji").tabIndex=0,this.focusedEmojiIndex=0,this.resultsContainer.addEventListener("keydown",(function(o){return e.handleResultsKeydown(o)})),this.events.emit("showSearchResults",this.resultsContainer))):this.events.emit("showSearchResults",new qo(this.i18n.notFound).render())}else this.searchIcon.innerHTML=Ao,this.searchIcon.style.cursor="default",this.events.emit("hideSearchResults")},e}(),Ho=function(){function e(e,o,n){this.events=e,this.emoji=o,this.options=n,this.focusedEmojiIndex=0}return e.prototype.getEmoji=function(e){return this.popup.querySelectorAll(".emoji-picker__emoji")[e]},e.prototype.setFocusedEmoji=function(e){this.getEmoji(this.focusedEmojiIndex).tabIndex=-1,this.focusedEmojiIndex=e;var o=this.getEmoji(this.focusedEmojiIndex);o.tabIndex=0,o.focus()},e.prototype.render=function(){var e=this;this.popup=xe("div","emoji-picker__variant-popup");var o=xe("div","emoji-picker__variant-overlay");o.addEventListener("click",(function(o){o.stopPropagation(),e.popup.contains(o.target)||e.events.emit("hideVariantPopup")})),this.popup.appendChild(new Do(this.emoji,!1,!1,this.events,this.options).render()),(this.emoji.variations||[]).forEach((function(o,n){return e.popup.appendChild(new Do({name:e.emoji.name,emoji:o,key:e.emoji.name+n},!1,!1,e.events,e.options).render())}));var n=this.popup.querySelector(".emoji-picker__emoji");return this.focusedEmojiIndex=0,n.tabIndex=0,setTimeout((function(){return n.focus()})),this.popup.addEventListener("keydown",(function(o){"ArrowRight"===o.key?e.setFocusedEmoji(Math.min(e.focusedEmojiIndex+1,e.popup.querySelectorAll(".emoji-picker__emoji").length-1)):"ArrowLeft"===o.key?e.setFocusedEmoji(Math.max(e.focusedEmojiIndex-1,0)):"Escape"===o.key&&(o.stopPropagation(),e.events.emit("hideVariantPopup"))})),o.appendChild(this.popup),o},e}(),Ko={search:"Search emojis...",categories:{recents:"Recent Emojis",smileys:"Smileys & Emotion",people:"People & Body",animals:"Animals & Nature",food:"Food & Drink",activities:"Activities",travel:"Travel & Places",objects:"Objects",symbols:"Symbols",flags:"Flags"},notFound:"No emojis found"},Uo={recents:Io,smileys:No,people:To,animals:Co,food:zo,activities:So,travel:_o,objects:Po,symbols:Lo,flags:Oo},Wo=function(){function e(e,o,n){this.options=e,this.events=o,this.i18n=n,this.activeButton=0,this.buttons=[]}return e.prototype.render=function(){var e=this,n=xe("div","emoji-picker__category-buttons"),a=this.options.showRecents?o(["recents"],this.options.categories||ke.categories):this.options.categories||ke.categories;return a.forEach((function(o){var a=xe("button","emoji-picker__category-button");a.innerHTML=Uo[o],a.tabIndex=-1,a.title=e.i18n.categories[o],n.appendChild(a),e.buttons.push(a),a.addEventListener("click",(function(){e.events.emit("categoryClicked",o)}))})),n.addEventListener("keydown",(function(o){switch(o.key){case"ArrowRight":e.events.emit("categoryClicked",a[(e.activeButton+1)%e.buttons.length]);break;case"ArrowLeft":e.events.emit("categoryClicked",a[0===e.activeButton?e.buttons.length-1:e.activeButton-1]);break;case"ArrowUp":case"ArrowDown":o.stopPropagation(),o.preventDefault()}})),n},e.prototype.setActiveButton=function(e,o){void 0===o&&(o=!0);var n=this.buttons[this.activeButton];n.classList.remove("active"),n.tabIndex=-1,this.activeButton=e,(n=this.buttons[this.activeButton]).classList.add("active"),n.tabIndex=0,o&&n.focus()},e}(),Jo={};ke.emoji.forEach((function(e){var o=Jo[ke.categories[e.category]];o||(o=Jo[ke.categories[e.category]]=[]),o.push(e)}));var Go=function(){function e(e,n,a){var i=this;this.events=e,this.i18n=n,this.options=a,this.currentCategory=0,this.headers=[],this.focusedIndex=0,this.handleKeyDown=function(e){switch(i.emojis.removeEventListener("scroll",i.highlightCategory),e.key){case"ArrowRight":i.focusedEmoji.tabIndex=-1,i.focusedIndex===i.currentEmojiCount-1&&i.currentCategory<i.categories.length?(i.options.showCategoryButtons&&i.categoryButtons.setActiveButton(++i.currentCategory),i.setFocusedEmoji(0)):i.setFocusedEmoji(i.focusedIndex+1);break;case"ArrowLeft":i.focusedEmoji.tabIndex=-1,0===i.focusedIndex&&i.currentCategory>0?(i.options.showCategoryButtons&&i.categoryButtons.setActiveButton(--i.currentCategory),i.setFocusedEmoji(i.currentEmojiCount-1)):i.setFocusedEmoji(Math.max(0,i.focusedIndex-1));break;case"ArrowDown":e.preventDefault(),i.focusedEmoji.tabIndex=-1,i.focusedIndex+i.emojisPerRow>=i.currentEmojiCount&&i.currentCategory<i.categories.length?(i.currentCategory++,i.options.showCategoryButtons&&i.categoryButtons.setActiveButton(i.currentCategory),i.setFocusedEmoji(i.focusedIndex%i.emojisPerRow)):i.setFocusedEmoji(i.focusedIndex+i.emojisPerRow);break;case"ArrowUp":if(e.preventDefault(),i.focusedEmoji.tabIndex=-1,i.focusedIndex<i.emojisPerRow&&i.currentCategory>0){var o=i.getEmojiCount(i.currentCategory-1),n=o%i.emojisPerRow;0===n&&(n=i.emojisPerRow);var a=i.focusedIndex,r=a>n-1?o-1:o-n+a;i.currentCategory--,i.options.showCategoryButtons&&i.categoryButtons.setActiveButton(i.currentCategory),i.setFocusedEmoji(r)}else i.setFocusedEmoji(i.focusedIndex>=i.emojisPerRow?i.focusedIndex-i.emojisPerRow:i.focusedIndex)}requestAnimationFrame((function(){return i.emojis.addEventListener("scroll",i.highlightCategory)}))},this.addCategory=function(e,o){var n=xe("h2","emoji-picker__category-name");n.innerHTML=i.i18n.categories[e]||Ko.categories[e],i.emojis.appendChild(n),i.headers.push(n),i.emojis.appendChild(new Ro(o,!0,i.events,i.options).render())},this.selectCategory=function(e,o){void 0===o&&(o=!0),i.emojis.removeEventListener("scroll",i.highlightCategory),i.focusedEmoji&&(i.focusedEmoji.tabIndex=-1);var n=i.categories.indexOf(e);i.currentCategory=n,i.setFocusedEmoji(0,!1),i.options.showCategoryButtons&&i.categoryButtons.setActiveButton(i.currentCategory,o);var a=i.headerOffsets[n];i.emojis.scrollTop=a,requestAnimationFrame((function(){return i.emojis.addEventListener("scroll",i.highlightCategory)}))},this.highlightCategory=function(){if(!document.activeElement||!document.activeElement.classList.contains("emoji-picker__emoji")){var e=i.headerOffsets.findIndex((function(e){return e>Math.round(i.emojis.scrollTop)}));0===e?e=1:e<0&&(e=i.headerOffsets.length),i.currentCategory=e-1,i.options.showCategoryButtons&&i.categoryButtons.setActiveButton(i.currentCategory)}},this.emojisPerRow=a.emojisPerRow||8,this.categories=a.categories||ke.categories,a.showRecents&&(this.categories=o(["recents"],this.categories))}return e.prototype.render=function(){var e=this;return this.container=xe("div","emoji-picker__emoji-area"),this.options.showCategoryButtons&&(this.categoryButtons=new Wo(this.options,this.events,this.i18n),this.container.appendChild(this.categoryButtons.render())),this.emojis=xe("div","emoji-picker__emojis"),this.options.showRecents&&(Jo.recents=Bo()),this.categories.forEach((function(o){return e.addCategory(o,Jo[o])})),requestAnimationFrame((function(){e.headerOffsets=Array.prototype.map.call(e.headers,(function(e){return e.offsetTop})),e.selectCategory("smileys",!1),e.currentCategory=e.options.showRecents?1:0,e.options.showCategoryButtons&&e.categoryButtons.setActiveButton(e.currentCategory,!1),setTimeout((function(){setTimeout((function(){return e.emojis.addEventListener("scroll",e.highlightCategory)}))}))})),this.emojis.addEventListener("keydown",this.handleKeyDown),this.events.on("categoryClicked",this.selectCategory),this.container.appendChild(this.emojis),this.container.querySelectorAll(".emoji-picker__emoji")[0].tabIndex=0,this.container},Object.defineProperty(e.prototype,"currentCategoryEl",{get:function(){return this.emojis.querySelectorAll(".emoji-picker__container")[this.currentCategory]},enumerable:!0,configurable:!0}),Object.defineProperty(e.prototype,"focusedEmoji",{get:function(){return this.currentCategoryEl.querySelectorAll(".emoji-picker__emoji")[this.focusedIndex]},enumerable:!0,configurable:!0}),Object.defineProperty(e.prototype,"currentEmojiCount",{get:function(){return this.currentCategoryEl.querySelectorAll(".emoji-picker__emoji").length},enumerable:!0,configurable:!0}),e.prototype.getEmojiCount=function(e){return this.emojis.querySelectorAll(".emoji-picker__container")[e].querySelectorAll(".emoji-picker__emoji").length},e.prototype.setFocusedEmoji=function(e,o){void 0===o&&(o=!0),this.focusedIndex=e,this.focusedEmoji&&(this.focusedEmoji.tabIndex=0,o&&this.focusedEmoji.focus())},e}(),Xo={position:"right-start",autoHide:!0,autoFocusSearch:!0,showPreview:!0,showSearch:!0,showRecents:!0,showVariants:!0,showCategoryButtons:!0,recentsCount:50,emojiVersion:"12.1",theme:"light",categories:["smileys","people","animals","food","activities","travel","objects","symbols","flags"],style:"native",emojisPerRow:8,rows:6,emojiSize:"1.8em"};return function(){function o(o){void 0===o&&(o={}),this.events=new w,this.publicEvents=new w,this.pickerVisible=!1,this.options=e(e({},Xo),o),this.options.rootElement||(this.options.rootElement=document.body),this.i18n=e(e({},Ko),o.i18n),this.onDocumentClick=this.onDocumentClick.bind(this),this.onDocumentKeydown=this.onDocumentKeydown.bind(this)}return o.prototype.on=function(e,o){this.publicEvents.on(e,o)},o.prototype.off=function(e,o){this.publicEvents.off(e,o)},o.prototype.buildPicker=function(){var e=this;this.pickerEl=xe("div","emoji-picker"),this.pickerEl.classList.add(this.options.theme),this.options.emojisPerRow&&this.pickerEl.style.setProperty("--emoji-per-row",this.options.emojisPerRow.toString()),this.options.rows&&this.pickerEl.style.setProperty("--row-count",this.options.rows.toString()),this.options.emojiSize&&this.pickerEl.style.setProperty("--emoji-size",this.options.emojiSize),this.options.showCategoryButtons||this.pickerEl.style.setProperty("--category-button-height","0"),this.focusTrap=h(this.pickerEl,{clickOutsideDeactivates:!0,initialFocus:this.options.autoFocusSearch?".emoji-picker__search":'.emoji-picker__emoji[tabindex="0"]'}),this.options.zIndex&&(this.pickerEl.style.zIndex=this.options.zIndex+"");var o=xe("div","emoji-picker__content");if(this.options.showSearch){var n=new Vo(this.events,this.i18n,this.options,ke.emoji,(this.options.categories||[]).map((function(e){return ke.categories.indexOf(e)}))).render();this.pickerEl.appendChild(n)}this.pickerEl.appendChild(o);var a,i=new Go(this.events,this.i18n,this.options).render();o.appendChild(i),this.events.on("showSearchResults",(function(e){Ee(o),e.classList.add("search-results"),o.appendChild(e)})),this.events.on("hideSearchResults",(function(){o.firstChild!==i&&(Ee(o),o.appendChild(i))})),this.options.showPreview&&this.pickerEl.appendChild(new _e(this.events,this.options).render()),this.events.on("emoji",(function(o){var n=o.emoji,i=o.showVariants;n.variations&&i&&e.options.showVariants?(a=new Ho(e.events,n,e.options).render())&&e.pickerEl.appendChild(a):(a&&a.parentNode===e.pickerEl&&e.pickerEl.removeChild(a),"twemoji"===e.options.style?e.publicEvents.emit("emoji",we.parse(n.emoji)):e.publicEvents.emit("emoji",n.emoji),e.options.autoHide&&e.hidePicker())})),this.events.on("hideVariantPopup",(function(){a&&(a.classList.add("hiding"),setTimeout((function(){a&&e.pickerEl.removeChild(a),a=null}),175))})),this.wrapper=xe("div","wrapper"),this.wrapper.appendChild(this.pickerEl),this.options.rootElement&&this.options.rootElement.appendChild(this.wrapper),setTimeout((function(){document.addEventListener("click",e.onDocumentClick),document.addEventListener("keydown",e.onDocumentKeydown)}))},o.prototype.onDocumentClick=function(e){this.pickerEl.contains(e.target)||this.hidePicker()},o.prototype.destroyPicker=function(){this.options.rootElement&&(this.options.rootElement.removeChild(this.wrapper),this.popper.destroy(),this.hideInProgress=!1)},o.prototype.hidePicker=function(){this.focusTrap.deactivate(),this.pickerVisible=!1,this.events.off("emoji"),this.events.off("hideVariantPopup"),this.hideInProgress=!0,this.pickerEl.classList.add("hiding"),this.destroyTimeout=setTimeout(this.destroyPicker.bind(this),170),document.removeEventListener("click",this.onDocumentClick),document.removeEventListener("keydown",this.onDocumentKeydown)},o.prototype.showPicker=function(e,o){void 0===o&&(o={}),this.hideInProgress&&(clearTimeout(this.destroyTimeout),this.destroyPicker()),this.pickerVisible=!0,this.buildPicker(),this.popper=pe(e,this.wrapper,{placement:o.position||this.options.position}),this.focusTrap.activate()},o.prototype.togglePicker=function(e,o){void 0===o&&(o={}),this.pickerVisible?this.hidePicker():this.showPicker(e,o)},o.prototype.onDocumentKeydown=function(e){if("Escape"===e.key)this.hidePicker();else if("Tab"===e.key)this.pickerEl.classList.add("keyboard");else if(e.key.match(/^[\w]$/)){var o=this.pickerEl.querySelector(".emoji-picker__search");o&&o.focus()}},o}()}));

        /* WEBPACK VAR INJECTION */}.call(this, __webpack_require__(/*! ./../../../webpack/buildin/global.js */ "./node_modules/webpack/buildin/global.js")))

      /***/ }),

    /***/ "./node_modules/webpack/buildin/global.js":
    /*!***********************************!*\
      !*** (webpack)/buildin/global.js ***!
      \***********************************/
    /*! no libs exports found */
    /***/ (function(module, exports) {

      var g;

// This works in non-strict mode
      g = (function() {
        return this;
      })();

      try {
        // This works if eval is allowed (see CSP)
        g = g || new Function("return this")();
      } catch (e) {
        // This works if the window reference is available
        if (typeof window === "object") g = window;
      }

// g can still be undefined, but nothing to do about it...
// We return undefined, instead of nothing here, so it's
// easier to handle this case. if(!global) { ...}

      module.exports = g;


      /***/ }),

    /***/ "./resources/js/frontend/afkar/messaging/context-menu.js":
    /*!***************************************************************!*\
      !*** ./resources/js/frontend/afkar/messaging/context-menu.js ***!
      \***************************************************************/
    /*! no libs exports found */
    /***/ (function(module, exports) {

// const container = $("#messaging>#content")
      var message = $(".messaging>.content .message");
      var contextMenuWidth = 120;
      var contextMenuHeight = 140;
      var windowWidth = window.innerWidth;
      var windowHeight = window.innerHeight;
      var type = 4;
      var messageId = -1;
      var isAdminMode = false;

      window.onresize = function () {
        windowWidth = window.innerWidth;
        windowHeight = window.innerHeight;
      };

      var TYPE_ANSWER = 0;
      var TYPE_EDIT = 1;
      var TYPE_COPY = 2;
      var TYPE_DELETE = 3;
      var menus = ["پاسخ", "ویرایش", "کپی", "حذف"];

      var setType = function setType(index) {
        type = index;
      };

      var getType = function getType() {
        return type;
      };

      var setMessageId = function setMessageId(id) {
        messageId = id;
      };

      var getMessageId = function getMessageId() {
        return messageId;
      };

      document.addEventListener("contextmenu", function (e) {
        checkCloseContextMenu(e.target);
      });
      document.addEventListener("click", function () {
        removeAllContextMenu();
      });

      var checkCloseContextMenu = function checkCloseContextMenu(tag) {
        var messageMode = $(tag).parents().hasClass("message") || $(tag).hasClass('message');
        if (!messageMode) removeAllContextMenu();
      };

      var removeAllContextMenu = function removeAllContextMenu() {
        $(".context-menu").remove();
      };

      var createContextMenu = function createContextMenu(x, y, tag, callback) {
        if (x + contextMenuWidth > windowWidth) {
          x = x - contextMenuWidth;
        }

        if (y + contextMenuHeight > windowHeight) {
          y = y - contextMenuHeight;
        }

        removeAllContextMenu();
        var contextMenuContainer = document.createElement("div");
        contextMenuContainer.classList.add("context-menu");
        contextMenuContainer.style.left = x + "px";
        contextMenuContainer.style.top = y + "px";
        var body = document.getElementById("messaging-container");
        body.appendChild(contextMenuContainer);

        if (isAdminMode) {
          $(".context-menu").css("height", "62px");
        } else {
          $(".context-menu").css("height", "auto");
        }

        menus.map(function (row, index) {
          if (isAdminMode) {
            if (row === "ویرایش" || row === "حذف") {
              return;
            }
          }

          var item = document.createElement("span");
          item.classList.add("item");
          item.innerText = row;
          item.addEventListener("click", function () {
            callback(index);
          });
          contextMenuContainer.appendChild(item);
        });
      };

      module.exports = {
        onContextMenuItemClickListener: function onContextMenuItemClickListener(callback) {
          $('body').on('DOMNodeInserted', function (e) {
            if ($(e.target).hasClass("message")) {
              $(".message").bind('contextmenu', function (event) {
                if ($(this).data("type") !== "text") {
                  return;
                }

                event.preventDefault();
                var tag = $(this).find(".textMessage");
                isAdminMode = tag.data("type") === "admin";
                var y = event.clientY;
                var x = event.clientX;
                var messageId = parseInt(tag.attr('id'));
                var contextTime = tag.data("time");

                if (Number.isNaN(messageId)) {
                  messageId = tag.parents(".message").attr("id");
                }

                createContextMenu(x, y, event.target, function (index) {
                  callback(tag.text(), messageId, index, tag.attr("data-sender"), contextTime);
                });
              });
            }
          });
          $(".message").bind('contextmenu', function (event) {
            if ($(this).data("type") !== "text") {
              return;
            }

            event.preventDefault();
            var tag = $(this).find(".textMessage");
            isAdminMode = tag.data("type") === "admin";
            var x = event.clientX;
            var y = event.clientY;
            var messageId = parseInt(tag.attr('id'));
            var contextTime = tag.data("time");

            if (Number.isNaN(messageId)) {
              messageId = tag.parents(".message").attr("id");
            }

            createContextMenu(x, y, event.target, function (index) {
              callback(tag.text(), messageId, index, tag.attr("data-sender"), contextTime);
            });
          });
        },
        setType: setType,
        getType: getType,
        setMessageId: setMessageId,
        getMessageId: getMessageId,
        TYPE_ANSWER: TYPE_ANSWER,
        TYPE_COPY: TYPE_COPY,
        TYPE_DELETE: TYPE_DELETE,
        TYPE_EDIT: TYPE_EDIT
      };

      /***/ }),

    /***/ "./resources/js/frontend/afkar/messaging/file-upload.js":
    /*!**************************************************************!*\
      !*** ./resources/js/frontend/afkar/messaging/file-upload.js ***!
      \**************************************************************/
    /*! no libs exports found */
    /***/ (function(module, exports) {

      function ownKeys(object, enumerableOnly) { var keys = Object.keys(object); if (Object.getOwnPropertySymbols) { var symbols = Object.getOwnPropertySymbols(object); if (enumerableOnly) symbols = symbols.filter(function (sym) { return Object.getOwnPropertyDescriptor(object, sym).enumerable; }); keys.push.apply(keys, symbols); } return keys; }

      function _objectSpread(target) { for (var i = 1; i < arguments.length; i++) { var source = arguments[i] != null ? arguments[i] : {}; if (i % 2) { ownKeys(Object(source), true).forEach(function (key) { _defineProperty(target, key, source[key]); }); } else if (Object.getOwnPropertyDescriptors) { Object.defineProperties(target, Object.getOwnPropertyDescriptors(source)); } else { ownKeys(Object(source)).forEach(function (key) { Object.defineProperty(target, key, Object.getOwnPropertyDescriptor(source, key)); }); } } return target; }

      function _defineProperty(obj, key, value) { if (key in obj) { Object.defineProperty(obj, key, { value: value, enumerable: true, configurable: true, writable: true }); } else { obj[key] = value; } return obj; }

      var chatDisplayJs = document.getElementById("chat-display");

      var getToken = function getToken() {
        return {
          headers: {
            'X-CSRF-TOKEN': $('#messaging-container').data('csrf')
          }
        };
      };

      var scrollDown = function scrollDown() {
        chatDisplayJs.scrollTop = chatDisplayJs.scrollHeight;
      };

      var fileInput = $("#file-input");
      $("#messaging-upload-file").click(function () {
        fileInput.click();
      });

      var setOnFileUploadListener = function setOnFileUploadListener(data, callback) {
        fileInput.on("change", function (event) {
          var fileReader = new FileReader();
          fileReader.readAsDataURL(event.target.files[0]);

          fileReader.onload = function () {
            var type;

            if (fileReader.result.startsWith("data:image")) {
              type = "image";
            } else if (fileReader.result.startsWith("data:audio")) {
              type = "audio";
            } else if (fileReader.result.startsWith("data:video")) {
              type = "video";
            }

            var src = fileReader.result;
            var result = getMessageRow(src, data, type);
            var display = document.getElementById("chat-display");
            var clearFix = getClearFix();
            display.appendChild(result);
            display.appendChild(clearFix);
            scrollDown();
            $.ajax(_objectSpread(_objectSpread({
              url: "/messaging/upload-file"
            }, getToken()), {}, {
              method: "POST",
              data: {
                src: src,
                type: type
              }
            })).done(function (data) {
              setTimeout(function () {
                data.time = result.id;
                data.tagId = result.id;
                callback(data, type);
              }, 1000);
            });
          };
        });
      };

      var getClearFix = function getClearFix(id) {
        var tag = document.createElement("div");
        tag.classList.add("clearfix");
        tag.classList.add(id);
        return tag;
      };

      function getMessageRow(src, data, type) {
        var parent = document.createElement("div");
        parent.classList.add("message", "user");
        parent.classList.add(type + "t");
        parent.id = new Date().getTime() + "";
        parent.style.maxWidth = "230px !important";
        parent.style.width = "230px";
        var avatar = document.createElement("span");
        avatar.classList.add("display-avatar", data.avatarClass);
        avatar.innerText = data.avatarName;
        parent.appendChild(avatar);

        if (type === "image") {
          var file = document.createElement("img");
          file.classList.add("file");
          file.src = src;
          parent.appendChild(file);
        } else if (type === "video") {
          var _file = document.createElement("video");

          _file.classList.add("file");

          _file.controls = true;
          _file.autoplay = false;
          _file.src = src;

          _file.classList.add("videot");

          parent.appendChild(_file);
        } else if (type === "audio") {
          var _file2 = document.createElement("audio");

          _file2.classList.add("file");

          _file2.controls = true;
          _file2.autoplay = false;
          _file2.style.width = "213px";
          _file2.src = src;
          parent.appendChild(_file2);
        }

        var pending = document.createElement("i");
        pending.classList.add("fa", "fa-clock", "pending", "active");
        parent.appendChild(pending);
        var checkParent = document.createElement("span");
        checkParent.classList.add("fa-stack", "fa-lg", "text-success", "sent");
        parent.appendChild(checkParent);
        var firstCheck = document.createElement("i");
        firstCheck.classList.add("fa", "fa-check", "fa-stack-1x", "first");
        checkParent.appendChild(firstCheck);
        var secontCheck = document.createElement("i");
        secontCheck.classList.add("fa", "fa-check", "fa-inverse", "fa-stack-1x", "second");
        checkParent.appendChild(secontCheck);
        return parent;
      }

      module.exports = {
        setOnFileUploadListener: setOnFileUploadListener
      };

      /***/ }),

    /***/ "./resources/js/frontend/afkar/messaging/index.js":
    /*!********************************************************!*\
      !*** ./resources/js/frontend/afkar/messaging/index.js ***!
      \********************************************************/
    /*! no exports provided */
    /***/ (function(module, __webpack_exports__, __webpack_require__) {

      "use strict";
      __webpack_require__.r(__webpack_exports__);
      /* harmony import */ var _pusher__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./pusher */ "./resources/js/frontend/afkar/messaging/pusher.js");
      /* harmony import */ var _pusher__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(_pusher__WEBPACK_IMPORTED_MODULE_0__);
      /* harmony import */ var _context_menu__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./context-menu */ "./resources/js/frontend/afkar/messaging/context-menu.js");
      /* harmony import */ var _context_menu__WEBPACK_IMPORTED_MODULE_1___default = /*#__PURE__*/__webpack_require__.n(_context_menu__WEBPACK_IMPORTED_MODULE_1__);
      /* harmony import */ var _viewManager__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ./viewManager */ "./resources/js/frontend/afkar/messaging/viewManager.js");
      /* harmony import */ var _viewManager__WEBPACK_IMPORTED_MODULE_2___default = /*#__PURE__*/__webpack_require__.n(_viewManager__WEBPACK_IMPORTED_MODULE_2__);
      /* harmony import */ var _pre_chat__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! ./pre-chat */ "./resources/js/frontend/afkar/messaging/pre-chat.js");
      /* harmony import */ var _pre_chat__WEBPACK_IMPORTED_MODULE_3___default = /*#__PURE__*/__webpack_require__.n(_pre_chat__WEBPACK_IMPORTED_MODULE_3__);
      /* harmony import */ var _file_upload__WEBPACK_IMPORTED_MODULE_4__ = __webpack_require__(/*! ./file-upload */ "./resources/js/frontend/afkar/messaging/file-upload.js");
      /* harmony import */ var _file_upload__WEBPACK_IMPORTED_MODULE_4___default = /*#__PURE__*/__webpack_require__.n(_file_upload__WEBPACK_IMPORTED_MODULE_4__);
      /* harmony import */ var _joeattardi_emoji_button__WEBPACK_IMPORTED_MODULE_5__ = __webpack_require__(/*! @joeattardi/emoji-button */ "./node_modules/@joeattardi/emoji-button/dist/index.js");
      /* harmony import */ var _joeattardi_emoji_button__WEBPACK_IMPORTED_MODULE_5___default = /*#__PURE__*/__webpack_require__.n(_joeattardi_emoji_button__WEBPACK_IMPORTED_MODULE_5__);






      var channel = _viewManager__WEBPACK_IMPORTED_MODULE_2___default.a.getChannel();
      document.addEventListener("DOMContentLoaded", function () {
        _pusher__WEBPACK_IMPORTED_MODULE_0___default.a.setOnEnterUserListener(channel, function (data) {
          _viewManager__WEBPACK_IMPORTED_MODULE_2___default.a.enterUser(data);

          if (data.entered) {
            _pusher__WEBPACK_IMPORTED_MODULE_0___default.a.initialize(data.channel);
            _viewManager__WEBPACK_IMPORTED_MODULE_2___default.a.setUserInfo(data.name);
            initialized(data);
          } else {
            _pre_chat__WEBPACK_IMPORTED_MODULE_3___default.a.onStartChatClickListener(function (name, email, phone) {
              _viewManager__WEBPACK_IMPORTED_MODULE_2___default.a.setUserInfo(name);
              _pusher__WEBPACK_IMPORTED_MODULE_0___default.a.startChat(name, email, phone, function (data) {
                _pusher__WEBPACK_IMPORTED_MODULE_0___default.a.initialize(data.channel);
                _viewManager__WEBPACK_IMPORTED_MODULE_2___default.a.startChat(data);
                initialized(data);
              });
            });
          }
        });
        _viewManager__WEBPACK_IMPORTED_MODULE_2___default.a.setOnTypingListener(function (result) {// pusher.sentTypingMessage(channel, result)
        });

        var createEmoji = function createEmoji() {
          var button = document.querySelector('#select-emoji');
          var picker = new _joeattardi_emoji_button__WEBPACK_IMPORTED_MODULE_5___default.a({
            emojiVersion: '12.1',
            rootElement: document.getElementById("messaging"),
            autoHide: false,
            autoFocusSearch: false,
            showPreview: false,
            showSearch: false,
            showRecents: false,
            showVariants: false,
            style: 'native',
            theme: 'light',
            recentsCount: 0,
            zIndex: 9999999999999,
            // an array of the categories to show
            categories: ['smileys'],
            i18n: {
              categories: {
                smileys: " "
              }
            }
          });
          picker.on('emoji', function (emoji) {
            document.querySelector('#message-input').value += emoji; // resetMessage()
          });
          button.addEventListener('click', function () {
            picker.pickerVisible ? picker.hidePicker() : picker.showPicker(button); // $(".emoji-picker__search").css("text-align","right !important")
            // $(".emoji-picker__search").css("direction","rtl !important")
          });
        };

        var initialized = function initialized(data, channel) {
          createEmoji();

          if (data.entered) {
            $(".pre-chat").removeClass("active");
            $("#chat-display").addClass("active");
            _viewManager__WEBPACK_IMPORTED_MODULE_2___default.a.onSendMessageClickListener(function (data) {
              $(".answer").removeClass("active");
              var type = _context_menu__WEBPACK_IMPORTED_MODULE_1___default.a.getType();
              var messageId = _context_menu__WEBPACK_IMPORTED_MODULE_1___default.a.getMessageId();

              if (data.message.trim().length === 0) {
                return;
              }

              reset();

              if (_viewManager__WEBPACK_IMPORTED_MODULE_2___default.a.getInsEditMode()) {
                var _messageId = _viewManager__WEBPACK_IMPORTED_MODULE_2___default.a.getEditMessageId();

                _pusher__WEBPACK_IMPORTED_MODULE_0___default.a.editMessage(1, _messageId, data, function (result) {// viewManager.updateMessageDisplay(result)
                });
              } else {
                _pusher__WEBPACK_IMPORTED_MODULE_0___default.a.sendMessage(type, messageId, data, function (result) {
                  _viewManager__WEBPACK_IMPORTED_MODULE_2___default.a.updateMessageDisplay(result);
                });
              }
            });
          }

          _file_upload__WEBPACK_IMPORTED_MODULE_4___default.a.setOnFileUploadListener(data, function (data, fileType) {
            $(".answer").removeClass("active"); // const type = contextMenu.getType()
            // const messageId = contextMenu.getMessageId()

            reset();
            data.fileType = fileType;
            data.isFile = true;
            _pusher__WEBPACK_IMPORTED_MODULE_0___default.a.sendMessage(null, -1, data, function (result) {
              _viewManager__WEBPACK_IMPORTED_MODULE_2___default.a.updateMessageDisplay(result);
            });
          });
          _viewManager__WEBPACK_IMPORTED_MODULE_2___default.a.releaseMessages(data.messages);
          _pusher__WEBPACK_IMPORTED_MODULE_0___default.a.setOnMessageReceivedListener(function (data) {
            _viewManager__WEBPACK_IMPORTED_MODULE_2___default.a.releaseAdminMessage(data);
          });
          _pusher__WEBPACK_IMPORTED_MODULE_0___default.a.setOnMessageDeleteListener(function (data) {
            var tag = document.getElementById(data.message_id);

            if (tag != null) {
              console.log(tag.parentNode);
              tag.parentNode.remove();
            }
          });

          var copyElementText = function copyElementText(id) {
            var text = document.getElementById(id).innerText;
            var elem = document.createElement("textarea");
            document.body.appendChild(elem);
            elem.value = text;
            elem.select();
            document.execCommand("copy");
            document.body.removeChild(elem);
          };

          _context_menu__WEBPACK_IMPORTED_MODULE_1___default.a.onContextMenuItemClickListener(function (message, messageId, index, sender, time) {
            _viewManager__WEBPACK_IMPORTED_MODULE_2___default.a.initContextType(index, messageId, message, sender);
            _viewManager__WEBPACK_IMPORTED_MODULE_2___default.a.setContextMessage(sender, message, messageId, time);
            console.log(message, messageId, index, sender, time);

            if (index === _context_menu__WEBPACK_IMPORTED_MODULE_1___default.a.TYPE_ANSWER) {
              _viewManager__WEBPACK_IMPORTED_MODULE_2___default.a.answerClicked(message, messageId);
              _context_menu__WEBPACK_IMPORTED_MODULE_1___default.a.setType(index);
              _context_menu__WEBPACK_IMPORTED_MODULE_1___default.a.setMessageId(messageId);
              $('input#message-input').focus();
            } else if (index === _context_menu__WEBPACK_IMPORTED_MODULE_1___default.a.TYPE_COPY) {
              copyElementText(messageId);
            } else if (index === _context_menu__WEBPACK_IMPORTED_MODULE_1___default.a.TYPE_DELETE) {
              var tag = $(document.getElementById(messageId)).parents(".user");
              tag.remove();
              _pusher__WEBPACK_IMPORTED_MODULE_0___default.a.deleteMessage(messageId);
            }
          });
          _viewManager__WEBPACK_IMPORTED_MODULE_2___default.a.onAnswerCancelListener(function () {
            _viewManager__WEBPACK_IMPORTED_MODULE_2___default.a.initContextType(null, -1, null);
          });
          _viewManager__WEBPACK_IMPORTED_MODULE_2___default.a.setOnMessageEditListener(function (data) {// viewManager.initContextType(null, -1, null)
          });
          _pusher__WEBPACK_IMPORTED_MODULE_0___default.a.setOnMessageEditListener(function (data) {
            var tag = document.getElementById(data.message_id);

            if (tag != null) {
              tag.innerText = data.message;
            }
          });
          _pusher__WEBPACK_IMPORTED_MODULE_0___default.a.setOnMessageSentListener(function (data) {
            _viewManager__WEBPACK_IMPORTED_MODULE_2___default.a.releaseMessage(data);
          });
          _pusher__WEBPACK_IMPORTED_MODULE_0___default.a.setOnDeliveredListener(function () {
            $(".first").addClass("active");
            $(".second").addClass("active");
            $(".pending").removeClass("active");
          });

          var reset = function reset() {
            _viewManager__WEBPACK_IMPORTED_MODULE_2___default.a.initContextType(null, -1, null);
          };
        };
      });

      /***/ }),

    /***/ "./resources/js/frontend/afkar/messaging/pre-chat.js":
    /*!***********************************************************!*\
      !*** ./resources/js/frontend/afkar/messaging/pre-chat.js ***!
      \***********************************************************/
    /*! no libs exports found */
    /***/ (function(module, exports) {

      var nameTag = document.getElementById("chatName");
      var emailTag = document.getElementById("chatEmail");
      var phoneTag = document.getElementById("chatPhone");
      var startChat = document.getElementById("startChat");
      $(".error .fa-times").click(function () {
        $(".error").removeClass("active");
      });
      $("#messaging-container .minimize").click(function () {
        var messaging = $(".messaging");
        if (messaging.hasClass("active")) {
          minimize();
        } else {
          show();
        }
      });

      function minimize() {
        $(".messaging").removeClass("active");
        $("#messaging-container .minimize").removeClass("fa-minus").addClass("fa-angle-up");
      }

      function show() {
        $("#messaging-container .minimize").removeClass("fa-angle-up").addClass("fa-minus");
        $(".messaging").addClass("active");
      }

      var hasError = function hasError(name, email, phone) {
        $(".name-r").removeClass("active");
        $(".name2ch").removeClass("active");
        $(".email-wr").removeClass("active");
        $(".phone-r").removeClass("active");
        $(".phone-wr").removeClass("active");
        var hasError = false;

        if (name === "") {
          $(".name-r").addClass("active");
          hasError = true;
        }

        if (name.length < 3) {
          $(".name2ch").addClass("active");
          hasError = true;
        }

        if (email.trim().length > 0 && !isValidateEmail(email)) {
          $(".email-wr").addClass("active");
          hasError = true;
        }

        if (phone.trim().length === 0) {
          $(".phone-r").addClass("active");
          hasError = true;
        }

        if (phone.trim().length !== 11) {
          $(".phone-wr").addClass("active");
          hasError = true;
        }

        if (hasError) {
          $(".error").addClass("active");
        }

        return hasError;
      };

      function isValidateEmail(email) {
        var re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
        return re.test(String(email).toLowerCase());
      }

      module.exports = {
        onStartChatClickListener: function onStartChatClickListener(callback) {
          startChat.addEventListener("click", function () {
            var name = nameTag.value;
            var email = emailTag.value;
            var phone = phoneTag.value;

            if (!hasError(name, email, phone)) {
              callback(name, email, phone);
            }
          });
        }
      };

      /***/ }),

    /***/ "./resources/js/frontend/afkar/messaging/pusher.js":
    /*!*********************************************************!*\
      !*** ./resources/js/frontend/afkar/messaging/pusher.js ***!
      \*********************************************************/
    /*! no libs exports found */
    /***/ (function(module, exports) {

      function ownKeys(object, enumerableOnly) { var keys = Object.keys(object); if (Object.getOwnPropertySymbols) { var symbols = Object.getOwnPropertySymbols(object); if (enumerableOnly) symbols = symbols.filter(function (sym) { return Object.getOwnPropertyDescriptor(object, sym).enumerable; }); keys.push.apply(keys, symbols); } return keys; }

      function _objectSpread(target) { for (var i = 1; i < arguments.length; i++) { var source = arguments[i] != null ? arguments[i] : {}; if (i % 2) { ownKeys(Object(source), true).forEach(function (key) { _defineProperty(target, key, source[key]); }); } else if (Object.getOwnPropertyDescriptors) { Object.defineProperties(target, Object.getOwnPropertyDescriptors(source)); } else { ownKeys(Object(source)).forEach(function (key) { Object.defineProperty(target, key, Object.getOwnPropertyDescriptor(source, key)); }); } } return target; }

      function _defineProperty(obj, key, value) { if (key in obj) { Object.defineProperty(obj, key, { value: value, enumerable: true, configurable: true, writable: true }); } else { obj[key] = value; } return obj; }

      var getToken = function getToken() {
        return {
          headers: {
            'X-CSRF-TOKEN': $('#messaging-container').data('csrf')
          }
        };
      };

      var pusher = new Pusher("841ccacde0f57782978c", {
        cluster: "eu",
        forceTLS: true
      });
      var channel = null;

      var setOnMessageSentListener = function setOnMessageSentListener(callback) {
        channel.bind('send', function (data) {
          callback(data);
        });
      };

      var setOnMessageReceivedListener = function setOnMessageReceivedListener(callback) {
        channel.bind("receive_message", function (data) {
          callback(data);
        });
      };

      var initialize = function initialize(_channel) {
        channel = pusher.subscribe(_channel);
      };

      var sendMessage = function sendMessage(type, messageId, data, callback) {
        $.ajax(_objectSpread(_objectSpread({}, getToken()), {}, {
          url: "/messaging/send",
          method: "POST",
          data: _objectSpread(_objectSpread({}, data), {}, {
            type: type,
            messageId: messageId
          })
        })).done(function (data) {
          return callback(data);
        });
      };

      var editMessage = function editMessage(type, messageId, data, callback) {
        $.ajax(_objectSpread(_objectSpread({}, getToken()), {}, {
          url: "/messaging/edit-message",
          method: "POST",
          data: _objectSpread(_objectSpread({}, data), {}, {
            type: type,
            messageId: messageId
          })
        })).done(function (data) {
          return callback(data);
        });
      };

      var startChat = function startChat(name, email, phone, callback) {
        $.ajax(_objectSpread(_objectSpread({}, getToken()), {}, {
          url: "/messaging/start",
          method: "POST",
          data: {
            name: name,
            email: email,
            phone: phone
          }
        })).done(function (data) {
          return callback(data);
        });
      };

      var setOnEnterUserListener = function setOnEnterUserListener(channel, callback) {
        $.ajax(_objectSpread(_objectSpread({}, getToken()), {}, {
          url: "/messaging/enter",
          method: "POST",
          data: {
            channel: channel
          }
        })).done(function (data) {
          callback(data);
        });
      };

      var sentTypingMessage = function sentTypingMessage(channel, type) {
        $.ajax(_objectSpread(_objectSpread({}, getToken()), {}, {
          url: "/messaging/sendTypingMessage",
          method: "POST",
          data: {
            channel: channel,
            type: type
          }
        })).done(function (data) {});
      };

      var deleteMessage = function deleteMessage(messageId) {
        $.ajax(_objectSpread(_objectSpread({}, getToken()), {}, {
          url: "/messaging/delete",
          method: "POST",
          data: {
            messageId: messageId
          }
        }));
      };

      var setOnDeliveredListener = function setOnDeliveredListener(callback) {
        channel.bind('delivered', function (data) {
          callback(data);
        });
      };

      var setOnMessageDeleteListener = function setOnMessageDeleteListener(callback) {
        channel.bind('delete-message', function (data) {
          callback(data);
        });
      };

      var setOnMessageEditListener = function setOnMessageEditListener(callback) {
        channel.bind('edit-message', function (data) {
          callback(data);
        });
      };

      module.exports = {
        sendMessage: sendMessage,
        setOnMessageSentListener: setOnMessageSentListener,
        setOnMessageReceivedListener: setOnMessageReceivedListener,
        startChat: startChat,
        deleteMessage: deleteMessage,
        setOnEnterUserListener: setOnEnterUserListener,
        initialize: initialize,
        editMessage: editMessage,
        setOnDeliveredListener: setOnDeliveredListener,
        sentTypingMessage: sentTypingMessage,
        setOnMessageDeleteListener: setOnMessageDeleteListener,
        setOnMessageEditListener: setOnMessageEditListener
      };

      /***/ }),

    /***/ "./resources/js/frontend/afkar/messaging/viewManager.js":
    /*!**************************************************************!*\
      !*** ./resources/js/frontend/afkar/messaging/viewManager.js ***!
      \**************************************************************/
    /*! no libs exports found */
    /***/ (function(module, exports) {

      function _typeof(obj) { "@babel/helpers - typeof"; if (typeof Symbol === "function" && typeof Symbol.iterator === "symbol") { _typeof = function _typeof(obj) { return typeof obj; }; } else { _typeof = function _typeof(obj) { return obj && typeof Symbol === "function" && obj.constructor === Symbol && obj !== Symbol.prototype ? "symbol" : typeof obj; }; } return _typeof(obj); }

      var footer = $(".messaging .footer");
      var answer = $('.answer');
      var answerText = $(".answer-text");
      var closeAnswer = $(".close-answer");
      var message = $("#message-input");
      var messagingContent = document.getElementById("chat-display");
      var preChat = $(".messaging .content .pre-chat");
      var sendMessage = $(".messaging #sendMessage");
      var messageContainer = $(".messaging .content");
      var chatDisplay = $(".messaging #chat-display");
      var chatDisplayJs = document.getElementById("chat-display");
      var contextMessageSender = null;
      var contextMessageText = null;
      var contextSenderMessageId = null;
      var contextTime = null;
      var avatarName = null;
      var avatarClass = null;
      var name = null;
      var contextType = null;
      var messageId = -1;
      var messageText = -1;
      var username;

      var setContextMessage = function setContextMessage(sender, text, id, time) {
        contextMessageSender = sender;
        contextMessageText = text;
        contextSenderMessageId = time;
        contextTime = time;
      };

      var initContextType = function initContextType(ct, mId, mt, sender) {
        contextType = ct;
        messageId = mId;
        messageText = mt;
        contextMessageText = mt;
        contextMessageSender = sender;
      };

      var setCookie = function setCookie(cname, value) {
        var d = new Date();
        d.setTime(d.getTime() + 30 * 24 * 60 * 60 * 1000);
        var expires = "expires=" + d.toUTCString();
        document.cookie = cname + "=" + value + ";" + expires + ";path=/";
      };

      var getCookie = function getCookie(cname) {
        var name = cname + "=";
        var decodedCookie = decodeURIComponent(document.cookie);
        var ca = decodedCookie.split(';');

        for (var i = 0; i < ca.length; i++) {
          var c = ca[i];

          while (c.charAt(0) === ' ') {
            c = c.substring(1);
          }

          if (c.indexOf(name) === 0) {
            return c.substring(name.length, c.length);
          }
        }

        return null;
      };

      var loginMode = function loginMode() {
        footer.addClass("hidden");
        messagingContent.classList.remove("active");
        messagingContent.classList.remove("fullPage");
        preChat.addClass("active");
      };

      var chatMode = function chatMode() {
        preChat.removeClass("active");
        messagingContent.classList.add("active");
        messagingContent.classList.add("fullPage");
        footer.addClass("active");
        messageContainer.addClass("chatMode");
      };

      var configView = function configView() {
        var channel = getChannel();

        if (channel === null || parseInt(channel) === -1) {
          loginMode();
        } else {
          chatMode();
        }
      };

      var answerClicked = function answerClicked(message, messageId) {
        if (message.length >= 28) {
          message = message.substring(0, 28) + " ...";
        }

        if (!answer.hasClass("active")) {
          answer.addClass("active");
        }

        answerText.empty().append(message);
      };

      var onAnswerCancelListener = function onAnswerCancelListener(callback) {
        closeAnswer.click(function () {
          answer.removeClass("active");
          callback();
        });
      };

      var now = function now() {
        return new Date().getTime();
      };

      var getCreatedAt = function getCreatedAt() {
        var result = new Date().toLocaleTimeString('en-IR');
        result = result.split(":");
        var time = "";

        for (var i = 0; i < result.length; i++) {
          var row = result[i];

          if (row.toString().length === 1) {
            row = "0" + row;
          }

          time += row + ":";
        }

        return convertToPersian(time.substr(0, 5));
      };

      var convertToPersian = function convertToPersian(string) {
        var id = ['۰', '۱', '۲', '۳', '۴', '۵', '۶', '۷', '۸', '۹'];
        return string.replace(/[0-9]/g, function (w) {
          return id[+w];
        });
      };

      var onSendMessageClickListener = function onSendMessageClickListener(callback) {
        message.on("keyup", function (event) {
          if (event.keyCode === 13) {
            if (message.val().toString().trim().length === 0) return;
            callback(addPendingMessage());
          }
        });
        sendMessage.click(function () {
          return callback(addPendingMessage());
        });
      };

      var addPendingMessage = function addPendingMessage() {
        var textMessage = message.val();
        if (textMessage.trim().length === 0) return;
        message.val("");
        var id = now();
        var data = {
          type: "user",
          isLocalAdd: true,
          message: textMessage,
          id: contextSenderMessageId,
          avatar: avatarName.toUpperCase(),
          className: avatarClass,
          time: id,
          tagId: id,
          sender: username,
          parent_sender: contextMessageSender,
          context_message: contextMessageText,
          message_type: "text",
          created_at: getCreatedAt(),
          status: "pending"
        };

        if (contextType === 0) {
          data.context_type = contextType;
          data.answer_text = messageText.substring(0, 15);
          data.answer_name = name;
          data.context_message_id = id;
        }

        if (!isEditMode) addMessage(data);else editMesage(data);
        return data;
      };

      function editMesage(data) {
        var tag = document.getElementById(data.id);

        if (tag != null) {
          tag.innerText = data.message;
        }
      }

      function isObject(data) {
        return _typeof(data) === 'object';
      }

      var releaseMessages = function releaseMessages(messages) {
        if (Array.isArray(messages)) messages.map(function (row) {
          addMessage(row);
        });
      };

      var scrollDown = function scrollDown() {
        chatDisplayJs.scrollTop = chatDisplayJs.scrollHeight;
      };

      var addMessage = function addMessage(data) {
        var message = document.createElement("div");
        message.classList.add("message");
        message.setAttribute("data-type", data.message_type);
        message.classList.add(data.type);
        message.classList.add(data.message_type + "t"); // message.id = data.time

        var avatar = document.createElement("span");
        avatar.classList.add("display-avatar");
        avatar.classList.add(data.className);
        avatar.innerText = data.avatar.toUpperCase();
        message.appendChild(avatar);

        if (parseInt(data.context_type) === 0 || parseInt(data.context_type) === 4) {
          message.classList.add("answerType");
          var answerContainer = document.createElement("div");
          answerContainer.classList.add("answerContainer");
          message.appendChild(answerContainer);
          var answerName = document.createElement("span");
          answerName.classList.add("name");
          answerName.innerText = data.parent_sender;
          answerContainer.appendChild(answerName);

          var _answerText = document.createElement("span");

          _answerText.classList.add("text");

          if (data.context_type === 4) {
            _answerText.innerText = "حذف شده";
            answerName.style.display = "none";
          } else {
            _answerText.innerText = data.context_message;
          }

          answerContainer.appendChild(_answerText);
          answerContainer.addEventListener("click", function () {
            var hash = "#" + data.context_message_id;
            window.location.hash = hash;
            history.replaceState(null, null, ' ');
          });
        }

        var text = getMessageType(data);
        message.appendChild(text);
        var date;

        if (data.isLocalAdd) {
          date = data.created_at;
        } else {
          date = data.time;
        }

        var time = document.createElement("time");
        time.classList.add("time");
        time.innerText = date;
        message.appendChild(time);

        if (data.type === "user") {
          var status = document.createElement("span");
          status.classList.add("fa-stack");
          status.classList.add("fa-lg");
          status.classList.add("text-success");
          status.classList.add("sent");
          message.appendChild(status);
          var first = document.createElement("i");
          first.classList.add("fa");
          first.classList.add("fa-check");
          first.classList.add("fa-stack");
          first.classList.add("fa-stack-1x");
          first.classList.add("first");
          status.appendChild(first);

          if (data.status === "delivered" || data.status === "sent") {
            first.classList.add("active");
          }

          var second = document.createElement("i");
          second.classList.add("fa");
          second.classList.add("fa-check");
          second.classList.add("fa-stack");
          second.classList.add("fa-stack-1x");
          second.classList.add("second");
          status.appendChild(second);

          if (data.status === "delivered") {
            second.classList.add("active");
          }
        }

        chatDisplay.append(message);
        chatDisplay.append(getClearFix());
        scrollDown();
      };

      function getMessageType(data) {
        if (data.message_type === "text") {
          var text = document.createElement("span");
          text.innerText = data.message;
          text.id = data.tagId;
          text.classList.add("textMessage");
          text.setAttribute("data-time", data.time);
          text.setAttribute("data-sender", data.sender);
          text.setAttribute("data-type", data.type);
          return text;
        } else if (data.message_type === "image") {
          var image = document.createElement("img");
          image.id = data.id + "t";
          image.src = "/" + data.message;
          image.classList.add("textMessage", "image");
          image.style.width = "250px";
          return image;
        } else if (data.message_type === "audio") {
          var _image = document.createElement("audio");

          _image.id = data.id + "t";
          _image.src = "/" + data.message;

          _image.classList.add("textMessage", "audio");

          _image.style.width = "212px";
          _image.controls = true;
          return _image;
        } else if (data.message_type === "video") {
          var _image2 = document.createElement("video");

          _image2.id = data.id + "t";
          _image2.src = "/" + data.message;
          _image2.controls = true;

          _image2.classList.add("textMessage", "video");

          _image2.style.width = "212px";
          return _image2;
        }
      }

      var convertTime = function convertTime(time) {
        var result = new Date(time).toLocaleTimeString('en-IR');
        return result.substring(0, 5);
      };

      var updateMessageDisplay = function updateMessageDisplay(data) {
        if (!isObject(data)) {
          data = JSON.parse(data);
        }

        var id = data.id;

        if (data.status === "pending") {
          var tag = getMessageTag(data);
          messagingContent.appendChild(tag);
          messagingContent.appendChild(getClearFix());
        } else if (data.status === "sent") {
          var messageTag = document.getElementById(id);
          $(messageTag).parent().find(".pending").removeClass("active");
          $(messageTag).parent().find(".sent").addClass("active");
          $(messageTag).parent().find(".first").addClass("active");
        } else if (data.status === "delivered") {
          var _messageTag = document.getElementById(id);

          $(_messageTag).parent().find(".pending").removeClass("active");
          $(_messageTag).parent().find(".sent").addClass("active");
          $(_messageTag).parent().find(".first").addClass("active");
          $(_messageTag).parent().find(".second").addClass("active");
        }
      };

      var releaseAdminMessage = function releaseAdminMessage(data) {
        addMessage(data); // const parent = document.createElement("div")
        // parent.classList.add("message")
        // parent.classList.add("admin")
        // parent.id = data.id
        //
        // const messageBodyTag = document.createElement("span");
        // messageBodyTag.classList.add("text")
        // messageBodyTag.innerText = data.message
        // parent.appendChild(messageBodyTag)
        // messagingContent.appendChild(parent)
        // messagingContent.appendChild(getClearFix())
      };

      var getMessageTag = function getMessageTag(type, id, message) {
        var parent = document.createElement("div");
        parent.classList.add("message");
        parent.classList.add(type);
        parent.id = id;
        var messageBodyTag = document.createElement("span");
        messageBodyTag.classList.add("text");
        messageBodyTag.innerText = message;
        parent.appendChild(messageBodyTag);
        var pending = document.createElement("i");
        pending.classList.add("fa");
        pending.classList.add("fa-clock");
        pending.classList.add("pending");
        pending.classList.add("active");
        parent.appendChild(pending);
        var checkParent = document.createElement("span");
        checkParent.classList.add("fa-stack");
        checkParent.classList.add("fa-lg");
        checkParent.classList.add("text-success");
        checkParent.classList.add("sent");
        parent.appendChild(checkParent);
        var firstCheck = document.createElement("i");
        firstCheck.classList.add("fa");
        firstCheck.classList.add("fa-check");
        firstCheck.classList.add("fa-stack-1x");
        firstCheck.classList.add("first");
        checkParent.appendChild(firstCheck);
        var secontCheck = document.createElement("i");
        secontCheck.classList.add("fa");
        secontCheck.classList.add("fa-check");
        secontCheck.classList.add("fa-inverse");
        secontCheck.classList.add("fa-stack-1x");
        secontCheck.classList.add("second");
        checkParent.appendChild(secontCheck);
        return parent;
      };

      var getClearFix = function getClearFix() {
        var tag = document.createElement("div");
        tag.classList.add("clearfix");
        tag.style.clear = "both";
        return tag;
      };

      var getChannelKey = function getChannelKey() {
        return "messaging_channel_key";
      };

      var removeChannelCookie = function removeChannelCookie() {
        setCookie(getChannelKey(), -1);
      };

      var getChannel = function getChannel() {
        return getCookie(getChannelKey());
      };

      var startChat = function startChat(data) {
        setCookie(getChannelKey(), data.channel);
        chatMode();
      };

      var enterUser = function enterUser(result) {
        avatarName = result.avatarName;
        avatarClass = result.avatarClass;
        name = result.name;

        if (result.entered) {
          chatMode();
          setCookie(getChannelKey(), result.channel);
        } else {
          removeChannelCookie();
          loginMode();
        }
      };

      var setOnTypingListener = function setOnTypingListener(callback) {
        message.on("keyup", function (event) {
          var result = message.val(); // setTimeout(() => {
          //
          // },5000)

          if (result === "") {//callback("stopTyping")
          } else {//callback("typing")
          }
        });
      };

      var setUserInfo = function setUserInfo(name) {
        username = name;
      };

      var isEditMode = false;
      var editMessageId = -1;

      var setOnMessageEditListener = function setOnMessageEditListener(callback) {
        document.addEventListener("click", function (event) {
          if ($(event.target).hasClass("item") && event.target.innerText == "ویرایش") {
            var mId = messageId;
            var type = contextType;
            var tag = document.getElementById(mId);
            var text = tag.innerText;
            var messageInput = $("#message-input");
            messageInput.val(text);
            editMessageId = messageId;
            $(".answer").addClass("active");
            $(".answer-text").text("ویرایش : " + text.substr(0, 30));
            isEditMode = true;
            $(".close-answer").click(function () {
              editMessageId = -1;
              isEditMode = false;
              messageInput.val("");
            });
          }
        });
      };

      var getInsEditMode = function getInsEditMode() {
        return isEditMode;
      };

      var getEditMessageId = function getEditMessageId() {
        return editMessageId;
      };

      module.exports = {
        answerClicked: answerClicked,
        getInsEditMode: getInsEditMode,
        setUserInfo: setUserInfo,
        onAnswerCancelListener: onAnswerCancelListener,
        onSendMessageClickListener: onSendMessageClickListener,
        updateMessageDisplay: updateMessageDisplay,
        releaseMessages: releaseMessages,
        configView: configView,
        getCookie: getCookie,
        setCookie: setCookie,
        getChannel: getChannel,
        startChat: startChat,
        enterUser: enterUser,
        releaseAdminMessage: releaseAdminMessage,
        setOnTypingListener: setOnTypingListener,
        initContextType: initContextType,
        setContextMessage: setContextMessage,
        setOnMessageEditListener: setOnMessageEditListener,
        getEditMessageId: getEditMessageId
      };

      /***/ }),

    /***/ 1:
    /*!**************************************************************!*\
      !*** multi ./resources/js/frontend/afkar/messaging/index.js ***!
      \**************************************************************/
    /*! no libs exports found */
    /***/ (function(module, exports, __webpack_require__) {

      module.exports = __webpack_require__(/*! C:\xampp\htdocs\afkar\resources\js\frontend\afkar\messaging\index.js */"./resources/js/frontend/afkar/messaging/index.js");


      /***/ })

    /******/ });
