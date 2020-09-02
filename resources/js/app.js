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
