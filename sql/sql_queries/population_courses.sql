-- --------- AIs Courses ---------
SELECT 
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
        p.program_assignment = 'AIs';


-- --------- CS Courses ---------
SELECT 
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
        p.program_assignment = 'CS';


-- --------- DSA Courses ---------
SELECT 
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
        p.program_assignment = 'DSA';


-- --------- ISM Courses ---------
SELECT 
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
        p.program_assignment = 'ISM';


-- --------- SE Courses ---------
SELECT 
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
        p.program_assignment = 'SE';
