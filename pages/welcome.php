<?php
session_start();
if (isset($_SESSION['email']) && isset($_SESSION['first_name']) && isset($_SESSION['last_name'])) {
    $email = $_SESSION['email'];
    $first_name = $_SESSION['first_name'];
    $last_name = $_SESSION['last_name'];

    // Array of courses
    $courses = [
        'AIs' => 'Artificial Intelligence Systems',
        'CS' => 'Cyber Security',
        'DSA' => 'Data Science and Analytics',
        'ISM' => 'Information Systems Management',
        'SE' => 'Software Engineering'
    ];

    // Arrays to hold data for the charts
    $course_names = [];
    $student_counts_fall_2020 = [];
    $student_counts_spring_2021 = [];
    $attendance_fall_2020 = [];
    $attendance_spring_2021 = [];

    // Include your database connection file
    include '../php_actions/db_conn.php';

    foreach ($courses as $code => $name) {
        // Fetch student counts for Fall 2020
        $sql_fall = "SELECT COUNT(*) AS student_count 
                     FROM students 
                     WHERE student_population_code_ref = '$code' 
                     AND student_population_year_ref = 2020";
        $result_fall = $conn->query($sql_fall);
        $row_fall = $result_fall->fetch_assoc();
        $student_counts_fall_2020[] = $row_fall['student_count'];

        // Fetch student counts for Spring 2021
        $sql_spring = "SELECT COUNT(*) AS student_count 
                       FROM students 
                       WHERE student_population_code_ref = '$code' 
                       AND student_population_year_ref = 2021";
        $result_spring = $conn->query($sql_spring);
        $row_spring = $result_spring->fetch_assoc();
        $student_counts_spring_2021[] = $row_spring['student_count'];

        // Fetch attendance for Fall 2020
        $sql_attendance_fall = "SELECT ROUND(
                                (
                                    COUNT(
                                        CASE
                                            WHEN a.attendance_presence = 1 THEN 1
                                        END
                                    ) * 100.0 / COUNT(*)
                                ),
                                2
                            ) AS presence_percentage
                            FROM students s
                                LEFT JOIN attendance a ON s.student_epita_email = a.attendance_student_ref
                            WHERE a.attendance_population_year_ref = 2020
                            AND s.student_population_code_ref = '$code'";
        $result_attendance_fall = $conn->query($sql_attendance_fall);
        $row_attendance_fall = $result_attendance_fall->fetch_assoc();
        $attendance_fall_2020[] = $row_attendance_fall['presence_percentage'];

        // Fetch attendance for Spring 2021
        $sql_attendance_spring = "SELECT ROUND(
                                (
                                    COUNT(
                                        CASE
                                            WHEN a.attendance_presence = 1 THEN 1
                                        END
                                    ) * 100.0 / COUNT(*)
                                ),
                                2
                            ) AS presence_percentage
                            FROM students s
                                LEFT JOIN attendance a ON s.student_epita_email = a.attendance_student_ref
                            WHERE a.attendance_population_year_ref = 2021
                            AND s.student_population_code_ref = '$code'";
        $result_attendance_spring = $conn->query($sql_attendance_spring);
        $row_attendance_spring = $result_attendance_spring->fetch_assoc();
        $attendance_spring_2021[] = $row_attendance_spring['presence_percentage'];

        // Store course names
        $course_names[] = $name;
    }
