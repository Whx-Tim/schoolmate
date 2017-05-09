(function e(t,n,r){function s(o,u){if(!n[o]){if(!t[o]){var a=typeof require=="function"&&require;if(!u&&a)return a(o,!0);if(i)return i(o,!0);var f=new Error("Cannot find module '"+o+"'");throw f.code="MODULE_NOT_FOUND",f}var l=n[o]={exports:{}};t[o][0].call(l.exports,function(e){var n=t[o][1][e];return s(n?n:e)},l,l.exports,e,t,n,r)}return n[o].exports}var i=typeof require=="function"&&require;for(var o=0;o<r.length;o++)s(r[o]);return s})({1:[function(require,module,exports){
'use strict';

(function () {
    if (!String.prototype.trim) {
        (function () {
            // Make sure we trim BOM and NBSP
            var rtrim = /^[\s\uFEFF\xA0]+|[\s\uFEFF\xA0]+$/g;
            String.prototype.trim = function () {
                return this.replace(rtrim, '');
            };
        })();
    }

    $(function () {
        setTimeout(function () {
            [].slice.call(document.querySelectorAll('.Input__field')).forEach(function (InputEl) {
                // In case the Input is already filled..
                if (InputEl.value.trim() !== '') {
                    classie.add(InputEl.parentNode, 'Input--filled');
                }

                // Events:
                InputEl.addEventListener('focus', onInputFocus);
                InputEl.addEventListener('blur', onInputBlur);
            });
        }, 300);
    });

    function onInputFocus(ev) {
        classie.add(ev.target.parentNode, 'Input--filled');
    }

    function onInputBlur(ev) {
        if (ev.target.value.trim() === '') {
            classie.remove(ev.target.parentNode, 'Input--filled');
        }
    }

    $(".Input__eye").on('click', function (ev) {
        var b = ev.target;

        classie.toggle(b, 'visible');
        changePasswordVisibility();
    });

    function changePasswordVisibility() {
        var field = document.querySelector("input#password");

        field.type = field.type == 'password' ? 'text' : 'password';
    }

    var isSubmitting = false;

    $(".Auth__form").on('submit', function (ev) {
        ev.preventDefault();

        if (isSubmitting) return false;

        isSubmitting = true;

        var button = ev.target.querySelector(".Auth__submit");

        classie.add(button, 'loading');

        $.post({
            url: ev.target.action == undefined ? '' : ev.target.action,
            data: $(ev.target).serialize(),
            success: function success(data) {
                if (data.status != 'error') {
                    classie.add(button, 'success');

                    if (data.redirect != undefined && data.message == undefined) {
                        setTimeout(function () {
                            return window.location.href = data.redirect;
                        }, 700);
                    } else if (data.redirect != undefined && data.message != undefined) {
                        swal({
                            type: 'success',
                            showConfirmButton: false,
                            timer: 1500,
                            title: data.message
                        });
                        setTimeout(function () {
                            return window.location.href = data.redirect;
                        }, 1350);
                    } else {
                        swal({
                            type: 'success',
                            showConfirmButton: false,
                            timer: 1500,
                            title: data.message
                        });
                    }
                } else {
                    classie.add(button, 'error');
                    swal({
                        type: 'error',
                        showConfirmButton: false,
                        timer: 1000,
                        title: data.messages == undefined ? data.message : data.messages.name == undefined ? data.messages.email == undefined ? data.messages.password : data.messages.email : data.messages.name
                    });
                    setTimeout(function () {
                        return classie.remove(button, 'error');
                    }, 2500);
                }
            },
            error: function error(er) {
                classie.add(button, 'error');
                setTimeout(function () {
                    return classie.remove(button, 'error');
                }, 2500);
            },
            complete: function complete() {
                classie.remove(button, 'loading');
                isSubmitting = false;
            }
        });
    });
})();

},{}]},{},[1]);
