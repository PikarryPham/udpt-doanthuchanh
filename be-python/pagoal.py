
from flask import Flask, jsonify, request
from datetime import datetime
from flask_mysqldb import MySQL
import smtplib
import ssl
from email.message import EmailMessage
from flask_cors import CORS

mysql = MySQL()
app = Flask(__name__)

# MySQL configurations
app.config['MYSQL_USER'] = 'root'
app.config['MYSQL_PASSWORD'] = ''
app.config['MYSQL_DB'] = 'my_pa_goal'
app.config['MYSQL_HOST'] = 'localhost'

#Example call API: http://127.0.0.1:3131/api/uc0131_132/get-pa-goals

mysql.init_app(app)

CORS(app)

@app.route('/api/uc0131_132/get-pa-goals', methods=['POST', 'GET'])
def get_pa_goals():
    """
    Example req body
    {
        "page":0,
        "limit":1,
        "employee_id":"8",
        "status":["Approved","Rejected"],
        "last_update":"2022",
        "deadline":"2021"
    }
    nếu  "status":[] => status = “All” khi filter
    """
    conn = mysql.connection
    cursor = conn.cursor()

    body_request = request.get_json()

    page = 0  # Page = 0 --> trang 1, Page =1 --> trang 2
    limit = 5  # moi trang mac dinh co 5 record

    try:
        page = body_request["page"]
    except:
        print("page not found")

    try:
        limit = body_request["limit"]
    except:
        print("limit not found")

    offset = page*limit

    employee_id = ""
    try:
        employee_id = body_request["employee_id"]
    except:
        return "employee id not found", 500

    last_update = "'1970-01-01 00:00:00'"
    try:
        last_update = body_request["last_update"]
        # last_update = last_update + "-01-01 00:00:00"
        last_update = str(last_update)
        last_update = f"'{last_update}'"
        print(last_update)
    except:
        print("last update not found")

    deadline = "'1970-01-01 00:00:00'"
    try:
        deadline = body_request["deadline"]
        # deadline = deadline + "-01-01 00:00:00"
        deadline = str(deadline)
        deadline = f"'{deadline}'"
        print(deadline)
    except:
        print("deadline not found")

    status = []
    try:
        status = body_request["status"]
    except:
        print("status not found")

    for i in range(0, len(status)):
        status[i] = f"'{status[i]}'"

    # get the record
    #print(len(status))
    print(deadline)
    print(last_update)
    try:
    # neu truyen vao ca deadline vs last_update
        if(len(status) != 0 and deadline != "'1970-01-01 00:00:00'" and last_update != "'1970-01-01 00:00:00'"):
            query_string = "SELECT * FROM pa_goal "+" WHERE STATUS IN (" + ",".join(
                status) + ")" + f" AND EMPLOYEECREATE_ID = {employee_id}" + f" AND YEAR(LASTUPDATE_DATE) = {last_update}" + f" AND YEAR(DEADLINE_PAGOAL) = {deadline}" + f" ORDER BY LASTUPDATE_DATE DESC LIMIT {offset},{limit}"
            #print(query_string)
        # neu chi truyen vao last_update
        elif (len(status) != 0 and deadline == "'1970-01-01 00:00:00'" and last_update != "'1970-01-01 00:00:00'"):
            query_string = "SELECT * FROM pa_goal "+" WHERE STATUS IN (" + ",".join(
                status) + ")" + f" AND EMPLOYEECREATE_ID = {employee_id}" + f" AND YEAR(LASTUPDATE_DATE) = {last_update}" + f" AND DEADLINE_PAGOAL >= {deadline}" + f" ORDER BY LASTUPDATE_DATE DESC LIMIT {offset},{limit}"
            #print(query_string)
        elif (len(status) != 0 and deadline != "'1970-01-01 00:00:00'" and last_update == "'1970-01-01 00:00:00'"):  # neu chi truyen vao deadline
            query_string = "SELECT * FROM pa_goal "+" WHERE STATUS IN (" + ",".join(
                status) + ")" + f" AND EMPLOYEECREATE_ID = {employee_id}" + f" AND LASTUPDATE_DATE >= {last_update}" + f" AND YEAR(DEADLINE_PAGOAL) = {deadline}" + f" ORDER BY LASTUPDATE_DATE DESC LIMIT {offset},{limit}"
            #print(query_string)
        elif (len(status) != 0 and deadline == "'1970-01-01 00:00:00'" and last_update == "'1970-01-01 00:00:00'"):
            query_string = "SELECT * FROM pa_goal "+" WHERE STATUS IN (" + ",".join(
                status) + ")" + f" AND EMPLOYEECREATE_ID = {employee_id}" + f" AND LASTUPDATE_DATE >= {last_update}" + f" AND DEADLINE_PAGOAL >= {deadline}" + f" ORDER BY LASTUPDATE_DATE DESC LIMIT {offset},{limit}"
            #print(query_string)
        elif (len(status) == 0 and deadline != "'1970-01-01 00:00:00'" and last_update != "'1970-01-01 00:00:00'"):
            # neu truyen vao ca deadline vs last_update và không truyền vào status (tức status == all)
            query_string = "SELECT * FROM pa_goal " + \
                    f" WHERE EMPLOYEECREATE_ID = {employee_id}" + f" AND YEAR(LASTUPDATE_DATE) = {last_update}" + \
                    f" AND YEAR(DEADLINE_PAGOAL) = {deadline}" + \
                    f" ORDER BY LASTUPDATE_DATE DESC" + \
                    f" LIMIT {offset},{limit}"
        elif (len(status) == 0 and deadline == "'1970-01-01 00:00:00'" and last_update != "'1970-01-01 00:00:00'"):  # neu chi truyen vao last_update
                query_string = "SELECT * FROM pa_goal " + \
                    f" WHERE EMPLOYEECREATE_ID = {employee_id}" + f" AND YEAR(LASTUPDATE_DATE) = {last_update}" + \
                    f" AND DEADLINE_PAGOAL >= {deadline}" + \
                    f" ORDER BY LASTUPDATE_DATE DESC" + \
                    f" LIMIT {offset},{limit}"
        elif (len(status) == 0 and deadline != "'1970-01-01 00:00:00'" and last_update == "'1970-01-01 00:00:00'"):  # neu chi truyen vao deadline
                query_string = "SELECT * FROM pa_goal " + \
                    f" WHERE EMPLOYEECREATE_ID = {employee_id}" + f" AND LASTUPDATE_DATE >= {last_update}" + \
                    f" AND YEAR(DEADLINE_PAGOAL) = {deadline}" + \
                    f" ORDER BY LASTUPDATE_DATE DESC" + \
                    f" LIMIT {offset},{limit}"
        else:
                query_string = "SELECT * FROM pa_goal " + \
                    f" WHERE EMPLOYEECREATE_ID = {employee_id}" + f" AND LASTUPDATE_DATE >= {last_update}" + \
                    f" AND DEADLINE_PAGOAL >= {deadline}" + \
                    f" ORDER BY LASTUPDATE_DATE DESC" + \
                    f" LIMIT {offset},{limit}"
    except:
        return "Status is not the array", 500

    print(len(status))
    print(query_string)
    cursor.execute(query_string)

    row_headers = [x[0] for x in cursor.description]
    data = cursor.fetchall()
    json_data = []
    for result in data:
        json_data.append(dict(zip(row_headers, result)))

    # get the number of total record
    try:
        if(len(status) != 0 and deadline != "'1970-01-01 00:00:00'" and last_update != "'1970-01-01 00:00:00'"):
            query_string = "SELECT COUNT(*) FROM pa_goal "+" WHERE STATUS IN (" + ",".join(
                status) + ")" + f" AND EMPLOYEECREATE_ID = {employee_id}" + f" AND YEAR(LASTUPDATE_DATE) = {last_update}" + f" AND YEAR(DEADLINE_PAGOAL) = {deadline}" + f" ORDER BY LASTUPDATE_DATE DESC"
            #print(query_string)
        # neu chi truyen vao last_update
        elif (len(status) != 0 and deadline == "'1970-01-01 00:00:00'" and last_update != "'1970-01-01 00:00:00'"):
            query_string = "SELECT COUNT(*) FROM pa_goal "+" WHERE STATUS IN (" + ",".join(
                status) + ")" + f" AND EMPLOYEECREATE_ID = {employee_id}" + f" AND YEAR(LASTUPDATE_DATE) = {last_update}" + f" AND DEADLINE_PAGOAL >= {deadline}" + f" ORDER BY LASTUPDATE_DATE DESC"
            #print(query_string)
        elif (len(status) != 0 and deadline != "'1970-01-01 00:00:00'" and last_update == "'1970-01-01 00:00:00'"):  # neu chi truyen vao deadline
            query_string = "SELECT COUNT(*) FROM pa_goal "+" WHERE STATUS IN (" + ",".join(
                status) + ")" + f" AND EMPLOYEECREATE_ID = {employee_id}" + f" AND LASTUPDATE_DATE >= {last_update}" + f" AND YEAR(DEADLINE_PAGOAL) = {deadline}" + f" ORDER BY LASTUPDATE_DATE DESC"
            #print(query_string)
        elif (len(status) != 0 and deadline == "'1970-01-01 00:00:00'" and last_update == "'1970-01-01 00:00:00'"):  
            # nếu không truyền vào cả deadline và last_update
            query_string = "SELECT COUNT(*) FROM pa_goal "+" WHERE STATUS IN (" + ",".join(
                status) + ")" + f" AND EMPLOYEECREATE_ID = {employee_id}" + f" AND LASTUPDATE_DATE >= {last_update}" + f" AND DEADLINE_PAGOAL >= {deadline}" + f" ORDER BY LASTUPDATE_DATE DESC"
        elif (len(status) == 0 and deadline != "'1970-01-01 00:00:00'" and last_update != "'1970-01-01 00:00:00'"): # neu truyen vao ca deadline vs last_update và không truyền vào status (tức status == all)
                query_string = "SELECT COUNT(*) FROM pa_goal " + \
                    f" WHERE EMPLOYEECREATE_ID = {employee_id}" + f" AND YEAR(LASTUPDATE_DATE) = {last_update}" + \
                    f" AND YEAR(DEADLINE_PAGOAL) = {deadline}" + \
                    f" ORDER BY LASTUPDATE_DATE DESC"
        elif (len(status) == 0 and deadline == "'1970-01-01 00:00:00'" and last_update != "'1970-01-01 00:00:00'"):  # neu chi truyen vao last_update
                query_string = "SELECT COUNT(*) FROM pa_goal " + \
                    f" WHERE EMPLOYEECREATE_ID = {employee_id}" + f" AND YEAR(LASTUPDATE_DATE) = {last_update}" + \
                    f" AND DEADLINE_PAGOAL >= {deadline}" + \
                    f" ORDER BY LASTUPDATE_DATE DESC"
        elif (len(status) == 0 and deadline != "'1970-01-01 00:00:00'" and last_update == "'1970-01-01 00:00:00'"):  # neu chi truyen vao deadline
                query_string = "SELECT COUNT(*) FROM pa_goal " + \
                    f" WHERE EMPLOYEECREATE_ID = {employee_id}" + f" AND LASTUPDATE_DATE >= {last_update}" + \
                    f" AND YEAR(DEADLINE_PAGOAL) = {deadline}" + \
                    f" ORDER BY LASTUPDATE_DATE DESC"
        else:
                query_string = "SELECT COUNT(*) FROM pa_goal " + \
                    f" WHERE EMPLOYEECREATE_ID = {employee_id}" + f" AND LASTUPDATE_DATE >= {last_update}" + \
                    f" AND DEADLINE_PAGOAL >= {deadline}" + \
                    f" ORDER BY LASTUPDATE_DATE DESC"
    except:
        return "System error", 500

    cursor.execute(query_string)
    total = int(cursor.fetchall()[0][0])

    #getManagerEmail = "SELECT employee.EMAIL FROM employee WHERE employee.EMPLOYEE_ID IN (SELECT employee.MANAGER_ID FROM employee" + f" WHERE employee.EMPLOYEE_ID = {employee_id}" + ")"

    # cursor.execute(getManagerEmail)
    cursor.close()

    return jsonify({
        "total_records": total,
        "data": json_data,
    })


