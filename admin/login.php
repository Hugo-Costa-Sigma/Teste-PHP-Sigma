<?php
session_start();
require_once('url.php');
?>
<!doctype html>
<html lang="en">

<head>
    <title>Backoffice Login</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        crossorigin="anonymous" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"
        integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-toast-plugin/1.3.2/jquery.toast.css"
        integrity="sha512-8D+M+7Y6jVsEa7RD6Kv/Z7EImSpNpQllgaEIQAtqHcI0H6F4iZknRj0Nx1DCdB+TwBaS+702BGWYC0Ze2hpExQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style>
        .Logo {
            background: url("https://i.ibb.co/vks4N2F/Sigma.png") no-repeat center/cover;
        }

        .bg {
            background: linear-gradient(to bottom, #59AC77, #3A61A8, #5F4798);
        }

        #show-password {
            cursor: pointer;
        }

        .olho {
            background: #fff;
            justify-content: center;
            height: 50px;
            width: 50px
        }
    </style>
</head>

<body>
    <header></header>
    <main>
        <section class="bg vh-100">
            <div class="container py-5 h-100">
                <div class="row d-flex justify-content-center align-items-center h-100">
                    <div class="col col-xl-10">
                        <div class="card" style="border-radius: 2rem;">
                            <div class="row g-0">
                                <div class="Logo col-md-6 col-lg-5 d-none d-md-block" style="border-radius: 2rem;">
                                </div>
                                <div class="col-md-6 col-lg-7 d-flex align-items-center">
                                    <div class="card-body p-4 p-lg-5 text-black">
                                        <form id="login-form">
                                            <div class="d-flex align-items-center mb-3 pb-1">
                                                <span class="h1 fw-bold mb-0">Sigmacode</span>
                                            </div>
                                            <h5 class="fw-normal mb-3 pb-3" style="letter-spacing: 1px;">Login into
                                                Backoffice</h5>
                                            <div class="form-outline mb-4">
                                                <input type="text" id="username"
                                                    class="user_inserido form-control form-control-lg"
                                                    placeholder="Username" />
                                                <label class="form-label" for="form2Example17"></label>
                                            </div>
                                            <div class="form-outline mb-4">
                                                <div class="input-group">
                                                    <input type="password" id="password"
                                                        class="pass_inserida form-control form-control-lg"
                                                        placeholder="Password" />
                                                    <div class="input-group-append">
                                                        <span class="olho input-group-text">
                                                            <i class="fa-regular fa-eye" id="show-password"
                                                                onclick="mostrarPass()"></i>
                                                        </span>
                                                    </div>
                                                </div>
                                                <label class="form-label" for="form2Example27"></label>
                                            </div>
                                            <div style="display:inline-flex;"class="pt-1 mb-4">
                                                <button style="margin-right: 40px;" class="login-btn btn btn-dark btn-lg btn-block" id="login-btn"
                                                    type="submit">Login</button>
                                                <a class="btn btn btn-dark btn-lg btn-block" id="btns"
                                                    type="submit" href="../" >Back</a>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
    <footer></footer>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"
        crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-toast-plugin/1.3.2/jquery.toast.min.js"
        integrity="sha512-zlWWyZq71UMApAjih4WkaRpikgY9Bz1oXIW5G0fED4vk14JjGlQ1UmkGM392jEULP8jbNMiwLWdM8Z87Hu88Fw=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script>
        function mostrarPass() {
            var pass = document.getElementById("password");
            var icone = document.getElementById("show-password");

            if (pass.type === "password") {
                pass.type = "text";
                icone.classList.remove("fa-eye");
                icone.classList.add("fa-eye-slash");
            } else {
                pass.type = "password";
                icone.classList.remove("fa-eye-slash");
                icone.classList.add("fa-eye");
            }
        }

        $(document).ready(function () {
            $('#login-btn').on('click', function (event) {
                event.preventDefault();

                var username = $('#username').val();
                var password = $('#password').val();

                $.ajax({
                    url: 'class/verifyer.php',
                    type: 'POST',
                    dataType: 'json',
                    data: { username: username, password: password },
                    success: function (data) {
                        console.log(data);
                        if (data.success) {
                            $.toast({
                                heading: 'Success',
                                text: 'Sucesso:' + data.sucess,
                                showHideTransition: 'slide',
                                icon: 'success'
                            })
                            window.location.href = "<?php echo URL::getBase(); ?>Listagem_Menus";
                        } else {

                            $.toast({
                                heading: 'Erro',
                                text: 'Erro:' + data.message,
                                showHideTransition: 'fade',
                                icon: 'error'
                            });
                        }
                    },
                    error: function (xhr, status, error) {
                        var jsonData = {};
                        try {
                            jsonData = JSON.parse(xhr.responseText);
                        } catch (e) {
                            jsonData.message = 'An unexpected error occurred';
                        }
                        console.log(error);
                        //alert(jsonData.message + ' erro');
                        $.toast({
                            heading: 'Erro',
                            text: 'Erro: ' + jsonData.message,
                            showHideTransition: 'fade',
                            icon: 'error'
                        });
                    }
                });
            });
        });
    </script>
</body>

</html>