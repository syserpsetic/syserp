(function () {
    "use strict";

    async function login() {
        // Reset state
        $("#login-form").find(".login__input").removeClass("border-danger");
        $("#login-form").find(".login__input-error").html("");

        // Post form
        let email = $("#email").val();
        let password = $("#password").val();

        // Loading state
        $("#btn-login").html(
            '<i data-loading-icon="oval" data-color="white" class="w-5 h-5 mx-auto"></i>'
        );
        tailwind.svgLoader();
        await helper.delay(1500);

        axios
            .post(`login`, {
                email: email,
                password: password,
            })
            .then((res) => {
                location.href = "/";
            })
            .catch((err) => {
                console.log(err.response.data.message)
                $("#btn-login").html("Ingresar");
                if (err.response.data.message != "Usuario o contraseña invalidos.") {
                    for (const [key, val] of Object.entries(
                        err.response.data.errors
                    )) {
                        $(`#${key}`).addClass("border-danger");
                        $(`#error-${key}`).html(val);
                    }
                } else {
                    $(`#password`).addClass("border-danger");
                    $(`#error-password`).html(err.response.data.message);
                }
            });
    }

    $("#login-form").on("keyup", function (e) {
        if (e.keyCode === 13) {
            login();
        }
    });

    $("#btn-login").on("click", function () {
        login();
    });
})();