@app.route('/api/uc0131_132/unsubmit', methods=['POST', 'PATCH'])
def unsubmit():
    """
    Example req body
    {
        {
            "reason":"abc deft",
            "pa_goal_id":"2"
        }
    }
    """
    conn = mysql.connection
    cursor = conn.cursor()

    body_request = request.get_json()

    reason = ""
    pa_goal_id = ""
    date = datetime.now()

    try:
        # Kiểm tra đã qua thời gian chỉnh sửa/quản lý đã phê duyệt chưa/Form đã có trạng thái là Cancelled hay không
        reason = body_request["reason"]
    except:
        return "Reason not found", 400

    try:
        pa_goal_id = body_request["pa_goal_id"]
    except:
        return "pa goal id not found", 400
    
    try:
        cursor.execute('UPDATE pa_goal SET LASTUPDATE_DATE = %s, UNSUBMIT_REASON = %s, STATUS = %s  WHERE PAGOAL_ID = %s',
                       (date, reason, "Cancelled", pa_goal_id))
        conn.commit()
        return "OK", 200

    except:
        return "System error", 500


@app.route('/api/uc0131_132/reject', methods=['POST', 'PATCH'])
def reject():
    """
    Example req body
    {
        {
             "comment":"abc1",
             "pa_goal_id":"2"
        }
    }
    """
    conn = mysql.connection
    cursor = conn.cursor()

    body_request = request.get_json()

    comment = ""
    pa_goal_id = ""
    date = datetime.now()

    try:
        comment = body_request["comment"]
    except:
        return "Comment not found", 400

    try:
        pa_goal_id = body_request["pa_goal_id"]
    except:
        return "pa goal id not found", 400
    try:
        #cursor.execute("SELECT status from pa_goal WHERE PAGOAL_ID = %s")
        #getCurrentStatus = cursor.fetchall()
        # print(getCurrentStatus)
        cursor.execute('UPDATE pa_goal SET LASTUPDATE_DATE = %s, MANAGER_COMMENT = %s, STATUS = %s  WHERE PAGOAL_ID = %s',
                       (date, comment, "Rejected", pa_goal_id))
        conn.commit()
        return "OK", 200

    except:
        return "System error", 500


