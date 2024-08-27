-- ------------- AIS Student Population -------------
-- 2020
SELECT s.student_epita_email AS email,
    c.contact_first_name AS first_name,
    c.contact_last_name AS last_name,
    CONCAT(
        COALESCE(passed_classes.passed_count, 0),
        '/',
        COALESCE(total_classes.total_count, 0)
    ) AS passed_classes_over_total
FROM students s
    JOIN contacts c ON s.student_contact_ref = c.contact_email
    LEFT JOIN (
        SELECT grade_student_epita_email_ref,
            COUNT(*) AS passed_count
        FROM (
                SELECT grade_student_epita_email_ref,
                    grade_course_code_ref,
                    AVG(grade_score) AS avg_grade
                FROM grades
                GROUP BY grade_student_epita_email_ref,
                    grade_course_code_ref
            ) AS avg_grades
        WHERE avg_grade >= 10
        GROUP BY grade_student_epita_email_ref
    ) AS passed_classes ON s.student_epita_email = passed_classes.grade_student_epita_email_ref
    LEFT JOIN (
        SELECT grade_student_epita_email_ref,
            COUNT(*) AS total_count
        FROM (
                SELECT grade_student_epita_email_ref,
                    grade_course_code_ref
                FROM grades
                GROUP BY grade_student_epita_email_ref,
                    grade_course_code_ref
            ) AS distinct_courses
        GROUP BY grade_student_epita_email_ref
    ) AS total_classes ON s.student_epita_email = total_classes.grade_student_epita_email_ref
WHERE s.student_population_code_ref = 'AIs'
    AND student_population_year_ref = '2020' 
    

-- 2021
SELECT s.student_epita_email AS email,
    c.contact_first_name AS first_name,
    c.contact_last_name AS last_name,
    CONCAT(
        COALESCE(passed_classes.passed_count, 0),
        '/',
        COALESCE(total_classes.total_count, 0)
    ) AS passed_classes_over_total
FROM students s
    JOIN contacts c ON s.student_contact_ref = c.contact_email
    LEFT JOIN (
        SELECT grade_student_epita_email_ref,
            COUNT(*) AS passed_count
        FROM (
                SELECT grade_student_epita_email_ref,
                    grade_course_code_ref,
                    AVG(grade_score) AS avg_grade
                FROM grades
                GROUP BY grade_student_epita_email_ref,
                    grade_course_code_ref
            ) AS avg_grades
        WHERE avg_grade >= 10
        GROUP BY grade_student_epita_email_ref
    ) AS passed_classes ON s.student_epita_email = passed_classes.grade_student_epita_email_ref
    LEFT JOIN (
        SELECT grade_student_epita_email_ref,
            COUNT(*) AS total_count
        FROM (
                SELECT grade_student_epita_email_ref,
                    grade_course_code_ref
                FROM grades
                GROUP BY grade_student_epita_email_ref,
                    grade_course_code_ref
            ) AS distinct_courses
        GROUP BY grade_student_epita_email_ref
    ) AS total_classes ON s.student_epita_email = total_classes.grade_student_epita_email_ref
WHERE s.student_population_code_ref = 'AIs'
    AND student_population_year_ref = '2021'


-- ------------- CS Student Population -------------
-- 2020
SELECT s.student_epita_email AS email,
    c.contact_first_name AS first_name,
    c.contact_last_name AS last_name,
    CONCAT(
        COALESCE(passed_classes.passed_count, 0),
        '/',
        COALESCE(total_classes.total_count, 0)
    ) AS passed_classes_over_total
