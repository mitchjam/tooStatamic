
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');


var fileInput = $('.file-input');
var droparea = $('.file-drop-area');

// highlight drag area
fileInput.on('dragenter', function() {
  droparea.addClass('is-active');
});

// back to normal state
fileInput.on('dragleave blur drop', function() {
  droparea.removeClass('is-active');
});

// change inner text
fileInput.on('change', function() {
  var filesCount = $(this)[0].files.length;
  var textContainer = $(this).prev('.js-set-number');

    if (filesCount) {
        if (filesCount === 1) {
            // if single file then show file name
            textContainer.text($(this).val().split('\\').pop());
        } else {
            // otherwise show number of files
            textContainer.text(filesCount + ' files selected.');
        }

        droparea.addClass('is-full');
    } else {
        droparea.removeClass('is-full');
    }
});

$('.inquire.button').click(event => {
  $('.modal').addClass('is-active');
});

$('.modal-close').click(event => {
  $('.modal').removeClass('is-active');
});
