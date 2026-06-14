const body = document.querySelector("body"),
    sidebar = body.querySelector(".sidebar"),
    toggle = body.querySelector(".toggle"),
    modeSwitch = body.querySelector(".toggle-switch"),
    modeText = body.querySelector(".mode-text"),
    footer = document.querySelector("footer");

// Restaurar estado del sidebar al cargar
if (localStorage.getItem("sidebarClosed") === "true") {
    sidebar.classList.add("close");
} else {
    sidebar.classList.remove("close");
}

// Restaurar modo oscuro al cargar
if (localStorage.getItem("darkMode") === "true") {
    body.classList.add("dark");
    modeText.innerText = "Light Mode";
}

// Toggle sidebar
toggle.addEventListener("click", () => {
    sidebar.classList.toggle("close");
    const isClosed = sidebar.classList.contains("close");
    localStorage.setItem("sidebarClosed", isClosed);

    if (footer) {
        footer.style.left = isClosed ? "88px" : "250px";
        footer.style.width = isClosed ? "calc(100% - 88px)" : "calc(100% - 250px)";
    }
});

// Toggle dark mode
modeSwitch.addEventListener("click", () => {
    body.classList.toggle("dark");
    const isDark = body.classList.contains("dark");
    modeText.innerText = isDark ? "Light Mode" : "Dark Mode";
    localStorage.setItem("darkMode", isDark);
});

const menuLinks = document.querySelectorAll(".sidebar li a");

menuLinks.forEach(link => {
    link.addEventListener("click", function () {
        // 1. Removemos la clase 'active' de todos los enlaces
        menuLinks.forEach(item => item.classList.remove("active"));

        // 2. Agregamos la clase 'active' al enlace que clickeamos
        this.classList.add("active");
    });
});