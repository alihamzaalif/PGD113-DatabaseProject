-- These are dummy AI Generated Data. I will be testing with
-- real data once I am done creating the frontend. 
-- I didn't want to use AI on this project. 
-- But it's 3:34AM, had 3 cigarretes since 11:00AM, 
-- a cup of coffee and an egg with two breads.

-- Users Table
INSERT INTO users (user_id, password, role, name) VALUES
('admin', 'admin', 'admin', 'System Administrator'),
('T001', '1234', 'teacher', 'Dr. Alan Turing'),
('T002', '1234', 'teacher', 'Prof. Ada Lovelace'),
('S001', '1234', 'student', 'John Doe'),
('S002', '1234', 'student', 'Jane Smith'),
('S003', '1234', 'student', 'Robert Brown');

-- Teachers Table
INSERT INTO teachers (teacher_id, user_id) VALUES
('TEA_01', 'T001'),
('TEA_02', 'T002');

-- Students Table
INSERT INTO students (student_id, user_id, batch) VALUES
('STU_01', 'S001', 'Batch-2024'),
('STU_02', 'S002', 'Batch-2024'),
('STU_03', 'S003', 'Batch-2023');

-- Courses Table
INSERT INTO courses (course_id, course_name) VALUES
('CS101', 'Intro to CS'),
('CS102', 'Data Structures'),
('MATH201', 'Calculus I');

-- Semester Table
INSERT INTO semester (semester_name) VALUES
('Spring 2024'),
('Fall 2024');

-- Teaches Table (Linking Teachers to Courses and Semesters)
INSERT INTO teaches (teach_id, course_id, teacher_id, semester_name) VALUES
('TCH_01', 'CS101', 'TEA_01', 'Spring 2024'),
('TCH_02', 'CS102', 'TEA_02', 'Spring 2024'),
('TCH_03', 'MATH201', 'TEA_01', 'Fall 2024');

-- Enroll Table
INSERT INTO enroll (student_id, course_id, semester_name) VALUES
('STU_01', 'CS101', 'Spring 2024'),
('STU_02', 'CS101', 'Spring 2024'),
('STU_03', 'CS102', 'Spring 2024');

-- Grading Weights Table (Using Decimals as requested)
INSERT INTO grading_weights (teach_id, attendance, ct_marks, assignment, midterm, final) VALUES
('TCH_01', 0.10, 0.20, 0.10, 0.20, 0.40),
('TCH_02', 0.05, 0.15, 0.20, 0.20, 0.40);

-- Marks Table
INSERT INTO marks (student_id, teach_id, attendance, ct_marks, assignment, midterm, final) VALUES
('STU_01', 'TCH_01', 10.00, 18.50, 9.00, 15.00, 35.00),
('STU_02', 'TCH_01', 8.00, 14.00, 7.50, 12.00, 28.00);

-- Grading Table (Final Calculated Results)
INSERT INTO grading (student_id, teach_id, course_id, total_marks, grade, gpa, semester_name) VALUES
('STU_01', 'TCH_01', 'CS101', 87.50, 'A', 4.00, 'Spring 2024'),
('STU_02', 'TCH_01', 'CS101', 69.50, 'B', 3.00, 'Spring 2024');