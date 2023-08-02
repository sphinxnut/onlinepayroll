$(".Generate").click(function (e) {
  e.preventDefault();
  $("#Generate").modal("show");
  var id = $(this).data("id");
  getRow(id);

  function generate(user_input) {
    document.querySelector(".qr-code").style = "";

    var qrcode = new QRCode(document.querySelector(".qr-code"), {
      text: `${user_input.value}`,
      width: 180, //128
      height: 180,
      colorDark: "#000000",
      colorLight: "#ffffff",
      correctLevel: QRCode.CorrectLevel.H,
    });
<<<<<<< HEAD
    console.log(qrcode);
    let id = $("employee_id").val();
    generate(id);
=======

    let id = $("employee_id").val();
    generate(id);

    let download = document.createElement("button");
    document.querySelector(".qr-code").appendChild(download);

    let download_link = document.createElement("a");
    download_link.setAttribute("download", "qr_code_linq.png");
    download_link.innerText = "Download";

    download.appendChild(download_link);

    if (document.querySelector(".qr-code img").getAttribute("src") == null) {
      setTimeout(() => {
        download_link.setAttribute(
          "href",
          `${document.querySelector("canvas").toDataURL()}`
        );
      }, 300);
    } else {
      setTimeout(() => {
        download_link.setAttribute(
          "href",
          `${document.querySelector(".qr-code img").getAttribute("src")}`
        );
      }, 300);
    }
>>>>>>> 843d8c2f4e0b3b6029f99d585fee760d7f0fcb1d
  }
});
