-- ------------- AIs student count -------------
-- 2020
SELECT COUNT(*) 
            FROM students 
            WHERE student_population_code_ref = 'AIs'
            AND student_population_year_ref = 2020;
-- 2021
SELECT COUNT(*) 
            FROM students 
            WHERE student_population_code_ref = 'AIs'
            AND student_population_year_ref = 2021;

-- ------------- CS student count -------------
-- 2020
SELECT COUNT(*) 
            FROM students 
            WHERE student_population_code_ref = 'CS'
            AND student_population_year_ref = 2020;

-- 2021
SELECT COUNT(*) 
            FROM students 
            WHERE student_population_code_ref = 'CS'
            AND student_population_year_ref = 2021;


-- ------------- DSA student count -------------
-- 2020
SELECT COUNT(*) 
            FROM students 
            WHERE student_population_code_ref = 'DSA'
            AND student_population_year_ref = 2020;

-- 2021
SELECT COUNT(*) 
            FROM students 
            WHERE student_population_code_ref = 'DSA'
            AND student_population_year_ref = 2021;


-- ------------- ISM student count -------------
-- 2020
SELECT COUNT(*) 
            FROM students 
            WHERE student_population_code_ref = 'ISM'
            AND student_population_year_ref = 2020;

-- 2021
SELECT COUNT(*) 
            FROM students 
            WHERE student_population_code_ref = 'ISM'
            AND student_population_year_ref = 2021;


-- ------------- SE student count -------------
-- 2020
SELECT COUNT(*) 
            FROM students 
            WHERE student_population_code_ref = 'SE'
            AND student_population_year_ref = 2020;

-- 2021
SELECT COUNT(*) 
            FROM students 
            WHERE student_population_code_ref = 'SE'
            AND student_population_year_ref = 2021;

