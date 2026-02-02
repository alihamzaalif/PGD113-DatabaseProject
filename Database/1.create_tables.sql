CREATE TABLE users(
	user_id varchar(15) PRIMARY KEY,
	password varchar(33),
	role varchar(8),
	name varchar(50)
);

CREATE TABLE teachers(
	teacher_id varchar(15) PRIMARY KEY,
	user_id varchar(15),
	CONSTRAINT u_t_fk FOREIGN KEY (user_id) REFERENCES users(user_id)
);

CREATE TABLE students(
	student_id varchar(15) PRIMARY KEY,
	user_id varchar(15),
	batch varchar(11),
	CONSTRAINT u_s_fk FOREIGN KEY (user_id) REFERENCES users(user_id)
);

CREATE TABLE courses(
	course_id varchar(10) PRIMARY KEY,
	course_name varchar(20)
);

CREATE TABLE semester(
	semester_name varchar(20) PRIMARY KEY
);
CREATE TABLE teaches(
	teach_id varchar(10) PRIMARY KEY,
	course_id varchar(10),
	teacher_id varchar(15),
	semester_name varchar(20),
	CONSTRAINT t_t_fk FOREIGN KEY (teacher_id) REFERENCES teachers(teacher_id),
	CONSTRAINT t_c_fk FOREIGN KEY (course_id) REFERENCES courses(course_id),
	CONSTRAINT t_s_fk FOREIGN KEY (semester_name) REFERENCES semester(semester_name)
);

CREATE TABLE enroll(
	student_id varchar(15),
	course_id varchar(10),
	semester_name varchar(20),
	CONSTRAINT s_e_fk FOREIGN KEY (student_id) REFERENCES students(student_id),
	CONSTRAINT c_e_fk FOREIGN KEY (course_id) REFERENCES courses(course_id),
	CONSTRAINT e_s_fk FOREIGN KEY (semester_name) REFERENCES semester(semester_name)
	
);
CREATE TABLE grading_weights(
	teach_id varchar(10) PRIMARY KEY,
	attendance DECIMAL(3,2),
	ct_marks DECIMAL(3,2),
	assignment DECIMAL(3,2),
	midterm DECIMAL(3,2),
	final DECIMAL(3,2),
	CONSTRAINT t_gw_fk FOREIGN KEY (teach_id) REFERENCES teaches(teach_id)
);
CREATE TABLE marks(
	student_id varchar(15),
	teach_id varchar(10),
	attendance DECIMAL(4,2),
	ct_marks DECIMAL(4,2),
	assignment DECIMAL(4,2),
	midterm DECIMAL(4,2),
	final DECIMAL(5,2),
	CONSTRAINT s_m_fk FOREIGN KEY (student_id) REFERENCES students(student_id),
	CONSTRAINT t_m_fk FOREIGN KEY (teach_id) REFERENCES teaches(teach_id)
);
CREATE TABLE grading(
	student_id varchar(15),
	teach_id varchar(10),
	course_id varchar(10),
	total_marks decimal(5,2),
	grade varchar(3),
	gpa DECIMAL(3,2),
	semester_name varchar(20),
	CONSTRAINT s_gd_fk FOREIGN KEY (student_id) REFERENCES students(student_id),
	CONSTRAINT t_gd_fk FOREIGN KEY (teach_id) REFERENCES teaches(teach_id),
	CONSTRAINT c_gd_fk FOREIGN KEY (course_id) REFERENCES courses(course_id),
	CONSTRAINT g_s_fk FOREIGN KEY (semester_name) REFERENCES semester(semester_name)
);
