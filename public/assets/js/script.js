const body       = document.querySelector("body"),
      sidebar    = body.querySelector(".sidebar"),
      toggle     = body.querySelector(".toggle"),
      modeSwitch = body.querySelector(".toggle-switch"),
      modeText   = body.querySelector(".mode-text"),
      footer     = document.querySelector("footer");

if (localStorage.getItem("sidebarClosed") === "true") {
    sidebar.classList.add("close");
} else {
    sidebar.classList.remove("close");
}

if (localStorage.getItem("darkMode") === "true") {
    body.classList.add("dark");
    modeText.innerText = "Light Mode";
}

toggle.addEventListener("click", () => {
    sidebar.classList.toggle("close");
    const isClosed = sidebar.classList.contains("close");
    localStorage.setItem("sidebarClosed", isClosed);

    if (footer) {
        footer.style.left  = isClosed ? "88px"  : "250px";
        footer.style.width = isClosed ? "calc(100% - 88px)" : "calc(100% - 250px)";
    }
});

modeSwitch.addEventListener("click", () => {
    body.classList.toggle("dark");
    const isDark = body.classList.contains("dark");
    modeText.innerText = isDark ? "Light Mode" : "Dark Mode";
    localStorage.setItem("darkMode", isDark);
});

// ── Navegación SPA ──────────────────────────────────────────
function cargarProblema(p) {
    const section = document.querySelector('.home');
    const url     = p ? `index.php?p=${p}&ajax=1` : `index.php?ajax=1`;

    section.style.opacity = '0.5';

    fetch(url)
        .then(res => res.text())
        .then(html => {
            section.innerHTML = html;
            section.style.opacity = '1';

            section.querySelectorAll('script').forEach(old => {
                const s = document.createElement('script');
                s.textContent = `(function(){ ${old.textContent} })();`; // ← fix
                document.body.appendChild(s);
                old.remove();
            });
        });
}

function activarLink(p) {
    document.querySelectorAll('.sidebar li a').forEach(a => a.classList.remove('active'));
    const target = p
        ? document.querySelector(`.sidebar li a[data-p="${p}"]`)
        : document.querySelector(`.sidebar li a[data-p="home"]`);
    if (target) target.classList.add('active');
}

document.querySelectorAll('.sidebar li a').forEach(link => {
    link.addEventListener('click', function(e) {
        e.preventDefault();
        const p = this.dataset.p === 'home' ? null : this.dataset.p;
        activarLink(p);
        history.pushState({ p }, '', p ? `index.php?p=${p}` : 'index.php');
        cargarProblema(p);
    });
});

window.addEventListener('popstate', function(e) {
    const p = e.state?.p ?? null;
    activarLink(p);
    cargarProblema(p);
});