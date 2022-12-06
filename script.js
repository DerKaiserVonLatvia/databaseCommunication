// NOTE: RUN WITH HTTP://, NOT FILE://
window.addEventListener("load", () => {
    fetch("server.php", { method : "POST" })
    .then(res => res.text()).then((txt) => {
      document.getElementById("demo").innerHTML = txt;
    });
  });