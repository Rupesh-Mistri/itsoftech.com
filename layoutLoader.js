// layoutLoader.js
async function loadLayout() {
    const response = await fetch('baseLayout.html');
    const layoutHTML = await response.text();

    // Create a temporary container
    const tempDiv = document.createElement('div');
    tempDiv.innerHTML = layoutHTML;

    // Load Navbar
    // const navbar = tempDiv.querySelector('#navbar');
    // if (navbar) {
    //     document.body.insertBefore(navbar, document.body.firstChild);
    // }

    const navbar = `  <nav class="navbar navbar-expand-lg bg-white shadow-sm sticky-top" style="background-color: #75767b;">
    <div class="container">
      <a class="navbar-brand fw-bold" href="#">
        <img src="logo2.png" alt="Techex Logo" width="80" height="80" />
        IT Softech
      </a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
        <ul class="navbar-nav me-3">
          <li class="nav-item"><a class="nav-link fw-semibold" href="#">Home</a></li>
          <li class="nav-item"><a class="nav-link fw-semibold" href="#">About Us</a></li>
          <li class="nav-item"><a class="nav-link fw-semibold" href="#">Services</a></li>
          <li class="nav-item"><a class="nav-link fw-semibold" href="#">Team</a></li>
          <li class="nav-item"><a class="nav-link fw-semibold" href="#">Pricing</a></li>
          <li class="nav-item"><a class="nav-link fw-semibold" href="#">Blog</a></li>
        </ul>
        <a href="#" class="btn btn-primary fw-bold">CONSULTANCY</a>
      </div>
    </div>
  </nav>`;
    if (navbar) {
        //  document.body.insertBefore(navbar, document.body.firstChild);
        document.body.insertAdjacentHTML("afterbegin", navbar);

    }


    // Load Footer
    const footer = tempDiv.querySelector('#footer');
    if (footer) {
        document.body.appendChild(footer);
    }
}

document.addEventListener("DOMContentLoaded", loadLayout);
