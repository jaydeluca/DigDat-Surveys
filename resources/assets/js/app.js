/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

Vue.component('survey', require('./components/TakeSurvey.vue'));
Vue.component('create-survey', require('./components/CreateSurvey.vue'));
Vue.component('percentage', require('./components/PercentageCalculator.vue'));

const app = new Vue({
  el: '#app'
});

// Function for the navigation dropdown
function closeDropdownsIfAnyClick(ev) {
  'use strict';

  let tgt = ev.target || ev.srcElement;

  // close all (but allow open just clicked)
  document.querySelectorAll('.has-dropdown input[type="checkbox"]').forEach(
    function (chb) {
      if (chb.id !== tgt.id && chb.id !== tgt.getAttribute('for')) {
        chb.checked = false
      }
    }
  );

  return true;
}

// close dropdowns if clicked anywhere
document.querySelector('body').addEventListener('click', closeDropdownsIfAnyClick);