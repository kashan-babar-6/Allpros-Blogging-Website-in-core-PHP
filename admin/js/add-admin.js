function validate() {
    // Value Variables
    let fName= document.getElementById('f-name').value;
    let username= document.getElementById('username').value;
    let email= document.getElementById('email').value;
    let dob= document.getElementById('dob').value;
    let gender= document.querySelector('input[name="gender"]:checked');
    let password= document.getElementById('password').value;
    let cPassword= document.getElementById('c-password').value;
    let imgFile= document.getElementById('img-file').value;

    // Error Variables
    let nameError= document.getElementById('name-error').innerHTML;
    let usernameError= document.getElementById('username-error').innerHTML;
    let emailError= document.getElementById('email-error').innerHTML;
    let dobError= document.getElementById('dob-error').innerHTML;
    let genderError= document.getElementById('gender-error').innerHTML;
    let passError= document.getElementById('pass-error').innerHTML;
    let cpassError= document.getElementById('cpass-error').innerHTML;
    let profileError= document.getElementById('profile-error').innerHTML;

    if(fName === "") {
        nameError= "*Error: Please Fill this Field";
    }
    if(username === "") {
        usernameError= "*Error: Please Fill this Field";
    }
    if(email === "") {
        emailError= "*Error: Please Fill this Field";
    }
    if(dob === "") {
        dobError= "*Error: Please Fill this Field";
    }
    if(gender != null) {
        gender= gender.value;
    }
    else {
        genderError= "*Error: Please Fill this Field";
    }
    if(password === "") {
        passError= "*Error: Please Fill this Field";
    }
    if(cPassword === "") {
        cpassError= "*Error: Please Fill this Field";
    }
    if(password != cPassword) {
        cpassError= "*Error: *Error: Passwords do not match";
    }
    if(imgFile === "") {
        profileError= "*Error: Please Fill this Field";
    }
    else if(imgFile != null) {
        imgFile.split('.');
        if(imgFile[1] != "png" && imgFile[1] != "jpg" && imgFile[1] != "jpeg") {
            profileError= "*Error: Image file is not valid";
        }
    }

    if(nameError === "" && usernameError === "" && emailError === "" && dobError === "" && genderError === "" && passError === "" && cpassError === "" && profileError === "") {
        addBtnPhp= document.getElementById('add-btn-php');
        addBtnPhp.click();
    }
}