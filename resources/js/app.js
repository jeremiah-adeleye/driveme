require('./bootstrap');
let togglePasswordBtn = $('#toggle-password');
togglePasswordBtn.on('click', function () {
    let passwordInput = $(togglePasswordBtn.attr('data-target'));
    if (passwordInput.attr('type') === 'password') {
        passwordInput.attr('type', 'text')
    }else passwordInput.attr('type', 'password')
});

$(document).ready(function () {
    let alert = $('.alert');
    alert.on('ready', closeAlert(alert))
});

function closeAlert(alert) {
    setTimeout(function () {
        alert.alert('close');
    }, 5000);
}

$('.dv-custom-select .dropdown-item').on('click', function () {
    let option = $(this);
    let dropdown = $(option.parents('.dv-custom-select'));
    let dropdownToggle = $(dropdown.find('.dropdown-toggle'));
    let selectInput = $(dropdown.find('.input-value'));

    dropdownToggle.html(`${option.text()} <i class="fas fa-caret-down caret"></i>`);
    selectInput.val(option.attr('data-value'));
    console.log(selectInput)
});
