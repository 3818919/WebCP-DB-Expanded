// Helper function to set a cookie
function setCookie(name, value) {
    document.cookie = `${name}=${value}; path=/; expires=Fri, 31 Dec 9999 23:59:59 GMT`;
}

// Helper function to get a cookie
function getCookie(name) {
    const cookies = document.cookie.split("; ");
    for (let i = 0; i < cookies.length; i++) {
        const [key, val] = cookies[i].split("=");
        if (key === name) {
            return val;
        }
    }
    return null;
}

// Function to apply the appropriate CSS file based on the mode
function applyMode(mode) {
    const link = document.getElementById("dynamic-stylesheet");
    if (mode === "dark") {
        link.href = "./tpl/eo/style_02.css";
    } else {
        link.href = "./tpl/eo/style_01.css";
    }
}

// Main logic
document.addEventListener("DOMContentLoaded", function () {
    // Check for an existing cookie
    let mode = getCookie("theme");

    // If no cookie is present, default to light mode and set the cookie
    if (!mode) {
        mode = "light";
        setCookie("theme", mode);
    }

    // Apply the appropriate mode
    applyMode(mode);

    // Update the toggle switch state based on the cookie
    const toggleSwitch = document.getElementById("mode-toggle");
    if (mode === "dark") {
        toggleSwitch.checked = true; // Set the toggle switch to "on"
    }

    // Add event listener to the toggle switch
    toggleSwitch.addEventListener("change", function () {
        // Toggle the mode
        mode = toggleSwitch.checked ? "dark" : "light";

        // Update the cookie and apply the new mode
        setCookie("theme", mode);
        applyMode(mode);
    });
});