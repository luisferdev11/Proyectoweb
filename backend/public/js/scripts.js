//Agregar contenido JavaScript aquí
document.addEventListener("DOMContentLoaded", function () {
  function adjustFooter() {
    var footer = document.querySelector(".footer");
    var containerHeight = document.querySelector(".content").offsetHeight;
    var windowHeight = window.innerHeight;

    if (containerHeight > windowHeight) {
      footer.classList.add("relative");
    } else {
      footer.classList.remove("relative");
    }
  }

  adjustFooter();

  window.addEventListener("resize", adjustFooter);
});
