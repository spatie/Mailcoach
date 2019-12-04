(window["webpackJsonp"] = window["webpackJsonp"] || []).push([[50],{

/***/ "./resources/js/views/layouts/components/Flash.tsx":
/*!*********************************************************!*\
  !*** ./resources/js/views/layouts/components/Flash.tsx ***!
  \*********************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
eval("__webpack_require__.r(__webpack_exports__);\n/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, \"default\", function() { return Flash; });\n/* harmony import */ var react__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! react */ \"./node_modules/react/index.js\");\n/* harmony import */ var react__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(react__WEBPACK_IMPORTED_MODULE_0__);\n/* harmony import */ var _inertiajs_inertia_react__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! @inertiajs/inertia-react */ \"./node_modules/@inertiajs/inertia-react/dist/index.js\");\n/* harmony import */ var _inertiajs_inertia_react__WEBPACK_IMPORTED_MODULE_1___default = /*#__PURE__*/__webpack_require__.n(_inertiajs_inertia_react__WEBPACK_IMPORTED_MODULE_1__);\n\n\nfunction Flash() {\n  var _usePage = Object(_inertiajs_inertia_react__WEBPACK_IMPORTED_MODULE_1__[\"usePage\"])(),\n      flash = _usePage.flash;\n\n  return flash && react__WEBPACK_IMPORTED_MODULE_0___default.a.createElement(\"div\", {\n    className: flash.type === 'success' ? 'bg-green-200' : 'bg-red-200'\n  }, flash.message);\n}\n\n//# sourceURL=webpack:///./resources/js/views/layouts/components/Flash.tsx?");

/***/ })

}]);