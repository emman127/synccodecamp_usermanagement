//get single user 
const modify = async id => {
    console.log(state.update);
    state.update = true;
    const data = {
        id,
        get_id: true
    }

    const response = await $.post(state.app + state.helper + 'AdminHelper.php', data);
    let jsonDestroy = JSON.parse(response);

    fname.value = jsonDestroy.firstname;
    lname.value = jsonDestroy.lastname;
    uname.value = jsonDestroy.username;
    password.value = jsonDestroy.password;

    // remove input type [password]
    cpass.remove();
    password.remove();
    
    // change button text
    btnSubmit.innerHTML = 'Update';
    headText.innerHTML = 'Update Info';

    // display back button
    document.getElementById('btnBack').style.display = 'inline';

    state.id = data.id;
}

// update user
const update_activate = async id => {
    const data = {
        id,
        activate_user: true
    }
    const response = await $.post(state.app + state.helper + 'AdminHelper.php', data);
    let jsonDestroy = JSON.parse(response);
    jsonDestroy.Status === 200 ? 
    (alert("User's Successfully Activate"), setTimeout(() => window.location.href = 'http://localhost/usermanagement/admin_content/admin_adduser.php')) : 
    alert("ERROR!!!");
}

const update_deactivate = async id => {
    const data = {
        id,
        deactivate_user: true
    }
    const response = await $.post(state.app + state.helper + 'AdminHelper.php', data);
    let jsonDestroy = JSON.parse(response);
    jsonDestroy.Status === 200 ?
    (alert("User's Successfully Deactivated!"), setTimeout(() => window.location.href= 'http://localhost/usermanagement/admin_content/admin_adduser.php')) :
    alert("ERROR!!");
}

const update_user_info = async id => {
    const data = {
        id: state.id,
        fname: fname.value,
        lname: lname.value,
        uname: uname.value,
        update_user: true
    }
    const response = await $.post(state.app + state.helper + 'AdminHelper.php', data);
    let jsonDestroy = JSON.parse(response);
    jsonDestroy.Status === 200 ? (alert("Successfully Update!"), setTimeout(() => window.location.href= 'http://localhost/usermanagement/admin_content/admin_adduser.php')) :
    alert("ERROR");
}

const validateForm = (data) => {
    if(!data.fname || !data.lname || !data.uname) {
        alert('Empty Fields!');
    }
    else {
        if(state.update) {
            update_user_info(data);
        }
    }
}

$('#btnSubmit').on('click', () => {
    data = {
        fname: fname.value,
        lname: lname.value,
        uname: uname.value
    }

    validateForm(data);
});

document.getElementById('btnBack').style.display = 'none';