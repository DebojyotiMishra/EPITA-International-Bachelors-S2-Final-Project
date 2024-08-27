<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../styles/general.css">
    <link rel="stylesheet" href="../../styles/populations.css">
    <link rel="stylesheet" href="../../styles/grades.css">
    <link rel="stylesheet" href="../../styles/index.css">
    <link rel="icon" href="../../images/EPITA.svg">
    <title>Document</title>
</head>

<body>
    <nav>
        <div class="nav-container">
            <div class="logo">
                <a href="../welcome.php">
                    <img src="../../images/EPITA-nav.svg" alt="EPITA logo">
                </a>
            </div>

            <a href="../../php_actions/logout.php">
                <button class="Btn">
                    <div class="sign"><svg viewBox="0 0 512 512">
                            <path d="M377.9 105.9L500.7 228.7c7.2 7.2 11.3 17.1 11.3 27.3s-4.1 20.1-11.3 27.3L377.9 406.1c-6.4 6.4-15 9.9-24 9.9c-18.7 0-33.9-15.2-33.9-33.9l0-62.1-128 0c-17.7 0-32-14.3-32-32l0-64c0-17.7 14.3-32 32-32l128 0 0-62.1c0-18.7 15.2-33.9 33.9-33.9c9 0 17.6 3.6 24 9.9zM160 96L96 96c-17.7 0-32 14.3-32 32l0 256c0 17.7 14.3 32 32 32l64 0c17.7 0 32 14.3 32 32s-14.3 32-32 32l-64 0c-53 0-96-43-96-96L0 128C0 75 43 32 96 32l64 0c17.7 0 32 14.3 32 32s-14.3 32-32 32z"></path>
                        </svg></div>

                    <div class="text">Logout</div>
                </button>
            </a>
        </div>
    </nav>

    <h2>Grades</h2>

    <?php
    session_start(); // Start the session to access session variables

    // Retrieve courseCode from the URL
    $courseCode = isset($_GET['courseCode']) ? $_GET['courseCode'] : '';

    // Optionally store courseCode in the session
    if (!empty($courseCode)) {
        $_SESSION['courseCode'] = $courseCode;
    } else {
        // If courseCode is not set in the URL or session, show an error
        die("Course code is not set.");
    }

    // Access other session variables
    $status = isset($_SESSION['status']) ? $_SESSION['status'] : '';
    $period = isset($_SESSION['period']) ? $_SESSION['period'] : '';
    $year = isset($_SESSION['year']) ? $_SESSION['year'] : '';
    $program = isset($_SESSION['program']) ? $_SESSION['program'] : '';

    // Display the course code and other session information
    echo "<b>Course Code:</b> " . htmlspecialchars($courseCode, ENT_QUOTES, 'UTF-8') . "<br>";
    echo "<b>Status:</b> " . htmlspecialchars($status, ENT_QUOTES, 'UTF-8') . "<br>";
    echo "<b>Period:</b> " . htmlspecialchars($period, ENT_QUOTES, 'UTF-8') . "<br>";
    echo "<b>Year:</b> " . htmlspecialchars($year, ENT_QUOTES, 'UTF-8') . "<br>";
    echo "<b>Program:</b> " . htmlspecialchars($program, ENT_QUOTES, 'UTF-8') . "<br>";
    echo "<br>";

    // Database connection
    $conn = new mysqli("localhost", "root", "", "s2");

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Prepare the SQL statement
    $stmt = $conn->prepare("
SELECT
    g.grade_student_epita_email_ref,
    c.contact_first_name,
    c.contact_last_name,
    g.grade_exam_type_ref,
    g.grade_course_rev_ref,  /* Including this to use it in the form, not in the table display */
    g.grade_score
FROM
    grades g
JOIN
    students s ON g.grade_student_epita_email_ref = s.student_epita_email
JOIN
    contacts c ON s.student_contact_ref = c.contact_email
WHERE
    g.grade_course_code_ref = ?
    AND s.student_population_code_ref = ?
    AND s.student_population_year_ref = ?
");

    // Bind parameters to the SQL query
    $stmt->bind_param("sss", $courseCode, $program, $year);

    // Execute the query
    $stmt->execute();

    // Fetch the results
    $result = $stmt->get_result();
    $grades = $result->fetch_all(MYSQLI_ASSOC);

    // Check if there are any results
    if (!empty($grades)) {
        echo '<table>';
        echo '<tr>';
        echo '<th>Student Email</th>';
        echo '<th>First Name</th>';
        echo '<th>Last Name</th>';
        echo '<th>Exam Type</th>';
        echo '<th>Score</th>';
        echo '<th>Actions</th>';
        echo '</tr>';

        // Loop through the results and display each row in the table
        foreach ($grades as $row) {
            echo '<tr>';
            echo '<td>' . htmlspecialchars($row['grade_student_epita_email_ref'] ?? '', ENT_QUOTES, 'UTF-8') . '</td>';
            echo '<td>' . htmlspecialchars($row['contact_first_name'] ?? '', ENT_QUOTES, 'UTF-8') . '</td>';
            echo '<td>' . htmlspecialchars($row['contact_last_name'] ?? '', ENT_QUOTES, 'UTF-8') . '</td>';
            echo '<td>' . htmlspecialchars($row['grade_exam_type_ref'] ?? '', ENT_QUOTES, 'UTF-8') . '</td>';
            echo '<td>' . htmlspecialchars($row['grade_score'] ?? '', ENT_QUOTES, 'UTF-8') . '</td>';
            echo '<td><img src="images/edit_logo.svg" alt="Edit" class="edit-icon" 
            data-email="' . htmlspecialchars($row['grade_student_epita_email_ref'], ENT_QUOTES, 'UTF-8') . '" 
            data-course="' . htmlspecialchars($courseCode, ENT_QUOTES, 'UTF-8') . '" 
            data-rev="' . htmlspecialchars($row['grade_course_rev_ref'], ENT_QUOTES, 'UTF-8') . '" 
            data-exam="' . htmlspecialchars($row['grade_exam_type_ref'], ENT_QUOTES, 'UTF-8') . '"></td>';
            echo '</tr>';
        }

        echo '</table>';
    } else {
        echo 'No grades found for this course and program.';
    }

    // Close the statement and connection
    $stmt->close();
    $conn->close();
    ?>

    <!-- The Edit Grade Modal -->
    <div id="editGradeModal">
        <div class="modal-content">
            <button type="button" class="close">&times;</button>
            <form id="editGradeForm">
                <input type="hidden" id="studentEmail" name="studentEmail">
                <input type="hidden" id="courseCode" name="courseCode">
                <input type="hidden" id="courseRev" name="courseRev">
                <input type="hidden" id="examType" name="examType">
                <label for="newGrade">New Grade:</label>
                <input type="number" id="newGrade" name="newGrade" required>
                <button type="submit">Submit</button>
                <button type="button" id="cancelBtn">Cancel</button>
            </form>
        </div>
    </div>


    <script src="../../scripts/ajax-edit-grade-form.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const modal = document.getElementById('editGradeModal');
            const closeButton = document.querySelector('#editGradeModal .close');
            const cancelButton = document.getElementById('cancelBtn');

            // Function to hide the modal
            function hideModal() {
                modal.style.display = 'none';
            }

            // Event listener for close button
            closeButton.addEventListener('click', hideModal);

            // Event listener for cancel button
            cancelButton.addEventListener('click', hideModal);
        });
    </script>

</body>

</html>