FROM students s
    JOIN contacts c ON s.student_contact_ref = c.contact_email
    LEFT JOIN (
        SELECT grade_student_epita_email_ref,
            COUNT(*) AS passed_count
        FROM (
                SELECT grade_student_epita_email_ref,
                    grade_course_code_ref,
                    AVG(grade_score) AS avg_grade
                FROM grades
                GROUP BY grade_student_epita_email_ref,
                    grade_course_code_ref
            ) AS avg_grades
        WHERE avg_grade >= 10
        GROUP BY grade_student_epita_email_ref
    ) AS passed_classes ON s.student_epita_email = passed_classes.grade_student_epita_email_ref
    LEFT JOIN (
        SELECT grade_student_epita_email_ref,
            COUNT(*) AS total_count
        FROM (
                SELECT grade_student_epita_email_ref,
                    grade_course_code_ref
                FROM grades
                GROUP BY grade_student_epita_email_ref,
                    grade_course_code_ref
            ) AS distinct_courses
        GROUP BY grade_student_epita_email_ref
    ) AS total_classes ON s.student_epita_email = total_classes.grade_student_epita_email_ref
WHERE s.student_population_code_ref = 'CS'
    AND student_population_year_ref = '2020'


-- 2021
SELECT s.student_epita_email AS email,
    c.contact_first_name AS first_name,
    c.contact_last_name AS last_name,
    CONCAT(
        COALESCE(passed_classes.passed_count, 0),
        '/',
        COALESCE(total_classes.total_count, 0)
    ) AS passed_classes_over_total
FROM students s
    JOIN contacts c ON s.student_contact_ref = c.contact_email
    LEFT JOIN (
        SELECT grade_student_epita_email_ref,
            COUNT(*) AS passed_count
        FROM (
                SELECT grade_student_epita_email_ref,
                    grade_course_code_ref,
                    AVG(grade_score) AS avg_grade
                FROM grades
                GROUP BY grade_student_epita_email_ref,
                    grade_course_code_ref
            ) AS avg_grades
        WHERE avg_grade >= 10
        GROUP BY grade_student_epita_email_ref
    ) AS passed_classes ON s.student_epita_email = passed_classes.grade_student_epita_email_ref
    LEFT JOIN (
        SELECT grade_student_epita_email_ref,
            COUNT(*) AS total_count
        FROM (
                SELECT grade_student_epita_email_ref,
                    grade_course_code_ref
                FROM grades
                GROUP BY grade_student_epita_email_ref,
                    grade_course_code_ref
            ) AS distinct_courses
        GROUP BY grade_student_epita_email_ref
    ) AS total_classes ON s.student_epita_email = total_classes.grade_student_epita_email_ref
WHERE s.student_population_code_ref = 'CS'
    AND student_population_year_ref = '2021'


-- ------------- DSA Student Population -------------
-- 2020
SELECT s.student_epita_email AS email,
    c.contact_first_name AS first_name,
    c.contact_last_name AS last_name,
    CONCAT(
        COALESCE(passed_classes.passed_count, 0),
        '/',
        COALESCE(total_classes.total_count, 0)
    ) AS passed_classes_over_total
FROM students s
    JOIN contacts c ON s.student_contact_ref = c.contact_email
    LEFT JOIN (
        SELECT grade_student_epita_email_ref,
            COUNT(*) AS passed_count
        FROM (
                SELECT grade_student_epita_email_ref,
                    grade_course_code_ref,
                    AVG(grade_score) AS avg_grade
                FROM grades
                GROUP BY grade_student_epita_email_ref,
                    grade_course_code_ref
            ) AS avg_grades
        WHERE avg_grade >= 10
        GROUP BY grade_student_epita_email_ref
    ) AS passed_classes ON s.student_epita_email = passed_classes.grade_student_epita_email_ref
    LEFT JOIN (
        SELECT grade_student_epita_email_ref,
            COUNT(*) AS total_count
        FROM (
                SELECT grade_student_epita_email_ref,
                    grade_course_code_ref
                FROM grades
                GROUP BY grade_student_epita_email_ref,
                    grade_course_code_ref
            ) AS distinct_courses
        GROUP BY grade_student_epita_email_ref
    ) AS total_classes ON s.student_epita_email = total_classes.grade_student_epita_email_ref
WHERE s.student_population_code_ref = 'DSA'
    AND student_population_year_ref = '2020'


