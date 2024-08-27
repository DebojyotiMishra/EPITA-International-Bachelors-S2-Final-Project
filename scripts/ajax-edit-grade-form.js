document.addEventListener('DOMContentLoaded', function() {
    const editIcons = document.querySelectorAll('.edit-icon');
    const modal = document.getElementById('editGradeModal');
    const form = document.getElementById('editGradeForm');

    editIcons.forEach(icon => {
        icon.addEventListener('click', function() {
            // Set form values based on the data attributes of the clicked icon
            document.getElementById('studentEmail').value = this.getAttribute('data-email');
            document.getElementById('courseCode').value = this.getAttribute('data-course');
            document.getElementById('courseRev').value = this.getAttribute('data-rev');
            document.getElementById('examType').value = this.getAttribute('data-exam');

            // Show the modal
            modal.style.display = 'block';
        });
    });

    document.getElementById('cancelBtn').addEventListener('click', function() {
        modal.style.display = 'none';
    });

    form.addEventListener('submit', function(event) {
        event.preventDefault();

        // Prepare form data for submission
        const formData = new FormData(form);

        // Send the AJAX request to update the grade
        fetch('../../php_actions/update_grade.php', {
            method: 'POST',
            body: formData
        })
        .then(response => response.text())
        .then(data => {
            alert(data); // Display the response from the server
            modal.style.display = 'none'; // Hide the modal
            location.reload(); // Reload the page to see the changes
        })
        .catch(error => {
            console.error('Error:', error);
        });
    });
});