?>

    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="../styles/general.css">
        <link rel="stylesheet" href="../styles/index.css">
        <link rel="stylesheet" href="../styles/populations.css">
        <link rel="icon" href="../images/EPITA.svg">
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
        <title>Home</title>
    </head>

    <body>
        <nav>
            <div class="nav-container">
                <div class="logo">
                    <img src="../images/EPITA-nav.svg" alt="EPITA logo">
                </div>

                <a href="../php_actions/logout.php">
                    <button class="Btn">
                        <div class="sign"><svg viewBox="0 0 512 512">
                                <path d="M377.9 105.9L500.7 228.7c7.2 7.2 11.3 17.1 11.3 27.3s-4.1 20.1-11.3 27.3L377.9 406.1c-6.4 6.4-15 9.9-24 9.9c-18.7 0-33.9-15.2-33.9-33.9l0-62.1-128 0c-17.7 0-32-14.3-32-32l0-64c0-17.7 14.3-32 32-32l128 0 0-62.1c0-18.7 15.2-33.9 33.9-33.9c9 0 17.6 3.6 24 9.9zM160 96L96 96c-17.7 0-32 14.3-32 32l0 256c0 17.7 14.3 32 32 32l64 0c17.7 0 32 14.3 32 32s-14.3 32-32 32l-64 0c-53 0-96-43-96-96L0 128C0 75 43 32 96 32l64 0c17.7 0 32 14.3 32 32s-14.3 32-32 32z"></path>
                            </svg></div>

                        <div class="text">Logout</div>
                    </button>
                </a>
            </div>
        </nav>

        <div class="welcome-message-wrapper">
            <p class="welcome-message">Welcome, <span class="bold-text"><?php echo ($first_name . " " . $last_name) ?></span></p>
        </div>


        <!-- Active Populations -->
        <div class="active-populations">
            <h2 class="activepop-title">Active Populations</h2>
            <hr>
            <p class="year-label">Fall 2020</p>
            <div class="activepop-programs">
                <?php
                echo '<ol class="activepop-programs-ol">';
                foreach ($courses as $code => $name) {
                    // Generate the list item
                    echo '<li class="activepop-programs-li"><a class="a" href="./populations/2020/msc-' . strtolower($code) . '.php">MSc - ' . $name . ' - F2020 (' . $student_counts_fall_2020[array_search($name, $course_names)] . ' Students) ↗︎</a></li>';
                }
                echo '</ol>';
                ?>
            </div>

            <p class="year-label">Spring 2021</p>
            <div class="activepop-programs">
                <?php
                echo '<ol class="activepop-programs-ol">';
                foreach ($courses as $code => $name) {
                    // Generate the list item
                    echo '<li class="activepop-programs-li"><a class="a" href="./populations/2021/msc-' . strtolower($code) . '.php">MSc - ' . $name . ' - S2021 (' . $student_counts_spring_2021[array_search($name, $course_names)] . ' Students) ↗︎</a></li>';
                }
                echo '</ol>';
                ?>
            </div>

            <!-- Pie Charts -->
            <div class="activepop-chart">
                <canvas id="studentPieChartFall2020" width="650"></canvas>
                <canvas id="studentPieChartSpring2021" width="650"></canvas>
            </div>
        </div>

        <!--  Overall Attendance -->
        <div class="overall-attendance">
            <h2 class="overall-attendance-title">Overall Attendance</h2>
            <hr>
            <p class="year-label">Fall 2020</p>
            <div class="overall-attendance-programs">
                <?php
                echo '<ol class="overall-attendance-programs-ol">';
                foreach ($courses as $code => $name) {
                    echo '<li class="overall-attendance-programs-li">MSc - ' . $name . ' - F2020 (' . $attendance_fall_2020[array_search($name, $course_names)] . '%)</li>';
                }
                echo '</ol>';
                ?>
            </div>
            <div class="overall-attendance-chart">
                <canvas id="attendanceBarChartFall2020" width="650"></canvas>
            </div>

            <p class="year-label">Spring 2021</p>
            <div class="overall-attendance-programs">
                <?php
                echo '<ol class="overall-attendance-programs-ol">';
                foreach ($courses as $code => $name) {
                    echo '<li class="overall-attendance-programs-li">MSc - ' . $name . ' - S2021 (' . $attendance_spring_2021[array_search($name, $course_names)] . '%)</li>';
                }
                echo '</ol>';
                ?>
            </div>
            <div class="overall-attendance-chart">
                <canvas id="attendanceBarChartSpring2021"></canvas>
            </div>
        </div>

        <!-- Construction Date -->
        <div id="constructionDate">
            Website Last Generation: <span id="lastUpdatedDate"></span>
        </div>

        <script src="../scripts/last-construction.js"></script>
        <script>
            // Data for Pie Charts
            const studentCountsFall2020 = <?php echo json_encode($student_counts_fall_2020); ?>;
            const studentCountsSpring2021 = <?php echo json_encode($student_counts_spring_2021); ?>;
            const courseNames = <?php echo json_encode($course_names); ?>;

            // Data for Bar Charts
            const attendanceFall2020 = <?php echo json_encode($attendance_fall_2020); ?>;
            const attendanceSpring2021 = <?php echo json_encode($attendance_spring_2021); ?>;

            // Pie Chart for Fall 2020
            const ctxFall2020 = document.getElementById('studentPieChartFall2020').getContext('2d');
            new Chart(ctxFall2020, {
                type: 'pie',
                data: {
                    labels: courseNames,
                    datasets: [{
                        data: studentCountsFall2020,
                        backgroundColor: ['rgba(255, 99, 132, 0.4)',
                            'rgba(54, 162, 235, 0.4)',
                            'rgba(255, 206, 86, 0.4)',
                            'rgba(75, 192, 192, 0.4)',
                            'rgba(153, 102, 255, 0.4)'
                        ],
                        borderColor: [
                            'rgba(255, 99, 132, 1)',
                            'rgba(54, 162, 235, 1)',
                            'rgba(255, 206, 86, 1)',
                            'rgba(75, 192, 192, 1)',
                            'rgba(153, 102, 255, 1)'
                        ],
                        borderWidth: 1
                    }]
                },
                options: {
                    responsive: true,
                    plugins: {
                        legend: {
                            position: 'top',
                        },
                        title: {
                            display: true,
                            text: 'Student Distribution - Fall 2020'
                        }
                    }
                }
            });

            // Pie Chart for Spring 2021
            const ctxSpring2021 = document.getElementById('studentPieChartSpring2021').getContext('2d');
            new Chart(ctxSpring2021, {
                type: 'pie',
                data: {
                    labels: courseNames,
                    datasets: [{
                        data: studentCountsSpring2021,
                        backgroundColor: ['rgba(255, 99, 132, 0.3)',
                            'rgba(54, 162, 235, 0.3)',
                            'rgba(255, 206, 86, 0.3)',
                            'rgba(75, 192, 192, 0.3)',
                            'rgba(153, 102, 255, 0.3)'
                        ],
                        borderColor: [
                            'rgba(255, 99, 132, 1)',
                            'rgba(54, 162, 235, 1)',
                            'rgba(255, 206, 86, 1)',
                            'rgba(75, 192, 192, 1)',
                            'rgba(153, 102, 255, 1)'
                        ],
                        borderWidth: 1
                    }]
                },
                options: {
                    responsive: true,
                    plugins: {
                        legend: {
                            position: 'top',
                        },
                        title: {
                            display: true,
                            text: 'Student Distribution - Spring 2021'
                        }
                    }
                }
            });

            // Bar Chart for Attendance Fall 2020
            const ctxAttendanceFall2020 = document.getElementById('attendanceBarChartFall2020').getContext('2d');
            new Chart(ctxAttendanceFall2020, {
                type: 'bar',
                data: {
                    labels: courseNames,
                    datasets: [{
                        label: 'Attendance (%)',
                        data: attendanceFall2020,
                        backgroundColor: 'rgba(54, 162, 235, 0.5)',
                        borderColor: 'rgba(54, 162, 235, 1)',
                        borderWidth: 1
                    }]
                },
                options: {
                    responsive: true,
                    plugins: {
                        legend: {
                            display: false
                        },
                        title: {
                            display: true,
                            text: 'Overall Attendance - Fall 2020'
                        }
                    },
                    scales: {
                        y: {
                            beginAtZero: true,
                            max: 100,
                            ticks: {
                                font: {
                                    size: 10 // Smaller font size for y-axis labels
                                }
                            }
                        },
                        x: {
                            ticks: {
                                maxRotation: 0, // Prevent rotation
                                minRotation: 0, // Prevent rotation
                                font: {
                                    size: 9.5, // Smaller font size for x-axis labels
                                }
                            }
                        }
                    }
                }
            });


            // Bar Chart for Attendance Spring 2021
            const ctxAttendanceSpring2021 = document.getElementById('attendanceBarChartSpring2021').getContext('2d');
            new Chart(ctxAttendanceSpring2021, {
                type: 'bar',
                data: {
                    labels: courseNames,
                    datasets: [{
                        label: 'Attendance (%)',
                        data: attendanceSpring2021,
                        backgroundColor: 'rgba(54, 162, 235, 0.5)',
                        borderColor: 'rgba(54, 162, 235, 1)',
                        borderWidth: 1
                    }]
                },
                options: {
                    responsive: true,
                    plugins: {
                        legend: {
                            display: false
                        },
                        title: {
                            display: true,
                            text: 'Overall Attendance - Spring 2021'
                        }
                    },
                    scales: {
                        y: {
                            beginAtZero: true,
                            max: 100,
                            ticks: {
                                font: {
                                    size: 10 // Smaller font size for y-axis labels
                                }
                            }
                        },
                        x: {
                            ticks: {
                                maxRotation: 0, // Prevent rotation
                                minRotation: 0, // Prevent rotation
                                font: {
                                    size: 9.5 // Smaller font size for x-axis labels
                                }
                            }
                        }
                    }
                }
            });
        </script>
    </body>

    </html>

<?php
} else {
    header('Location: ../index.php');
    exit();
}
?>