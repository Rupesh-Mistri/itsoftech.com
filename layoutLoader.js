// layoutLoader.js
async function loadLayout() {
    const response = await fetch('baseLayout.html');
    const layoutHTML = await response.text();

    // Create a temporary container
    const tempDiv = document.createElement('div');
    tempDiv.innerHTML = layoutHTML;

    // Load Navbar
    const navbar = tempDiv.querySelector('#navbar');
    if (navbar) {
        document.body.insertBefore(navbar, document.body.firstChild);
    }

    // Load Footer
    const footer = tempDiv.querySelector('#footer');
    if (footer) {
        document.body.appendChild(footer);
    }
}

document.addEventListener("DOMContentLoaded", loadLayout);
