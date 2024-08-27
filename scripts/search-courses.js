$(document).ready(function () {
    $("#searchCoursesButton").click(function () {
      $("#searchCourses").toggle(); 
    });
  
    $("#searchCourses").on("keyup", function () {
      var value = $(this).val().toLowerCase();
      $("#coursesTable tr")
        .not(":has(th)")
        .filter(function () {
          $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1);
        });
    });
  });
  