-- 2021
SELECT s.student_epita_email AS email,
    c.contact_first_name AS first_name,
    c.contact_last_name AS last_name,
    CONCAT(
        COALESCE(passed_classes.passed_count, 0),
        '/',
        COALESCE(total_classes.total_count, 0)
    ) AS passed_classes_over_total
FROM students s
    JOIN contacts c ON s.student_contact_ref = c.contact_email
    LEFT JOIN (
        SELECT grade_student_epita_email_ref,
            COUNT(*) AS passed_count
        FROM (
                SELECT grade_student_epita_email_ref,
                    grade_course_code_ref,
                    AVG(grade_score) AS avg_grade
                FROM grades
                GROUP BY grade_student_epita_email_ref,
                    grade_course_code_ref
            ) AS avg_grades
        WHERE avg_grade >= 10
        GROUP BY grade_student_epita_email_ref
    ) AS passed_classes ON s.student_epita_email = passed_classes.grade_student_epita_email_ref
    LEFT JOIN (
        SELECT grade_student_epita_email_ref,
            COUNT(*) AS total_count
        FROM (
                SELECT grade_student_epita_email_ref,
                    grade_course_code_ref
                FROM grades
                GROUP BY grade_student_epita_email_ref,
                    grade_course_code_ref
            ) AS distinct_courses
        GROUP BY grade_student_epita_email_ref
    ) AS total_classes ON s.student_epita_email = total_classes.grade_student_epita_email_ref
WHERE s.student_population_code_ref = 'DSA'
    AND student_population_year_ref = '2021'


-- ------------- ISM Student Population -------------
-- 2020
SELECT s.student_epita_email AS email,
    c.contact_first_name AS first_name,
    c.contact_last_name AS last_name,
    CONCAT(
        COALESCE(passed_classes.passed_count, 0),
        '/',
        COALESCE(total_classes.total_count, 0)
    ) AS passed_classes_over_total
FROM students s
    JOIN contacts c ON s.student_contact_ref = c.contact_email
    LEFT JOIN (
        SELECT grade_student_epita_email_ref,
            COUNT(*) AS passed_count
        FROM (
                SELECT grade_student_epita_email_ref,
                    grade_course_code_ref,
                    AVG(grade_score) AS avg_grade
                FROM grades
                GROUP BY grade_student_epita_email_ref,
                    grade_course_code_ref
            ) AS avg_grades
        WHERE avg_grade >= 10
        GROUP BY grade_student_epita_email_ref
    ) AS passed_classes ON s.student_epita_email = passed_classes.grade_student_epita_email_ref
    LEFT JOIN (
        SELECT grade_student_epita_email_ref,
            COUNT(*) AS total_count
        FROM (
                SELECT grade_student_epita_email_ref,
                    grade_course_code_ref
                FROM grades
                GROUP BY grade_student_epita_email_ref,
                    grade_course_code_ref
            ) AS distinct_courses
        GROUP BY grade_student_epita_email_ref
    ) AS total_classes ON s.student_epita_email = total_classes.grade_student_epita_email_ref
WHERE s.student_population_code_ref = 'ISM'
    AND student_population_year_ref = '2020'


-- 2021
SELECT s.student_epita_email AS email,
    c.contact_first_name AS first_name,
    c.contact_last_name AS last_name,
    CONCAT(
        COALESCE(passed_classes.passed_count, 0),
        '/',
        COALESCE(total_classes.total_count, 0)
    ) AS passed_classes_over_total
