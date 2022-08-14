Đây là ứng dụng quản lý nhân sự phiên bản ổn định của nhánh master
Có những thay đổi từ đầu đồ án cho tới thời điểm hiện tại là 08:27:00 AM 08/08/2022

Tạo git để dễ track sự thay đổi (git này chỉ có mình mình biết)

1. Folder này phải được cập nhật liên tục khi master của đồ án gốc (đồ án có git có đủ 4 thành viên) có thay đổi.
2. Khi có code mới từ anh Thương hay anh kia, sẽ test ở folder htdocs trước, sau khi test ok xong hết mới đem qua đây.
3. So sánh code ở máy tính local (phiên bản mới sau khi có cập nhật từ bước 2) vs code đã có ở bước 1 trên git (dùng chức năng của visual code) 
để biết có những thay đổi gì để apply cho code đồ án gốc (đồ án có git có đủ 4 thành viên).
4. Sau khi so sánh thấy ok thì push lên lại master cho git hiện tại này, đồng thời push lên nhánh master cho git của code của đồ án gốc (đồ án có git có đủ 4 thành viên).