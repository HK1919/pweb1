$(document).ready(function () {
  // 1. Dasar selector
  $("#header").css("text-align", "center"); // Mengubah Align text pada header
  $("li").css("margin", "5px"); // Memberi margin pada semua <li>

  // 2. Selector Atribut
  $('img[alt="Alumni Photo 1"]').css("border", "2px solid red"); // Perbaikan tanda kutip

  // 3. Selector Hirarki
  $("#alumniList li").css("font-size", "18px"); // Mengubah font size pada semua <li> di dalam #alumniList

  // 4. Selector Filter
  $("li:even").css("color", "blue"); // Mengubah warna teks pada elemen <li> genap
  $(".featured").addClass("highlight"); // Menambahkan class highlight pada elemen dengan class featured

  // Event Handling untuk Galeri Photo
  $(".gallery img").on("click", function () {
    var src = $(this).attr("src");
    $("#modalImage").attr("src", src); // Mengubah source gambar di modal
    $("#myModal").fadeIn(); // Perbaikan metode
  });

  $(".modal .close").on("click", function () {
    $("#myModal").fadeOut();
  });

  $(window).on("click", function (event) {
    // Memastikan hanya modal yang ditutup jika area di luar modal diklik
    if ($(event.target).is("#myModal")) {
      $("#myModal").fadeOut();
    }
  });
});
