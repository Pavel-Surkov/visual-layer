
'use strict';

document.addEventListener(`DOMContentLoaded`, () => {});

// JQUERY

// Form popup
const signupForm = document.querySelector('#signup-form');
const closeBtn = document.querySelector('#signup-close');
const signupModal = document.querySelector('#signup-modal');
const blocker = document.querySelector('#blocker');
const greatBtn = document.querySelector('#signup-modal .btn-black');

signupForm.addEventListener('submit', (e) => {
  e.preventDefault();

  signupModal.classList.add('signup-popup_opened');
  blocker.classList.add('blocker_opened');
});

greatBtn.addEventListener('click', () => {
  signupModal.classList.remove('signup-popup_opened');
  blocker.classList.remove('blocker_opened');
});

closeBtn.addEventListener('click', () => {
  signupModal.classList.remove('signup-popup_opened');
  blocker.classList.remove('blocker_opened');
});