@app.route('/api/uc0131_132/change-status', methods=['POST', 'PATCH'])
def change_status():
    """
    Example req body
    {
        {
             "status":"Rejected",
             "pa_goal_id":"2"
        }
    }
    """
    conn = mysql.connection
    cursor = conn.cursor()

    body_request = request.get_json()

    status = ""
    pa_goal_id = ""
    date = datetime.now()

    try:
        status = body_request["status"]
    except:
        return "Status not found", 400

    try:
        pa_goal_id = body_request["pa_goal_id"]
    except:
        return "pa goal id not found", 400

    try:
        cursor.execute('UPDATE pa_goal SET LASTUPDATE_DATE = %s, STATUS = %s WHERE PAGOAL_ID = %s',
                       (date, status, pa_goal_id))
        conn.commit()
        return "OK", 200

    except:
        return "System error", 500


@app.route('/api/uc0131_132/get-pa-goal', methods=['POST', 'GET'])
def get_pa_goal():
    """
    Example req body
    {
        {
             "pa_goal_id":"2"
        }
    }
    """
    conn = mysql.connection
    cursor = conn.cursor()

    body_request = request.get_json()

    pa_goal_id = ""
    date = datetime.now()

    try:
        pa_goal_id = body_request["pa_goal_id"]
    except:
        return "pa goal id not found", 400

    cursor.execute('SELECT pa_goal.EMPLOYEECREATE_ID,pa_goal.MANAGER_ID,pa_goal.LASTUPDATE_DATE , pa_goal_detail.* from pa_goal JOIN pa_goal_detail ON pa_goal.PAGOAL_ID = pa_goal_detail.PAGOAL_ID WHERE pa_goal.PAGOAL_ID = %s',
                   (pa_goal_id))

    row_headers = [x[0] for x in cursor.description]
    data = cursor.fetchall()
    json_data = []
    for result in data:
        json_data.append(dict(zip(row_headers, result)))

    return jsonify({
        "data": json_data,
    })


