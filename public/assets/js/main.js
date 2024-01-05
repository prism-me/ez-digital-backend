window.setTimeout(
    "document.  ngetElementById('#formResult').style.display='none';",
    2000
);

function formSubmit() {
    $.ajax({
        type: "POST",
        url: "/register",
        data: $("#userForm").serialize(),
        success: function (response) {
            $("#formResult").html(response.message);
            $("#hiddenPaymentDiv").removeClass("hiddenPaymentDiv");
        },
        error: function (error) {
            console.log(error);
        },
    });
}
