$(document).ready(function () {
  $(".delete-student").click(function (e) {
    e.preventDefault();
    var email = $(this).data("email");
    var row = $(this).closest("tr"); // Store the row to remove it later

    // Add confirmation dialog
    var confirmDelete = confirm("Are you sure you want to delete this student record?");
    if (confirmDelete) {
      $.ajax({
        url: "../../../php_actions/delete_student.php",
        type: "post",
        data: {
          email: email,
        },
        success: function (response) {
          // Display the success message
          alert(response);
          // Remove the row from the table
          row.remove();
        },
        error: function (jqXHR, textStatus, errorThrown) {
          // Display the error message
          alert("Error: " + errorThrown);
        },
      });
    }
  });
});