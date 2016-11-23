<script src="http://cheappartsguy.com:8091/js/jquery-3.0.0.min.js"></script>
<script src="http://cheappartsguy.com:8091/js/cookie/jquery.cookie.js" type="text/javascript"></script>

<script>
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
                url: 'http://localhost:5304/login_process/'+ username +'/' + password,
                dataType: 'text',
                success: function(username){
                    var json = $.parseJSON(username);
                    $(json).each(function(m, mem){
                        if(mem.login_status == 200) {
                            //document.cookie = "Id="+ mem.Id + ";" + expires;
                            $.cookie("Id",mem.Id,{expires: 365});
                            $.cookie("Role",mem.role,{expires: 365});

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
</script>


<center>
Sign In
<br /><br />
<input type="text" name="username" id="username" placeholder="Username" tabindex="1">
<div id="chk_username"></div>
<br />
<input type="password" name="password" id="password" placeholder="Password" tabindex="2">
<div id="chk_password"></div>
<br />
<input type="hidden" name="_token" id="csrf-token" value="QbEze2UnMybWW3OXNH8uDkPYR931ck86HfiBIL4H" /><br />
<input type="submit" name="login" value="Log In" id="login_button" tabindex="3" >
<div id="chk_login"></div>

</center>