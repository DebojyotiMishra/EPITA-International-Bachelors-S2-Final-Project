document.addEventListener("DOMContentLoaded", function() {
    var modal = document.getElementById("addCourseModal");
    var btn = document.getElementById("addCourseButton");
    var closeBtn = modal.getElementsByClassName("close")[0];

    // When the user clicks the button, open the modal 
    btn.onclick = function() {
        modal.style.display = "block";
    }

    // When the user clicks on <span> (x), close the modal
    closeBtn.onclick = function() {
        modal.style.display = "none";
    }

    // When the user clicks anywhere outside of the modal, close it
    window.onclick = function(event) {
        if (event.target == modal) {
            modal.style.display = "none";
        }
    }

    document.getElementById("addCourseForm").addEventListener("submit", function(event) {
        event.preventDefault();
        var formData = new FormData(this);
        var url = '/src/php_actions/add_course.php';

        fetch(url, {
            method: 'POST',
            body: formData
        }).then(response => {
            if (!response.ok) {
                throw new Error('Network response was not ok ' + response.statusText);
            }
            return response.text();
        }).then(text => {
            try {
                var data = JSON.parse(text);
            } catch (e) {
                throw new Error('Failed to parse JSON response: ' + text);
            }
            if (data.success) {
                alert('Course added successfully!');
                location.reload();
            } else {
                alert('Error adding course: ' + data.error);
            }
        }).catch(error => {
            console.error('Error:', error);
            alert('An error occurred while adding the course. Details: ' + error.message);
        });
    });
});
