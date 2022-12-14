$(function(){
    $('#filter-button').click(function(){
        $('#sub-filter-dropdown').toggle('slow');
    });
});
$('.collapse-rotate').on('show.bs.collapse', function () {
  $(this).siblings('.card-header').addClass('collapsed');
});
$('.collapse-rotate').on('hide.bs.collapse', function () {
  $(this).siblings('.card-header').removeClass('collapsed');

});
function disableScroll() {
	document.body.classList.add("stop-scrolling");
}

function enableScroll() {
	document.body.classList.remove("stop-scrolling");
}

$(document).ready(function(){
  $('#nav-icon').click(function(){
    $(this).toggleClass('open');
    if ( $(this).hasClass('open'))
        disableScroll();
    else{
        enableScroll();
    }
});
  $('#overlay').click(function(){
      $('#nav-icon').toggleClass('open');
      enableScroll();
    })
});
const prevIcon = '<div class="min-arrow prev-arrow"></div>';
const nextIcon = '<div class="min-arrow next-arrow"></div>';
$('#oustanding-location-detail-carousel').owlCarousel({
    loop:true,
    margin:30,
    responsiveClass:true,
    nav:true,
    navText:[
        prevIcon,
        nextIcon
    ],
    dots:false, 
    responsive:{
        0:{
            items:2,
            nav:false
        },
        768:{
            items:3,
            nav:false
        },
        1024:{
            items:4,
            nav:true,
            loop:false
        }
    }
})
$('#attractive-tour-detail-carousel').owlCarousel({
    loop:true,
    margin:30,
    responsiveClass:true,
    nav: true,
    navText:[
        prevIcon,
        nextIcon
    ],
    dots:false, 
    responsive:{
        0:{
            items:1,
            nav:false, 
        },
        768:{
            items:2,
            nav:false
        },
        1024:{
            items:3,
            nav:true,
            loop:false
        }
    }
})
$('#traditional-tour-detail-carousel').owlCarousel({
    loop:false,
    margin:30,
    responsiveClass:true,
    navText:[
        prevIcon,
        nextIcon
    ],
    dots:false, 
    responsive:{
        0:{
            items:1,
            nav: false
        },
        768:{
            items:2,
            nav:false
        },
        1024:{
            items:3,
            nav:true,
        }
    }
})

  function Validator(options) {
    function getParent(element, selector) {
        while (element.parentElement) {
            if (element.parentElement.matches(selector)) {
                return element.parentElement;
            }
            element = element.parentElement;
        }
    }

    var selectorRules = {};

    // H??m th???c hi???n validate
    function validate(inputElement, rule) {
        var errorElement = getParent(inputElement, options.formGroupSelector).querySelector(options.errorSelector);
        var errorMessage;

        // L???y ra c??c rules c???a selector
        var rules = selectorRules[rule.selector];
        
        // L???p qua t???ng rule & ki???m tra
        // N???u c?? l???i th?? d???ng vi???c ki???m
        for (var i = 0; i < rules.length; ++i) {
            switch (inputElement.type) {
                case 'radio':
                case 'checkbox':
                    errorMessage = rules[i](
                        formElement.querySelector(rule.selector + ':checked')
                    );
                    break;
                default:
                    errorMessage = rules[i](inputElement.value);
            }
            if (errorMessage) break;
        }
        
        if (errorMessage) {
            errorElement.innerText = errorMessage;
            getParent(inputElement, options.formGroupSelector).classList.add('invalid');
        } else {
            errorElement.innerText = '';
            getParent(inputElement, options.formGroupSelector).classList.remove('invalid');
        }

        return !errorMessage;
    }

    // L???y element c???a form c???n validate
    var formElement = document.querySelector(options.form);
    if (formElement) {
        // Khi submit form
        formElement.onsubmit = function (e) {
            e.preventDefault();

            var isFormValid = true;

            // L???p qua t???ng rules v?? validate
            options.rules.forEach(function (rule) {
                var inputElement = formElement.querySelector(rule.selector);
                var isValid = validate(inputElement, rule);
                if (!isValid) {
                    isFormValid = false;
                }
            });

            if (isFormValid) {
                // Tr?????ng h???p submit v???i javascript
                if (typeof options.onSubmit === 'function') {
                    var enableInputs = formElement.querySelectorAll('[name]');
                    var formValues = Array.from(enableInputs).reduce(function (values, input) {
                        
                        switch(input.type) {
                            case 'radio':
                                values[input.name] = formElement.querySelector('input[name="' + input.name + '"]:checked').value;
                                break;
                            case 'checkbox':
                                if (!input.matches(':checked')) {
                                    values[input.name] = '';
                                    return values;
                                }
                                if (!Array.isArray(values[input.name])) {
                                    values[input.name] = [];
                                }
                                values[input.name].push(input.value);
                                break;
                            case 'file':
                                values[input.name] = input.files;
                                break;
                            default:
                                values[input.name] = input.value;
                        }

                        return values;
                    }, {});
                    options.onSubmit(formValues);
                }
                // Tr?????ng h???p submit v???i h??nh vi m???c ?????nh
                else {
                    formElement.submit();
                }
            }
        }

        // L???p qua m???i rule v?? x??? l?? (l???ng nghe s??? ki???n blur, input, ...)
        options.rules.forEach(function (rule) {

            // L??u l???i c??c rules cho m???i input
            if (Array.isArray(selectorRules[rule.selector])) {
                selectorRules[rule.selector].push(rule.test);
            } else {
                selectorRules[rule.selector] = [rule.test];
            }

            var inputElements = formElement.querySelectorAll(rule.selector);

            Array.from(inputElements).forEach(function (inputElement) {
               // X??? l?? tr?????ng h???p blur kh???i input
                inputElement.onblur = function () {
                    validate(inputElement, rule);
                }

                // X??? l?? m???i khi ng?????i d??ng nh???p v??o input
                inputElement.oninput = function () {
                    var errorElement = getParent(inputElement, options.formGroupSelector).querySelector(options.errorSelector);
                    errorElement.innerText = '';
                    getParent(inputElement, options.formGroupSelector).classList.remove('invalid');
                } 
            });
        });
    }

}



// ?????nh ngh??a rules
// Nguy??n t???c c???a c??c rules:
// 1. Khi c?? l???i => Tr??? ra message l???i
// 2. Khi h???p l??? => Kh??ng tr??? ra c??i g?? c??? (undefined)
Validator.isRequired = function (selector, message) {
    return {
        selector: selector,
        test: function (value) {
            return value ? undefined :  message || 'Please enter this field!'
        }
    };
}
Validator.isEmail = function (selector, message) {
    return {
        selector: selector,
        test: function (value) {
            var regex = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
            return regex.test(value) ? undefined :  message || 'Incorrect email format!';
        }
    };
}
Validator.isVietnameseNumber = function (selector, message) {
    return {
        selector: selector,
        test: function (value) {
            var regex = /^([0-9\s\-\+\(\)]*){10,11}$/
            return regex.test(value) ? undefined :  message || 'Incorrect phone number format!';
        }
    };
}
Validator.maxLength = function (selector, max, message) {
    return {
        selector: selector,
        test: function (value) {
            return value.length <= max ? undefined :  message || `Please enter max ${max} words`;
        }
    };
}
