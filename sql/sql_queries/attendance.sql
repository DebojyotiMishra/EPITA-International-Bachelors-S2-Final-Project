-- --------- AIS attendance percentage ---------
-- 2020 attendance percentage for AIS students
SELECT ROUND(
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
WHERE s.student_population_code_ref = 'AIS'
    AND a.attendance_population_year_ref = 2020
GROUP BY s.student_population_code_ref;

-- 2021 attendance percentage for AIS students
SELECT ROUND(
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
WHERE s.student_population_code_ref = 'AIS'
    AND a.attendance_population_year_ref = 2021
GROUP BY s.student_population_code_ref;


-- --------- CS attendance percentage ---------
-- 2020 attendance percentage for CS students
SELECT ROUND(
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
WHERE s.student_population_code_ref = 'CS'
    AND a.attendance_population_year_ref = 2020
GROUP BY s.student_population_code_ref;

-- 2021 attendance percentage for CS students
SELECT ROUND(
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
WHERE s.student_population_code_ref = 'CS'
    AND a.attendance_population_year_ref = 2021
GROUP BY s.student_population_code_ref;


-- --------- DSA attendance percentage ---------
-- 2020 attendance percentage for DSA students
SELECT ROUND(
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
WHERE s.student_population_code_ref = 'DSA'
    AND a.attendance_population_year_ref = 2020
GROUP BY s.student_population_code_ref;

-- 2021 attendance percentage for DSA students
SELECT ROUND(
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
WHERE s.student_population_code_ref = 'DSA'
    AND a.attendance_population_year_ref = 2021
GROUP BY s.student_population_code_ref;


-- --------- ISM attendance percentage ---------
-- 2020 attendance percentage for ISM students
SELECT ROUND(
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
WHERE s.student_population_code_ref = 'ISM'
    AND a.attendance_population_year_ref = 2020
GROUP BY s.student_population_code_ref;

-- 2021 attendance percentage for ISM students
SELECT ROUND(
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
WHERE s.student_population_code_ref = 'ISM'
    AND a.attendance_population_year_ref = 2021
GROUP BY s.student_population_code_ref;


-- --------- SE attendance percentage ---------
-- 2020 attendance percentage for SE students
SELECT ROUND(
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
WHERE s.student_population_code_ref = 'SE'
    AND a.attendance_population_year_ref = 2020
GROUP BY s.student_population_code_ref;

-- 2021 attendance percentage for SE students
SELECT ROUND(
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
WHERE s.student_population_code_ref = 'SE'
    AND a.attendance_population_year_ref = 2021
GROUP BY s.student_population_code_ref;

