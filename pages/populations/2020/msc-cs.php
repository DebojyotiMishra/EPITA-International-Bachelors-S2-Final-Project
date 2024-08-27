<?php
session_start();
$_SESSION['status'] = 'completed';
$_SESSION['period'] = 'FALL';
$_SESSION['year'] = '2020';
$_SESSION['program'] = 'CS';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../../styles/general.css">
    <link rel="stylesheet" href="../../../styles/populations.css">
    <link rel="stylesheet" href="../../../styles/index.css">
    <link rel="icon" href="../../../images/EPITA.svg">
    <title>Population MSc CS</title>
</head>

<body>
    <nav>
        <div class="nav-container">
            <div class="logo">
                <a href="../../welcome.php">
                    <img src="../../../images/EPITA-nav.svg" alt="EPITA logo">
                </a>
            </div>

            <a href="../../../php_actions/logout.php">
                <button class="Btn">
                    <div class="sign"><svg viewBox="0 0 512 512">
                            <path d="M377.9 105.9L500.7 228.7c7.2 7.2 11.3 17.1 11.3 27.3s-4.1 20.1-11.3 27.3L377.9 406.1c-6.4 6.4-15 9.9-24 9.9c-18.7 0-33.9-15.2-33.9-33.9l0-62.1-128 0c-17.7 0-32-14.3-32-32l0-64c0-17.7 14.3-32 32-32l128 0 0-62.1c0-18.7 15.2-33.9 33.9-33.9c9 0 17.6 3.6 24 9.9zM160 96L96 96c-17.7 0-32 14.3-32 32l0 256c0 17.7 14.3 32 32 32l64 0c17.7 0 32 14.3 32 32s-14.3 32-32 32l-64 0c-53 0-96-43-96-96L0 128C0 75 43 32 96 32l64 0c17.7 0 32 14.3 32 32s-14.3 32-32 32z"></path>
                        </svg></div>

                    <div class="text">Logout</div>
                </button>
            </a>
        </div>
    </nav>

    <div class="populations-title-wrapper">
        <p class="populations-title"><a href="../../welcome.php">Home</a> / Population - <span class="bold-text">M.Sc.
                CS F2020</span>
        </p>
    </div>

    <!-- Students -->
    <div class="students-wrapper">
        <h3 class="title">Students</h3>

        <button class="button" id="addButton">Add</button>
        <button class="button" id="searchButton">Search</button>
        <input type="text" id="searchBox" style="display: none;" placeholder="Search..." class="input-field">

        <!-- The Modal -->
        <div id="myModal" class="modal">

            <!-- Modal content -->
            <div class="modal-content">
                <span class="close">&times;</span>
                <h2>Add Student</h2>
                <!-- Add Student Form -->
                <form id="studentForm">
                    <label for="email">Epita Email:</label><br>
                    <input type="email" id="email" name="email" required><br>
                    <label for="contact">Contact Email:</label><br>
                    <input type="email" id="contact" name="contact" required><br>
                    <label for="first_name">First Name:</label><br>
                    <input type="text" id="first_name" name="first_name" required><br>
                    <label for="last_name">Last Name:</label><br>
                    <input type="text" id="last_name" name="last_name" required><br>
                    <label for="address">Address:</label><br>
                    <input type="text" id="address" name="address" required><br>
                    <label for="city">City:</label><br>
                    <input type="text" id="city" name="city" required><br>
                    <label for="country">Country:</label><br>
                    <input type="text" id="country" name="country" required><br>
                    <label for="birthdate">Birthdate:</label><br>
                    <input type="date" id="birthdate" name="birthdate" required><br>
                    <input type="submit" value="Add Student">
                </form>
            </div>
        </div>

        <?php
        // Connect to MySQL
        $conn = new mysqli("localhost", "root", "", "s2");

        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        echo "<table id='myTable'>\n";
        echo "\t\t<th>Email</th>\n";
        echo "\t\t<th>First Name</th>\n";
        echo "\t\t<th>Last Name</th>\n";
        echo "\t\t<th>Passed</th>\n";
        echo "\t</tr>\n";

        $sql = "
                SELECT
                    s.student_epita_email AS email,
                    c.contact_first_name AS first_name,
                    c.contact_last_name AS last_name,
                    CONCAT(
                        COALESCE(passed_classes.passed_count, 0),
                        '/',
                        COALESCE(total_classes.total_count, 0)
                    ) AS passed_classes_over_total
                FROM
                    students s
                JOIN
                    contacts c ON s.student_contact_ref = c.contact_email
                LEFT JOIN
                    (SELECT
                        grade_student_epita_email_ref,
                        COUNT(*) AS passed_count
                    FROM
                        (SELECT
                            grade_student_epita_email_ref,
                            grade_course_code_ref,
                            AVG(grade_score) AS avg_grade
                        FROM
                            grades
                        GROUP BY
                            grade_student_epita_email_ref, grade_course_code_ref
                        ) AS avg_grades
                    WHERE
                        avg_grade >= 10
                    GROUP BY
                        grade_student_epita_email_ref
                    ) AS passed_classes
                ON
                    s.student_epita_email = passed_classes.grade_student_epita_email_ref
                LEFT JOIN
                    (SELECT
                        grade_student_epita_email_ref,
                        COUNT(*) AS total_count
                    FROM
                        (SELECT
                            grade_student_epita_email_ref,
                            grade_course_code_ref
                        FROM
                            grades
                        GROUP BY
                            grade_student_epita_email_ref, grade_course_code_ref
                        ) AS distinct_courses
                    GROUP BY
                        grade_student_epita_email_ref
                    ) AS total_classes
                ON
                    s.student_epita_email = total_classes.grade_student_epita_email_ref
                WHERE
                    s.student_population_code_ref = 'CS' AND student_population_year_ref = '2020'
            ";

        $result = $conn->query($sql);

        // Fetch all rows
        $rows = $result->fetch_all(MYSQLI_ASSOC);

        // Generate table content
        foreach ($rows as $row) {
            echo "\t<tr>\n";
            echo "\t\t<td>{$row['email']}</td>\n";
            echo "\t\t<td>{$row['first_name']}</td>\n";
            echo "\t\t<td>{$row['last_name']}</td>\n";
            echo "\t\t<td>{$row['passed_classes_over_total']}</td>\n";
            echo "\t\t<td><a href=\"#\" class=\"edit-student\" data-email=\"{$row['email']}\" data-firstname=\"{$row['first_name']}\" data-lastname=\"{$row['last_name']}\"><img src=\"../images/edit_logo.svg\"></a></td>\n";
            echo "\t\t<td><a href=\"#\" class=\"delete-student\" data-email=\"{$row['email']}\"><img src=\"../images/trash_logo.svg\" class=\"trash-icon\"></a></td>\n";
            echo "\t</tr>\n";
        }

        echo "</table>\n";
        $conn->close();
        ?>

        <!-- Modal -->
        <div id="editForm" class="modal">
            <!-- Modal content -->
            <div class="modal-content">
                <span class="close">&times;</span>
                <h2>Change student name</h2>
                <form>
                    <label for="contactFirstName">First Name:</label>
                    <input type="text" id="contactFirstName" name="first_name" required>
                    <label for="contactLastName">Last Name:</label>
                    <input type="text" id="contactLastName" name="last_name" required>
                    <input type="submit" value="Save">
                </form>
            </div>
        </div>

    </div>

    <!-- Courses -->
    <div class="courses-wrapper">
        <h3 class="title">Courses</h3>

        <button class="button" id="addCourseButton">Add</button>
        <button class="button" id="searchCoursesButton">Search</button>
        <input type="text" id="searchCourses" style="display: none;" placeholder="Search..." class="input-field">

        <?php
        // Connect to MySQL
        $conn = new mysqli("localhost", "root", "", "s2");

        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        // Prepare SQL statement
        $stmt = $conn->prepare("SELECT 
        c.course_code AS 'Course ID',
        c.course_name AS 'Name',
        FLOOR(c.duration) AS 'Sessions Count', 
        CONCAT(t.first_name, ' ', t.last_name) AS 'Teacher'
    FROM 
        courses c
    JOIN 
        teachers t 
    ON 
        c.teacher_epita_email_ref = t.teacher_epita_email
    JOIN 
        programs p
    ON 
        c.course_code = p.program_course_code_ref AND c.course_rev = p.program_course_rev_ref
    WHERE 
        p.program_assignment = ?;");

        // Bind the 'CS' program to the statement
        $program = 'CS';
        $stmt->bind_param("s", $program);

        // Execute SQL statement
        $stmt->execute();

        // Get the result
        $result = $stmt->get_result();

        // Check if there are any results
        if ($result->num_rows > 0) {
            // Fetch all rows as an associative array
            $courses = $result->fetch_all(MYSQLI_ASSOC);
        } else {
            $courses = [];
            echo "No courses found for the specified program.";
        }

        // Close statement
        $stmt->close();

        // Close connection
        $conn->close();
        ?>

        <?php
        $courseCode = "";
        ?>

        <!-- Display the courses in a table -->
        <?php if (!empty($courses)) : ?>
            <table id="coursesTable">
                <tr>
                    <th>Course ID</th>
                    <th>Name</th>
                    <th>Sessions Count</th>
                    <th>Teacher</th>
                </tr>
                <?php foreach ($courses as $course) : ?>
                    <tr>
                        <td><?php echo htmlspecialchars($course['Course ID'], ENT_QUOTES, 'UTF-8'); ?></td>
                        <td>
                            <a href="/src/pages/grades/grades.php?courseCode=<?php echo urlencode($course['Course ID']); ?>">
                                <?php echo htmlspecialchars($course['Name'], ENT_QUOTES, 'UTF-8'); ?>
                            </a>
                        </td>
                        <td><?php echo htmlspecialchars($course['Sessions Count'], ENT_QUOTES, 'UTF-8'); ?></td>
                        <td><?php echo htmlspecialchars($course['Teacher'], ENT_QUOTES, 'UTF-8'); ?></td>
                    </tr>
                <?php endforeach; ?>
            </table>
        <?php endif; ?>

        <!-- Add Course Modal -->
        <div id="addCourseModal" class="modal" style="display: none;">
            <div class="modal-content">
                <span class="close">&times;</span> <!-- Close button -->
                <h2>Add Course</h2>
                <form id="addCourseForm" method="POST" action="add_course.php">
                    <label for="course_id">Course ID:</label>
                    <input type="text" id="course_id" name="course_id" required><br><br>

                    <label for="course_name">Course Name:</label>
                    <input type="text" id="course_name" name="course_name" required><br><br>

                    <label for="course_rev">Course Revision:</label>
                    <input type="number" id="course_rev" name="course_rev" value="1" required><br><br>

                    <label for="duration">Duration (in hours):</label>
                    <input type="number" id="duration" name="duration" required><br><br>

                    <label for="course_last_rev">Course Last Revision Year:</label>
                    <input type="number" id="course_last_rev" name="course_last_rev" required><br><br>

                    <label for="course_description">Course Description:</label>
                    <textarea id="course_description" name="course_description" required></textarea><br><br>

                    <label for="program_assignment">Program Assignment:</label>
                    <select id="program_assignment" name="program_assignment" required>
                        <option value="AIs">AIs</option>
                        <option value="DSA">DSA</option>
                        <option value="CS">CS</option>
                        <option value="ISM">ISM</option>
                        <option value="SE">SE</option>
                    </select><br><br>

                    <label for="teacher_name">Teacher Email:</label>
                    <select id="teacher_name" name="teacher_name" required>
                        <?php
                        // Connect to MySQL
                        $conn = new mysqli("localhost", "root", "", "s2");

                        // Check connection
                        if ($conn->connect_error) {
                            die("Connection failed: " . $conn->connect_error);
                        }

                        // Fetch teacher emails from the database
                        $result = $conn->query("SELECT teacher_epita_email, first_name, last_name FROM teachers");

                        // Check if there are any results
                        if ($result->num_rows > 0) {
                            while ($row = $result->fetch_assoc()) {
                                $email = htmlspecialchars($row['teacher_epita_email'], ENT_QUOTES, 'UTF-8');
                                $teacher_name = htmlspecialchars($row['first_name'] . ' ' . $row['last_name'], ENT_QUOTES, 'UTF-8');
                                echo "<option value='$email'>$teacher_name ($email)</option>";
                            }
                        } else {
                            echo "<option value='' disabled>No teachers found</option>";
                        }

                        $conn->close();
                        ?>
                    </select><br><br>

                    <input type="submit" value="Add Course">
                </form>
            </div>
        </div>



        <!-- Construction Date -->
        <div id="constructionDate">
            Website Last Generation: <span id="lastUpdatedDate"></span>
        </div>

        <script src="../../../scripts/last-construction.js"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="../../../scripts/add-student.js"></script>
        <script src="../../../scripts/search-button.js"></script>
        <script src="../../../scripts/search-courses.js"></script>
        <script src="../../../scripts/delete-student.js"></script>
        <script src="../../../scripts/edit-student.js"></script>
        <script src="../../../scripts/ajax-add-course-form.js"></script>
        <script>
            function setcourseCode(courseId) {
                var xhr = new XMLHttpRequest();
                xhr.open("POST", "set_session.php", true);
                xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
                xhr.onreadystatechange = function() {
                    if (this.readyState === XMLHttpRequest.DONE && this.status === 200) {
                        console.log("Session variable set successfully");
                    }
                }
                xhr.send("courseId=" + courseId);
            }
        </script>
</body>

</html>