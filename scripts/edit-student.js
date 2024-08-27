$(document).ready(function () {
  $(".edit-student").click(function (event) {
    event.preventDefault(); // Prevent the default action

    var email = $(this).data("email"); // Get the student email from the data attribute
    var firstName = $(this).data("firstname"); // Get the first name from the data attribute
    var lastName = $(this).data("lastname"); // Get the last name from the data attribute

    // Populate the form with the student's current data
    $("#contactFirstName").val(firstName);
    $("#contactLastName").val(lastName);

    // Attach the email to the form as a hidden input
    if ($("#editForm").find("input[name='email']").length === 0) {
      $("<input>").attr({
        type: "hidden",
        name: "email",
        value: email
      }).appendTo("#editForm form");
    } else {
      $("input[name='email']").val(email);
    }

    // Show the modal
    $("#editForm").css("display", "block");
  });

  // Handle form submission
  $("#editForm form").submit(function (event) {
    event.preventDefault(); // Prevent the form from submitting normally

    var formData = $(this).serialize(); // Serialize the form data

    $.ajax({
      url: "../../../php_actions/edit_student.php",
      type: "post",
      data: formData,
      success: function (response) {
        // handle the response from the server
        alert(response);
        // Close the modal after successful submission
        $("#editForm").css("display", "none");
      },
      error: function (xhr, status, error) {
        // handle error
        console.error("AJAX Error: ", xhr.responseText);
        alert("An error occurred: " + xhr.responseText);
      },
    });
  });

  // Close modal when clicking on <span> (x)
  $(".close").click(function () {
    $("#editForm").css("display", "none");
  });

  // Close modal when clicking outside of the modal content
  $(window).click(function (event) {
    if ($(event.target).is("#editForm")) {
      $("#editForm").css("display", "none");
    }
  });
});
