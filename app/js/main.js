'use strict';

document.addEventListener(`DOMContentLoaded`, () => {});

// JQUERY
$('.signup-form').submit(function (e) {
  e.preventDefault(); // avoid to execute the actual submit of the form.

  var form = $('.signup-form');

  $.ajax({
    type: 'POST',
    url: 'send-form.php',
    data: form.serialize(), // serializes the form's elements.
    success: function (data) {
      console.log(data); // show response from the php script.
    },
  });
});

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