@app.route('/api/uc0131_132/add-goal', methods=['POST'])
def add_goal():
    """
    Example req body
    {
        {
            "pa_goal_id":"2",
            "due_date":"2022-12-01 00:00:00",
            "name":"Trang Pham",
            "action":"Làm bài tập",
            "comment":"Không có ưu tiên cao"
        }
    }
    """
    conn = mysql.connection
    cursor = conn.cursor()

    body_request = request.get_json()

    pa_goal_id = ""
    try:
        pa_goal_id = body_request["pa_goal_id"]
    except:
        return "pa goal id not found", 400

    due_date = ""
    try:
        due_date = body_request["due_date"]
    except:
        return "dua date not found", 400

    complete_date = "1970-01-01 00:00:00"
    try:
        complete_date = body_request["complete_date"]
    except:
        print("complete date not found")

    status = "Processing"
    try:
        status = body_request["status"]
    except:
        print("status not found")

    name = ""
    action = ""
    comment = ""
    try:
        name = body_request["name"]
        action = body_request["action"]
        comment = body_request["comment"]
    except:
        return "name, action and comment is required", 400

    query_string = "SELECT DEADLINE_PAGOAL FROM pa_goal " + \
        f" WHERE PAGOAL_ID = {pa_goal_id}"
    # print(query_string)
    cursor.execute(query_string)
    data = cursor.fetchall()
    dl_pagoal = data[0][0]
    print(dl_pagoal)
    
    query_string_status = "SELECT STATUS FROM pa_goal " + \
        f" WHERE PAGOAL_ID = {pa_goal_id}"
    cursor.execute(query_string_status)
    data_status = cursor.fetchall()
    status_pagoal = str(data_status[0][0])
    print(status_pagoal)

    try:
        # Cần kiểm tra xem thời gian deadline pa goal đã qua chưa và kiểm tra trạng thái của pa goal, nếu đã qua rồi/trạng thái k phải là pending hay draft thì không được phép thêm mục tiêu mới
        if(datetime.now() > dl_pagoal or status_pagoal == 'Canceled' or status_pagoal == 'Approved' or status_pagoal == 'Rejected'):
            return "Deadline for pa goal has passed or the current status is not Draft or Pending! You cannot add a new goal detail!", 505
    except:
        return "System has error", 500

    try:
        cursor.execute(
            "SELECT COUNT(*) FROM pa_goal_detail WHERE PAGOAL_ID = %s", (pa_goal_id))
        total = int(cursor.fetchall()[0][0])

        cursor.execute("INSERT INTO pa_goal_detail(PAGOAL_ID, GOAL_NAME,ACTION_STEP,DUE_DATE,COMPLETED_DATE,STATUS,COMMENT) VALUES (%s, %s,%s, %s,%s, %s,%s)",
                       (pa_goal_id, name, action, due_date, complete_date, status, comment))

        date = datetime.now()
        cursor.execute('UPDATE pa_goal SET LASTUPDATE_DATE = %s, TOTAL_GOALS = %s WHERE PAGOAL_ID = %s',
                       (date, total+1, pa_goal_id))

        conn.commit()
        return "OK", 200
    except:
        return "System error", 500


