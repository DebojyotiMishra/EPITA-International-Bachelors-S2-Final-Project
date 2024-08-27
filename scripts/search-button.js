$(document).ready(function () {
  $("#searchButton").click(function () {
    $("#searchBox").toggle(); 
  });

  $("#searchBox").on("keyup", function () {
    var value = $(this).val().toLowerCase();
    $("#myTable tr")
      .not(":has(th)")
      .filter(function () {
        $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1);
      });
  });
});
