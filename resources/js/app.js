require('./bootstrap');
let togglePasswordBtn = $('#toggle-password');
togglePasswordBtn.on('click', function () {
    let passwordInput = $(togglePasswordBtn.attr('data-target'));
    if (passwordInput.attr('type') === 'password') {
        passwordInput.attr('type', 'text')
    }else passwordInput.attr('type', 'password')
});