@app.route('/api/uc0131_132/edit-goal', methods=['POST', 'PATCH'])
def edit_goal():
    """
    Example req body
    {
        "pa_goal_id":"2",
        "pa_goal_detail_id":"1",
        "due_date":"2023-01-01 00:00:00",
        "complete_date":"2024-01-01 00:00:00",
        "status":"Completed",
        "name":"TU 1",
        "action":"TU 2",
        "comment":"Tu 3"
    }
    """
    conn = mysql.connection
    cursor = conn.cursor()

    body_request = request.get_json()

    pa_goal_detail_id = ""
    try:
        pa_goal_detail_id = body_request["pa_goal_detail_id"]
    except:
        return "pa goal detail id not found", 400

    pa_goal_id = ""
    try:
        pa_goal_id = body_request["pa_goal_id"]
    except:
        return "pa goal id not found", 400

    due_date = ""
    try:
        due_date = body_request["due_date"]
    except:
        return "dua date not found", 400

    complete_date = "1970-01-01 00:00:00"
    try:
        complete_date = body_request["complete_date"]
    except:
        print("complete date not found")

    status = "Processing"
    try:
        status = body_request["status"]
    except:
        print("status not found")

    name = ""
    action = ""
    comment = ""
    try:
        name = body_request["name"]
        action = body_request["action"]
        comment = body_request["comment"]
    except:
        return "name, action and comment is required", 400

    query_string = "SELECT DEADLINE_PAGOAL FROM pa_goal " + \
        f" WHERE PAGOAL_ID = {pa_goal_id}"
    # print(query_string)
    cursor.execute(query_string)
    data = cursor.fetchall()
    dl_pagoal = data[0][0]
    print(dl_pagoal)
    
    query_string_status = "SELECT STATUS FROM pa_goal " + \
        f" WHERE PAGOAL_ID = {pa_goal_id}"
    cursor.execute(query_string_status)
    data_status = cursor.fetchall()
    status_pagoal = str(data_status[0][0])
    print(status_pagoal)

    try:
        # Cần kiểm tra xem thời gian deadline pa goal đã qua chưa và kiểm tra trạng thái của pa goal, nếu đã qua rồi/trạng thái k phải là pending hay draft thì không được phép sửa mục tiêu
        if(datetime.now() > dl_pagoal or status_pagoal == 'Canceled' or status_pagoal == 'Approved' or status_pagoal == 'Rejected'):
            return "Deadline for pa goal has passed or the current status is not Draft or Pending! You cannot edit any goal detail!", 505
    except:
        return "System has error", 500

    try:
        cursor.execute('UPDATE pa_goal_detail SET GOAL_NAME = %s,ACTION_STEP = %s, DUE_DATE = %s, COMPLETED_DATE = %s, STATUS = %s, COMMENT = %s  WHERE PAGOALDETAIL_ID = %s',
                       (name, action, due_date, complete_date, status, comment, pa_goal_detail_id))

        date = datetime.now()
        cursor.execute('UPDATE pa_goal SET LASTUPDATE_DATE = %s WHERE PAGOAL_ID = %s',
                       (date, pa_goal_id))

        conn.commit()
        return "OK", 200
    except:
        return "System error", 500


