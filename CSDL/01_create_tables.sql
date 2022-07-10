/*
    File này được dùng để chứa các lệnh tạo bảng, khóa chính và relationship giữa các bảng
    Cần thực hiện đủ 2 bước
    - DROP TABLE IF EXISTS <tên bảng>;
    - CREATE TABLE <tên bảng>;
    Cần chú thích ngắn gọn về tên bảng và ý nghĩa của từng cột trong bảng
*/
DROP TABLE IF EXISTS DEPARTMENT;
CREATE TABLE DEPARTMENT(
    DEPART_ID INT NOT NULL AUTO_INCREMENT,
    MANAGER_ID INT NOT NULL,
    NAME VARCHAR(255) NOT NULL,
    PHONE VARCHAR(11),
    PRIMARY KEY (DEPART_ID)
);