const formRegister = () => {
    const data = {
        fname: fname.value,
        lname: lname.value,
        username: username.value,
        password: password.value,
        post_register: true
    };

    registerValidation(data);
    console.log('click');
}

const registerValidation = data => {
    !data.fname || !data.lname || !data.username || !data.password ?
    alert('Empty Fields!') : registerUser(data);
}

const registerUser = async data => {
    const response = await $.post(state.app + state.helper + 'UserHelper.php', data);
    console.log(response);
}

const formLogin = () => {
    const data = {
        login_username: login_username.value,
        login_password: login_password.value,
        post_login: true
    };

    loginValidation(data);
}

const loginValidation = data => {
    !data.login_username || !data.login_password ? alert('Empty Fields') : loginUser(data);
}

const loginUser = async data => {
    const response = await $.post(state.app + state.helper + 'UserHelper.php', data);
    let jsonRes = JSON.parse(response);
    jsonRes.Status === 200 ? 
    (alert('login'), window.location.href = 'http://localhost/usermanagement/admin_content/admin_dashboard.php') : alert('invalid');
}

// btn submit register
$('#btnRegister').on('click', formRegister);

// btn submit login
$('#btnSignin').on('click', formLogin);