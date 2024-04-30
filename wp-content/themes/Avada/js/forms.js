// **************************************************************************************
// Fichier contenant le code jQuery utiles pour la validation des formulaires
//***************************************************************************************
/*    ASTUCE - Pour que les caractères spéciaux s'affichent correctement dans les 'alert' 
      il faut utiliser leur équivalent en octal précédé de \ (anti-slash) - Par exemple :
	  é : \351, è : \350, ê : \352, à : \340
	  La table complète des octal est disponible ici : http://www.pjb.com.au/comp/diacritics.html
*/


jQuery.validator.addMethod("notnull", function (value, element) {
    // allow any non-whitespace characters as the host part

    if (value != "" && value != "0") return true;
    else return false;

}, 'Veuillez sélectionner un élève dans la liste.');


jQuery.validator.addMethod("vLog", function (value, element) {
    // allow any non-whitespace characters as the host part
    return this.optional(element) || /^[a-zA-Z0-9][\w\-\_\.]+[a-zA-Z0-9]$/.test(value);
}, 'Le login doit contenir uniquement des lettres, des nombres, des points, des tirets ou des underscore.');

$.validator.addMethod("vMail", function (value, element) {
    // allow any non-whitespace characters as the host part
    return this.optional(element) || /^[\w\-]+(\.[\w\-]+)*@[\w\-]+(\.[\w\-]+)*\.[\w\-]{2,}$/.test(value);
}, 'Le format de l\'adresse mail est invalide.');

