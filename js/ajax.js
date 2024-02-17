var baseUrl = window.location.origin + "/hotel-cristania";
console.log(baseUrl);

function responseSweet(msg, type, title) {
  Swal.fire({
    icon: type,
    title: title,
    text: msg,
    timerProgressBar: true,
    timer: 5000,
    showConfirmButton: false,
    customClass: {
      progressBar: "progress-bar-custore", // Aplica a classe CSS personalizada à barra de progresso
    },
  });
}

let formLogin = document.querySelector(".form-login");
// POST

const form = document.querySelector(".form-post");

form.addEventListener("submit", (e) => {
  e.preventDefault();

  const datas = new FormData(form);

  console.log(JSON.stringify(datas));

  fetch(`${baseUrl}/ajax.php`, {
    body: datas,
    method: "POST",
  })
    .then((res) => res.json())
    .then((response) => {
      if (response.status == 200) {
        responseSweet(response.msg, "success", "Boa!!");
        setTimeout(() => {
          location.reload();
        }, 1500);
      } else {
        responseSweet(response.msg, "error", "Oopss!!");
      }
    });
});
