// lmsPasswordUpdate.js

document.addEventListener("DOMContentLoaded", () => {
    const updateLmsPassword =
        document.body.dataset.updateLmsPassword === "true";
    const username = document.body.dataset.lmsUsername;
    const password = document.body.dataset.lmsPassword;

    if (updateLmsPassword && username && password) {
        // Make the POST request to LMS API
        fetch(
            "https://lms.poltekbatu.ac.id/user/interpreterUpdatePasswordDARe5.php",
            {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                },
                body: JSON.stringify({
                    username: username,
                    password: password,
                }),
            }
        )
            .then((response) => {
                if (!response.ok)
                    throw new Error("Failed to update LMS password.");
                console.log("LMS password updated successfully.");
                // Clear the session flag after success
                fetch("/clear-lms-password-session");
            })
            .catch((error) => console.error("Error:", error));
    }
});
