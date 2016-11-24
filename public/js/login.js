$(document).ready(function(){

    $('#login_button').on('click', function(e){
        var username = document.getElementById('username').value;
        var password = document.getElementById('password').value;

        if (username == null || username == "") {
            document.getElementById("chk_username").innerHTML = "Required Email";
            return false;
        }

        if (password == null || password == "") {
            document.getElementById("chk_password").innerHTML = "Required Password";
            return false;
        }

        $.ajax({
            url: '/login_process/' + username + '/' + password,
            dataType: 'text',
            success: function(username){

                var json = $.parseJSON(username);
                $(json).each(function(m, mem){
                    if(mem.login_status == 200) {
                        //document.cookie = "Id="+ mem.Id + ";" + expires;
                        $.cookie("Id",mem.Id,{expires: 365});
                        $.cookie("role",mem.role,{expires: 365});

                        window.location = '/dashboard'
                    }
                    else if(mem.LoginStatus == 404){
                        document.getElementById("chk_login").innerHTML = "Username doesn't exist!";
                    }
                    else if(mem.LoginStatus == 403){
                        document.getElementById("chk_login").innerHTML = "Password doesn't match!";
                    }
                });
            },
            error: function(username){
                alert("error!");
            }
        });
        e.preventDefault();
    });

});