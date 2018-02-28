
var Form = {

    makeRequest: function (method, url, formData) {
        axios[method](url, formData)
            .then(function (response) {

                if(response.status == 200) {
                    // console.log(document.getElementById('url'));
                    Form.callbackhandler(response);
                }
            })
            .catch(function (error) {

                console.log(error)

            });
    },

    submit: function (e) {

        e.preventDefault();

        var form = this;
        var method = this.method;
        var url = this.getAttribute('action');
        var enctypeVal = this.enctype || null;

        for(var i=0; i<form.elements.length; i++){
            if(form.elements[i].classList.contains('error') || form.elements[i].classList.contains('empty')){
                var error = true;
                this.elements[i].className += " error-box";
                this.elements[i].nextElementSibling.style.display = "block";
            }else {
                this.elements[i].classList.remove('error-box');
            }
        }
        if(error !== true) {
            var formData = new FormData(form);

            Form.makeRequest(method, url, formData);
        }

    },


    validate: function () {

        if(this.id == "name"){
            Form.checkName(this);
        }
        if(this.id == "email"){
            Form.checkEmail(this);
        }
        if(this.id == "password"){
            Form.checkPassword(this);
        }
        if(this.id == "phone"){
            Form.checkPhone(this);
        }
        if(this.id == "message"){
            Form.checkMessage(this);
        }
        if(this.id == "image"){
            Form.checkImageUpload(this);
        }
        return true;

    },

    checkName: function(input){
        var span = input.nextElementSibling;
        if (input.classList.contains('ok')) { input.classList.remove('ok');}
        if (input.classList.contains('empty')) { input.classList.remove('empty');}
        if (input.classList.contains('error')) { input.classList.remove('error');}
        if(input.value == "" || input.value.length < 2 || input.value.length > 30) {
            span.style.display = "block";
            if (input.value == "") {
                span.innerHTML = "This field is required!";
                input.className += " empty";
            }
            else {
                span.innerHTML = "Your must Enter between 2 and 30 characters.";
                input.className += " error";
            }
            input.className += " error-box";
        }
        else{
            span.style.display = "none";
            input.className += " ok";
            input.classList.remove('error-box');
        }
    },
    // Email Validation
    checkEmail: function (input) {
        var span = input.nextElementSibling;
        if (input.classList.contains('ok')){ input.classList.remove("ok");}
        if (input.classList.contains('error')){ input.classList.remove("error");}
        if (input.classList.contains('empty')){ input.classList.remove("empty");}

        var email_pattern = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,7})+$/;
        if(!email_pattern.test(input.value)){
            span.style.display = "block";
            if(input.value == ""){
                span.innerHTML = "This field is required!";
                input.className += " empty";
            } else {
                span.innerHTML = "Invalid Email!";
                input.className += " error";
            }
            input.className += " error-box";
        }
        else{
            span.style.display = "none";
            input.className += " ok";
            input.classList.remove('error-box');
        }
    },
    // Password Validation
    checkPassword: function (input) {
        var span = input.parentNode.children[1];
        var pass_pattern = /^[a-z0-9_-]{5,20}$/;
        if(!pass_pattern.test(input.value)){
            span.innerHTML = "Please Enter Your Password 5-20 characters";
            span.style.display = "inline";
            span.style.color = "red";
            input.className += " error";
        }
        else{
            span.style.display = "none";
            span.innerHTML="";
            input.classList.remove("error");
        }
    },
    // // Passwords Confirmation
    // confirmPassword: function() {
    //     var span = this.parentNode.children[1];
    //     if (this.value != pass1.value) {
    //         span.innerHTML = "Passwords do not match!";
    //         span.style.display = "inline";
    //         span.style.color = "red";
    //         this.className += " error";
    //         pass1.className += " error";
    //     }
    //     else{
    //         span.style.display = "none";
    //         span.innerHTML="";
    //         this.classList.remove("error");
    //         pass1.classList.remove("error");
    //     }
    // },
    // Phone Validation
    checkPhone: function(input) {
        var span = input.nextElementSibling;
        if (input.classList.contains('ok')) { input.classList.remove('ok');}
        if (input.classList.contains('error')){ input.classList.remove("error");}
        if (input.classList.contains('empty')){ input.classList.remove("empty");}

        var phone_pattern = /[0-9-()+]{3,20}/;
        if (!phone_pattern.test(input.value)) {
            span.style.display = "block";
            if(input.value == ""){
                span.innerHTML = "This field is required!";
                input.className += " empty";
            }
            else {
                span.innerHTML = "Enter your correct phone number!";
                input.className += " error";
            }
            input.className += " error-box";
        }
        else{
            span.style.display = "none";
            input.className += " ok";
            input.classList.remove('error-box');
        }
    },
    checkMessage: function(input) {
        var span = input.nextElementSibling;
        if (input.classList.contains('ok')) { input.classList.remove('ok');}
        if (input.classList.contains('error')){ input.classList.remove("error");}
        if (input.classList.contains('empty')){ input.classList.remove("empty");}
        if(input.value == "" || input.value.length < 5 || input.value.length > 5000){
            span.style.display = "block";
            if(input.value == ""){
                span.innerHTML = "This field is required!";
                input.className += " empty";
            }
            else {
                span.innerHTML = "Your must Enter between 5 and 5000 characters.";
                input.className += " error";
            }
            input.className += " error-box";
        }
        else{
            span.style.display = "none";
            input.className += " ok";
            input.classList.remove('error-box');
        }
    },

    checkImageUpload: function (input) {
        var span = input.nextElementSibling;
        if (input.classList.contains('ok')) { input.classList.remove('ok');}
        if (input.classList.contains('error')){ input.classList.remove("error");}
        if (input.classList.contains('empty')){ input.classList.remove("empty");}

        var file = input.files[0] ? input.files[0].name : "";
        var size = input.files[0] ? input.files[0].size : 0;
        var re = /(\.jpg|\.jpeg|\.bmp|\.gif|\.png)$/i;
        if(!re.exec(file) || size > Math.pow(1024,2)) {
            span.style.display = "block";
            if(!re.exec(file)){
                span.innerHTML = "This is not an Image!";
                input.className += " error";
            }
            else {
                span.innerHTML = "File size exceeds 1MB.";
                input.className += " error";
            }
            input.className += " error-box";
        }
        else{
            span.style.display = "none";
            input.className += " ok";
            input.classList.remove('error-box');
        }
    },

    ForceNumericOnly: function(e) {
        var key = e.charCode || e.keyCode || 0;
        // allow backspace, tab, delete, enter, arrows, numbers and keypad numbers ONLY
        // home, end, period, and numpad decimal
        if(key == 8 || key == 9 || key == 13 || key == 46 || key == 110 || key == 190 || (key >= 35 && key <= 40) || (key >= 48 && key <= 57) || (key >= 96 && key <= 105)){
            return key;
        }else {
            e.returnValue = false;
        }
    },

    // Url Function
    gotourl: function(url){
        return window.location.protocol + "//" + window.location.host + url;
    },

    callbackhandler:function(response) {
        if (response.data == Number(true)) {
            var url = "/" + document.getElementById('url').value;
            console.log(Form.gotourl(url));
            window.location = Form.gotourl(url);
        }
        else {
            document.getElementById('response').innerHTML = response.data;
            document.getElementById('response').style.display = "block";
        }
    }

};


// Form.submit();