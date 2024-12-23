$(document).ready(function () {
  // Event Mouse: Click dan Hover
  $("#contactButton").click(function () {
    alert("You will contact alumni!");
  });

  $("#hoverProfile").hover(
    function () {
      // mouseenter
      $(this).css({
        "background-color": "lightblue",
        transform: "scale(1.05)",
        "box-shadow": "0 4px 8px rgba(0, 0, 0, 0.3)",
      });
      $(this).find("img").css({
        transform: "scale(1.1)",
        filter: "brightness(1.2)",
      });
    },
    function () {
      // mouseleave
      $(this).css({
        "background-color": "lightgray",
        transform: "scale(1)",
        "box-shadow": "none",
      });
      $(this).find("img").css({
        transform: "scale(1)",
        filter: "brightness(1)",
      });
    }
  );

  // Event Keyboard: Keydown
  $("#searchAlumni").keydown(function (event) {
    $("#output").text("You typed: " + event.key);
  });

  // Event Form: Submit
  $("#alumniForm").submit(function (event) {
    event.preventDefault(); // Prevent form submission
    const name = $("#name").val();
    const year = $("#year").val();
    const photo = $("#photo")[0].files[0];

    if (name && year && photo) {
      const reader = new FileReader();
      reader.onload = function (e) {
        const newRow = `
          <tr>
            <td class="name">${name}</td>
            <td class="year">${year}</td>
            <td><img src="${e.target.result}" alt="Photo of ${name}" class="alumni-photo"></td>
            <td class="action-buttons">
              <button class="delete">Delete</button>
            </td>
          </tr>`;
        $("#alumniTable tbody").append(newRow);

        // Clear the form
        $("#name").val("");
        $("#year").val("");
        $("#photo").val("");
        alert("Alumni data added!\nName: " + name + "\nYear: " + year);
      };
      reader.readAsDataURL(photo);
    } else {
      alert("Please fill in all fields!");
    }
  });

  // Event Dokumen/Window: Resize
  $(window).resize(function () {
    const width = $(window).width();
    const height = $(window).height();
    $("#windowSize").text("Window size: " + width + "x" + height);
  });

  // Event Miscellaneous: Ready
  $("#output").text("Document ready! All events ready to use.");

  // Event Kustom: Trigger custom event
  $("#contactButton").click(function () {
    $("#output").trigger("customEvent", ["Alumnus contact clicked!"]);
  });

  $("#output").on("customEvent", function (event, message) {
    $(this).append("<p>Custom event triggered: " + message + "</p>");
  });

  // Photo Animation: Focus, Lose Focus, Shift, Click, Double Click
  $("#alumniTable")
    .on("mouseenter", "img", function () {
      $(this).css({
        transform: "scale(1.1)",
        filter: "brightness(1.2)",
      });
    })
    .on("mouseleave", "img", function () {
      $(this).css({
        transform: "scale(1)",
        filter: "brightness(1)",
      });
    })
    .on("mousedown", "img", function () {
      $(this).css({
        transform: "scale(0.95)",
        filter: "brightness(0.8)",
      });
    })
    .on("mouseup", "img", function () {
      $(this).css({
        transform: "scale(1)",
        filter: "brightness(1)",
      });
    })
    .on("dblclick", "img", function () {
      $(this).css({
        transform: "rotate(15deg)",
        filter: "brightness(1.2)",
      });
      setTimeout(() => {
        $(this).css({
          transform: "rotate(0deg)",
          filter: "brightness(1)",
        });
      }, 500);
    });

  // Select, Mouseup, Mousemove events on the image
  $("#alumniTable")
    .on("selectstart", "img", function () {
      $("#output").text("Image is currently selected...");
    })
    .on("mouseup", "img", function () {
      $("#output").text("Mouse button released on image.");
    })
    .on("mousemove", "img", function (event) {
      const offsetX = event.offsetX;
      const offsetY = event.offsetY;
      $("#output").text(`Mouse moved: X=${offsetX}, Y=${offsetY}`);
    });

  // Delete Alumni
  $("#alumniTable").on("click", ".delete", function () {
    $(this).closest("tr").remove();
  });
});
