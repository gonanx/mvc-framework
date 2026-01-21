document.addEventListener("DOMContentLoaded", () => {
    const body = document.body;

    // Animación de entrada
    body.classList.add("page-transition");
    setTimeout(() => {
        body.classList.add("page-loaded");
    }, 10);

    // Animación de salida al hacer clic en enlaces
    document.querySelectorAll("a").forEach(enlace => {
        enlace.addEventListener("click", e => {
            const url = enlace.getAttribute("href");

            if (!url || url.startsWith("#")) return;

            e.preventDefault();
            body.classList.add("page-exit");

            setTimeout(() => {
                window.location.href = url;
            }, 300);
        });
    });

    // Animación de salida al enviar formularios
    document.querySelectorAll("form").forEach(form => {
        form.addEventListener("submit", () => {
            body.classList.add("page-exit");
        });
    });
});
