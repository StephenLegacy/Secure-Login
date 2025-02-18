
    function getQueryParam(param) {
        const urlParams = new URLSearchParams(window.location.search);
        return urlParams.get(param);
    }

    document.addEventListener("DOMContentLoaded", function () {
        let successMessage = getQueryParam('success');
        let errorMessage = getQueryParam('error');
        let errorMsg = getQueryParam('message');

        if (successMessage === "registration_successful") {
            Swal.fire({ title: "🎉 Registration Successful!", text: "You can now log in.", icon: "success" });
        }

        if (errorMessage === "password_mismatch") {
            Swal.fire({ title: "❌ Passwords Do Not Match", text: "Please ensure the passwords match.", icon: "error" });
        }

        if (errorMessage === "username_taken") {
            Swal.fire({ title: "🚫 Username Already Exists", text: "Please choose a different username.", icon: "warning" });
        }

        if (errorMessage === "database_error") {
            Swal.fire({ title: "❗ Database Error", text: decodeURIComponent(errorMsg), icon: "error" });
        }
    });

