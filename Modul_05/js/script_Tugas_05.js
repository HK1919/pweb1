$(document).ready(function () {
  // Fade-in gambar dengan efek berurutan
  $(".gallery img").each(function (index) {
    $(this)
      .delay(index * 200)
      .fadeTo(500, 1);
  });

  // Event hover pada gambar gallery
  $(".gallery img").hover(
    function () {
      // mouseenter
      $(this).css({
        "background-color": "lightblue",
        transform: "scale(1.1)",
        boxShadow: "0 4px 8px rgba(0,0,0,0.3)",
        filter: "brightness(1.2)",
      });
    },
    function () {
      // mouseleave
      $(this).css({
        transform: "scale(1)",
        boxShadow: "none",
        filter: "none",
        "background-color": "white",
      });
    }
  );

  // Buka modal saat gambar diklik
  $(".gallery img").on("click", function () {
    const src = $(this).attr("src");
    const alt = $(this).attr("alt");

    $("#modalImage").attr("src", src);
    $("#modalImage").attr("alt", alt);

    $("#photoModal").fadeIn(300);

    // Tambahkan output untuk event
    $("#output").text(`Membuka foto: ${alt}`);
  });

  // Tutup modal dengan tombol close
  $(".close").on("click", function () {
    $("#photoModal").fadeOut(300);
    $("#output").text("Modal ditutup");
  });

  // Tutup modal saat mengklik area di luar gambar
  $(window).on("click", function (event) {
    if ($(event.target).is("#photoModal")) {
      $("#photoModal").fadeOut(300);
      $("#output").text("Modal ditutup");
    }
  });

  // Event tambahan pada gambar di modal
  $("#modalImage")
    .on("mouseenter", function () {
      $(this).css({
        transform: "scale(1.02)",
        filter: "brightness(1.1)",
      });
    })
    .on("mouseleave", function () {
      $(this).css({
        transform: "scale(1)",
        filter: "brightness(1)",
      });
    })
    .on("dblclick", function () {
      $(this).css({
        transform: "rotate(15deg)",
      });
      setTimeout(() => {
        $(this).css({
          transform: "rotate(0deg)",
        });
      }, 500);
    });

  // event kustom
  $("#photoModal").on("modalOpened", function (event, imageName) {
    $("#output").append(`<p>Modal dibuka untuk: ${imageName}</p>`);
  });
});