@app.route('/api/uc0131_132/delete-goal', methods=['POST', 'DELETE'])
def delete_goal():
    """
    Example req body
    {
       "pa_goal_id":"2",
        "pa_goal_detail_ids":["4","5"]
    }
    "pa_goal_detail_ids":[] la xoa het goals
    """
    conn = mysql.connection
    cursor = conn.cursor()

    body_request = request.get_json()

    pa_goal_detail_ids = []
    try:
        pa_goal_detail_ids = body_request["pa_goal_detail_ids"]
    except:
        return "pa goal detail ids not found", 400

    pa_goal_id = ""
    try:
        pa_goal_id = body_request["pa_goal_id"]
    except:
        return "pa goal id not found", 400

    if(type(pa_goal_detail_ids).__name__ != 'list'):
        return "pa goal detail ids is not array", 400

    query_string = "SELECT DEADLINE_PAGOAL FROM pa_goal " + \
        f" WHERE PAGOAL_ID = {pa_goal_id}"
    # print(query_string)
    cursor.execute(query_string)
    data = cursor.fetchall()
    dl_pagoal = data[0][0]
    print(dl_pagoal)
    
    query_string_status = "SELECT STATUS FROM pa_goal " + \
        f" WHERE PAGOAL_ID = {pa_goal_id}"
    cursor.execute(query_string_status)
    data_status = cursor.fetchall()
    status_pagoal = str(data_status[0][0])
    print(status_pagoal)

    try:
        # Cần kiểm tra xem thời gian deadline pa goal đã qua chưa và kiểm tra trạng thái của pa goal, nếu đã qua rồi/trạng thái k phải là pending hay draft thì không được phép xóa mục tiêu
        if(datetime.now() > dl_pagoal or status_pagoal == 'Canceled' or status_pagoal == 'Approved' or status_pagoal == 'Rejected'):
            return "Deadline for pa goal has passed or the current status is not Draft or Pending! You cannot delete any goal detail!", 505
    except:
        return "System has error", 500

    if(len(pa_goal_detail_ids) == 0):
        try:
            cursor.execute('DELETE FROM pa_goal_detail WHERE PAGOAL_ID = %s',
                           (pa_goal_id))

            date = datetime.now()
            cursor.execute('UPDATE pa_goal SET LASTUPDATE_DATE = %s, TOTAL_GOALS = %s WHERE PAGOAL_ID = %s',
                           (date, "0", pa_goal_id))

            conn.commit()
            return "OK", 200
        except:
            return "System error", 500
    else:
        try:
            sql = "DELETE FROM pa_goal_detail WHERE PAGOALDETAIL_ID IN (" + ",".join(
                pa_goal_detail_ids) + ")"
            cursor.execute(sql)

            cursor.execute(
                "SELECT COUNT(*) FROM pa_goal_detail WHERE PAGOAL_ID = %s", (pa_goal_id))
            total = int(cursor.fetchall()[0][0])

            date = datetime.now()
            cursor.execute('UPDATE pa_goal SET LASTUPDATE_DATE = %s, TOTAL_GOALS = %s WHERE PAGOAL_ID = %s',
                           (date, total-len(pa_goal_detail_ids), pa_goal_id))

            conn.commit()
            return "OK", 200
        except:
            return "System error", 500