$.validator.addMethod("vPwd", function (value, element) {
    // allow any non-whitespace characters as the host part
    return this.optional(element) || /(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{6,}/.test(value);
}, 'Le mot de passe doit contenir au moins 1 majuscule, 1 mnuscule et 1 nombre.');

$.validator.addMethod("vRne", function (value, element) {
    // allow any non-whitespace characters as the host part
    return this.optional(element) || /^984[0-9]{4}[A-Z]{1}$/.test(value);
}, 'Le format du code RNE est invalide.');


//Ervine-condition-verifmail-peda//
$.validator.addMethod("vMailpeda", function (value, element) {
    //pour vérifier si l'email se termine par "@ac-polynesie.pf"
    return this.optional(element) || /@ac-polynesie\.pf$/.test(value);
}, "L'adresse e-mail doit se terminer par @ac-polynesie.pf.");


$.validator.addMethod("numtahiti", function (value, element) {
    // allow any non-whitespace characters as the host part
    return this.optional(element) || /^[a-zA-Z0-9]{6}-[0-9]{3}$/.test(value);
}, 'Le format du numero tahiti est invalide.');

$.validator.setDefaults({
    submitHandler: function (form) {
        // Prevent double submit
        if ($(form).data('submitted') === true) {
            // Previously submitted - don't submit again
            return false;
        } else {
            // Mark form as 'submitted' so that the next submit can be ignored
            $(form).data('submitted', true);
            return true;
        }
    }
});

$.validator.setDefaults({
    /*errorElement: 'span',
    errorPlacement: function (error, element) {
        if(element.parent('.input-group').length) 
            element.parent('.input-group').addClass("has-danger").append(error).addClass("text-danger");
        else
            element.closest('.form-group').addClass("has-danger").append(error).addClass("text-danger");
    },*/
    errorPlacement: function (error, element) {

        if (element.parent().hasClass('input-group')) {
            error.insertAfter(element.parent());
        } else {
            error.insertAfter(element);
        }

    },
    highlight: function (element, errorClass, validClass) {
        $(element).addClass('border border-danger');
        $(element).addClass('has-danger');
    },
    unhighlight: function (element, errorClass, validClass) {
        $(element).removeClass('border border-danger');
        $(element).removeClass('has-danger');
    }
});

$.validator.setDefaults({ignore: ':hidden:not(.selectpicker)'});

$(document).ready(function () {
    /* -------------------------------------------------------------------------
                                    CONNEXION, MOT DE PASSE ET PROFIL
    ---------------------------------------------------------------------------*/


    /* -------------------------------------------------------------------------*/
    //                                    UTILISATEURS


    $('#login-form').validate({
        rules: {
            useremail: {required: true, vMail: true},
            userpassword: {required: true}

        },
        submitHandler: function (form) {
            formhash(form, 0)
        }
    });
//Ervine_log_formpeda
    $('#login-form-peda').validate({
        rules: {
            //ligne pour vérifier si mail_peda > ac-polynesie.pf
            // useremail: { required: true, vMail: true, vMailpeda: true},

            useremail: {required: true, vMail: true},
            userpassword: {required: true}

        },
        submitHandler: function (form) {
            formhash(form, 0)
        }
    });

    $('#passwordforget-form').validate({
        rules: {
            useremailrecup: {required: true, vMail: true}

        },
        submitHandler: function (form) {
            formhash(form, 0)
        }
    });


    $('#createaccountelv-form').validate({
        rules: {
            usercommune: {required: true},
            useremailcrea: {required: true, vMail: true},
            usernom: {required: true},
            userprenom: {required: true},
            userdatenais: {required: true},
            usersexe: {required: true},
            useretab: {required: true},
            userclass: {required: true},
            checkcond: {required: true},
            //ligne concernant le mdp_elv
            password1: {required: true, minlength: 6, vPwd: true},
            password2: {required: true, equalTo: "#password1"}
        },
        submitHandler: function (form) {
            formhash(form, 0)
        }
    });

    $('#createaccountent-form').validate({
        rules: {
            usercommune: {required: true},
            useremailcrea: {required: true, vMail: true},
            usertahiti: {required: true, numtahiti: true},
            checkcond: {required: true},

            password1: {required: true, minlength: 6, vPwd: true},
            password2: {required: true, equalTo: "#password1"}
        },

        submitHandler: function (form) {
            formhash(form, 0)
        }
    });


    $('#changtahiti-form').validate({
        rules: {
            usernewtahiti: {required: true, numtahiti: true}

        },
        submitHandler: function (form) {
            formhash(form, 0)
        }
    });

//Ervine_creat_formpeda
    $('#createaccountpeda-form').validate({
        rules: {
            //ligne pour vérifier si mail_peda > ac-polynesie.pf
            // useremailcrea: { required: true, vMail: true, vMailpeda: true},

            useremailcrea: { required: true, vMail: true},

            usernom: {required: true},
            userprenom: {required: true},
            checkcond: {required: true},
            password1: {required: true, minlength: 6, vPwd: true},
            password2: {required: true, equalTo: "#password1"}
        },

        submitHandler: function (form) {
            formhash(form, 0)
        }
    });

    $('#changepassword-form').validate({
        rules: {
            expassword: {required: true},
            password1: {required: true, minlength: 6, vPwd: true},
            password2: {required: true, equalTo: "#password1"}
        },
        submitHandler: function (form) {
            formhash(form, 0)
        }
    });

    $('#forgetpassword-form').validate({
        rules: {

            password1: {required: true, minlength: 6, vPwd: true},
            password2: {required: true, equalTo: "#password1"}
        },
        submitHandler: function (form) {
            formhash(form, 0)
        }
    });


    $('#messageactive-form').validate({
        rules: {
            useremailresend: {required: true, vMail: true}

        },
        submitHandler: function (form) {
            formhash(form, 0)
        }
    });


    $('#inscrire-form').validate({
        rules: {
            useremailins: {required: true, vMail: true},
            usernomins: {required: true},
            userprenomins: {required: true},
            userdatenaisins: {required: true}


        },
        submitHandler: function (form) {
            formhash(form, 0)
        }
    });

    $('#changemail-form').validate({
        rules: {
            useremailnew: {required: true, vMail: true}

        },
        submitHandler: function (form) {
            formhash(form, 0)
        }
    });


    /* --------- MISE A JOUR UTILISATEUR ------------*/
    $('#frmMusr').validate({
        rules: {
            chplog: {required: true, minlength: 3, vLog: true},
            chpname: {required: true},
            chpmail: {required: true, vMail: true}
        }
    });


    $('#frmPwdIni').validate({
        rules: {

            chppwd: {required: true, minlength: 6, vPwd: true},
            chpcfpwd: {required: true, equalTo: "#chppwd"}
        },
        submitHandler: function (form) {
            formhash(form, 0)
        }
    });


    $('#addstage2-form').validate({
        rules: {

            chpdddebut: {required: true},
            chpddfin: {required: true}
        },
        submitHandler: function (form) {
            formhash(form, 0)
        }
    });


});