FROM students s
    JOIN contacts c ON s.student_contact_ref = c.contact_email
    LEFT JOIN (
        SELECT grade_student_epita_email_ref,
            COUNT(*) AS passed_count
        FROM (
                SELECT grade_student_epita_email_ref,
                    grade_course_code_ref,
                    AVG(grade_score) AS avg_grade
                FROM grades
                GROUP BY grade_student_epita_email_ref,
                    grade_course_code_ref
            ) AS avg_grades
        WHERE avg_grade >= 10
        GROUP BY grade_student_epita_email_ref
    ) AS passed_classes ON s.student_epita_email = passed_classes.grade_student_epita_email_ref
    LEFT JOIN (
        SELECT grade_student_epita_email_ref,
            COUNT(*) AS total_count
        FROM (
                SELECT grade_student_epita_email_ref,
                    grade_course_code_ref
                FROM grades
                GROUP BY grade_student_epita_email_ref,
                    grade_course_code_ref
            ) AS distinct_courses
        GROUP BY grade_student_epita_email_ref
    ) AS total_classes ON s.student_epita_email = total_classes.grade_student_epita_email_ref
WHERE s.student_population_code_ref = 'ISM'
    AND student_population_year_ref = '2021'


-- ------------- SE Student Population -------------
-- 2020
SELECT s.student_epita_email AS email,
    c.contact_first_name AS first_name,
    c.contact_last_name AS last_name,
    CONCAT(
        COALESCE(passed_classes.passed_count, 0),
        '/',
        COALESCE(total_classes.total_count, 0)
    ) AS passed_classes_over_total
FROM students s
    JOIN contacts c ON s.student_contact_ref = c.contact_email
    LEFT JOIN (
        SELECT grade_student_epita_email_ref,
            COUNT(*) AS passed_count
        FROM (
                SELECT grade_student_epita_email_ref,
                    grade_course_code_ref,
                    AVG(grade_score) AS avg_grade
                FROM grades
                GROUP BY grade_student_epita_email_ref,
                    grade_course_code_ref
            ) AS avg_grades
        WHERE avg_grade >= 10
        GROUP BY grade_student_epita_email_ref
    ) AS passed_classes ON s.student_epita_email = passed_classes.grade_student_epita_email_ref
    LEFT JOIN (
        SELECT grade_student_epita_email_ref,
            COUNT(*) AS total_count
        FROM (
                SELECT grade_student_epita_email_ref,
                    grade_course_code_ref
                FROM grades
                GROUP BY grade_student_epita_email_ref,
                    grade_course_code_ref
            ) AS distinct_courses
        GROUP BY grade_student_epita_email_ref
    ) AS total_classes ON s.student_epita_email = total_classes.grade_student_epita_email_ref
WHERE s.student_population_code_ref = 'SE'
    AND student_population_year_ref = '2020'


-- 2021
SELECT s.student_epita_email AS email,
    c.contact_first_name AS first_name,
    c.contact_last_name AS last_name,
    CONCAT(
        COALESCE(passed_classes.passed_count, 0),
        '/',
        COALESCE(total_classes.total_count, 0)
    ) AS passed_classes_over_total
FROM students s
    JOIN contacts c ON s.student_contact_ref = c.contact_email
    LEFT JOIN (
        SELECT grade_student_epita_email_ref,
            COUNT(*) AS passed_count
        FROM (
                SELECT grade_student_epita_email_ref,
                    grade_course_code_ref,
                    AVG(grade_score) AS avg_grade
                FROM grades
                GROUP BY grade_student_epita_email_ref,
                    grade_course_code_ref
            ) AS avg_grades
        WHERE avg_grade >= 10
        GROUP BY grade_student_epita_email_ref
    ) AS passed_classes ON s.student_epita_email = passed_classes.grade_student_epita_email_ref
    LEFT JOIN (
        SELECT grade_student_epita_email_ref,
            COUNT(*) AS total_count
        FROM (
                SELECT grade_student_epita_email_ref,
                    grade_course_code_ref
                FROM grades
                GROUP BY grade_student_epita_email_ref,
                    grade_course_code_ref
            ) AS distinct_courses
        GROUP BY grade_student_epita_email_ref
    ) AS total_classes ON s.student_epita_email = total_classes.grade_student_epita_email_ref
WHERE s.student_population_code_ref = 'SE'
    AND student_population_year_ref = '2021'