@app.route('/api/uc0131_132/view-goal', methods=['POST', 'GET'])
def view_goal():
    """
    Example req body
    {
       "pa_goal_id":"2",
        "pa_goal_detail_ids":["4"]
    }
    """
    conn = mysql.connection
    cursor = conn.cursor()

    body_request = request.get_json()

    pa_goal_detail_ids = []
    try:
        pa_goal_detail_ids = body_request["pa_goal_detail_ids"]
    except:
        return "pa goal detail ids not found", 400

    pa_goal_id = ""
    try:
        pa_goal_id = body_request["pa_goal_id"]
    except:
        return "pa goal id not found", 400

    if(type(pa_goal_detail_ids).__name__ != 'list'):
        return "pa goal detail ids is not array", 400

    if(len(pa_goal_detail_ids) != 0):
        try:
            sql = "SELECT * FROM pa_goal_detail WHERE PAGOALDETAIL_ID IN (" + ",".join(
                pa_goal_detail_ids) + ")"
            cursor.execute(sql)

            row_headers = [x[0] for x in cursor.description]
            data = cursor.fetchall()
            json_data = []
            for result in data:
                json_data.append(dict(zip(row_headers, result)))

            conn.commit()

            return jsonify({
                "data": json_data,
            })
        except:
            return "System error", 500

    else:
        try:

            cursor.execute(
                "SELECT * FROM pa_goal_detail WHERE PAGOAL_ID = %s", (pa_goal_id))

            row_headers = [x[0] for x in cursor.description]
            data = cursor.fetchall()
            json_data = []
            for result in data:
                json_data.append(dict(zip(row_headers, result)))

            conn.commit()

            return jsonify({
                "data": json_data,
            })
        except:
            return "System error", 500