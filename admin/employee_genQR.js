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
    console.log(qrcode);
    let id = $("employee_id").val();
    generate(id);
  }
});
