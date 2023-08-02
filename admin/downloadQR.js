function myDownloads(divid) {
  html2canvas(document.getElementById(divid), {
    allowTaint: false,
    useCORS: true,
  }).then(function (canvas) {
    $("#previewImg").append(canvas);
    var anchorTag = document.createElement("a");
    document.body.appendChild(anchorTag);
    // document.getElementById(divid+"2").appendChild(canvas);
    anchorTag.download = "Visitor_" + divid + ".png";
    anchorTag.href = canvas.toDataURL();
    anchorTag.target = "_blank";
    anchorTag.click();
  });
}
