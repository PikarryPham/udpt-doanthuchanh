from flask import Flask, jsonify, request
from datetime import datetime
from flask_mysqldb import MySQL
from flask_cors import CORS

# python -m flask run -h localhost -p 4001

mysql = MySQL()
app = Flask(__name__)
CORS(app)

# MySQL configurations
app.config['MYSQL_USER'] = 'root'
app.config['MYSQL_PASSWORD'] = ''
app.config['MYSQL_DB'] = 'pafeedback'
app.config['MYSQL_HOST'] = 'localhost'

mysql.init_app(app)


@app.route('/home', methods=['POST', 'GET'])
def helloworld():
    return jsonify({'message': 'Hello World!'})


@app.route('/api/uc13/get-feedbacks', methods=['POST', 'GET'])
def get_feedbacks():
    '''
    {
        "page":0, //optional
        "limit":1, //optional
        "employee_id":"8",
        "status":["Not responding", "Responded"],
        "deadline_feedback":"2022", //optional
        "key_word_content":"" //optional
    }
    nếu  "status":[] => status = “All” khi filter
    '''

    conn = mysql.connection
    cursor = conn.cursor()

    body_request = request.get_json()

    page = 0  # Page = 0 --> trang 1, Page =1 --> trang 2
    limit = 5  # Limit = 5 --> 5 feedbacks trên 1 trang

    try:
        page = body_request["page"]
    except:
        print("page not found")

    try:
        limit = body_request["limit"]
    except:
        print("limit not found")

    offset = page * limit

    employee_id = ""
    try:
        employee_id = body_request["employee_id"]
    except:
        return "Employee id cannot be found", 500

    deadline_feedback = "'1970-01-01 00:00:00'"
    try:
        deadline_feedback = body_request["deadline_feedback"]
        # deadline_feedback = deadline_feedback + "-01-01 00:00:00"
        deadline_feedback = str(deadline_feedback)
        deadline_feedback = f"'{deadline_feedback}'"
        print(deadline_feedback)
    except:
        print("deadline feedback date cannot be found")

    key_word_content = ""
    try:
        key_word_content = body_request["key_word_content"]
        key_word_content = f"'%{key_word_content}%'"
    except:
        print("Cannot find key word for searching content")

    status = []
    try:
        status = body_request["status"]
    except:
        print("status cannot be found")

    for i in range(0, len(status)):
        status[i] = f"'{status[i]}'"

    flag_status = len(status) > 0  # mặc định là true, ngược lại là false
    flag_deadline = deadline_feedback == "'1970-01-01 00:00:00'"  # mặc định là true, ngược lại là false
    # mặc định là true, ngược lại là false
    flag_search = len(key_word_content) > 0
    print(not(flag_status))
    try:
        # Nếu truyền vào cả deadline và key word search (chiều dài status != 0)
        if(flag_status and not(flag_deadline) and flag_search):
                query_string = "SELECT * FROM pa_feedback "+" WHERE STATUS IN (" + ",".join(
                    status) + ")" + f" AND EMPLOYEE_FEEDBACK_ID = {employee_id}" + f" AND YEAR(DEADLINE_FEEDBACK) = {deadline_feedback}" + f" AND CONTENT LIKE {key_word_content}" + f" ORDER BY RESPONDED_DATE DESC LIMIT {offset},{limit}"
        elif (flag_status and flag_deadline and flag_search): #nếu không truyền vào deadline, chỉ truyền vào content search và status
                query_string = "SELECT * FROM pa_feedback "+" WHERE STATUS IN (" + ",".join(
                    status) + ")" + f" AND EMPLOYEE_FEEDBACK_ID = {employee_id}" + f" AND CONTENT LIKE {key_word_content}" + f" AND DEADLINE_FEEDBACK >= {deadline_feedback}" + f" ORDER BY RESPONDED_DATE DESC LIMIT {offset},{limit}"
                print(query_string)
        elif (flag_status and not(flag_deadline) and not(flag_search)): #nếu có truyền vào deadline và status, k truyền vào content search 
                query_string = "SELECT * FROM pa_feedback "+" WHERE STATUS IN (" + ",".join(
                    status) + ")" + f" AND EMPLOYEE_FEEDBACK_ID = {employee_id}" + f" AND YEAR(DEADLINE_FEEDBACK) = {deadline_feedback}" + f" ORDER BY RESPONDED_DATE DESC LIMIT {offset},{limit}"
                print(query_string)
        elif (flag_status and flag_deadline and not(flag_search)): # không truyền vào cả deadline và content để search
                query_string = "SELECT * FROM pa_feedback "+" WHERE STATUS IN (" + ",".join(
                    status) + ")" + f" AND EMPLOYEE_FEEDBACK_ID = {employee_id}" + f" AND DEADLINE_FEEDBACK >= {deadline_feedback}" + f" ORDER BY RESPONDED_DATE DESC LIMIT {offset},{limit}"
                print(query_string)
        elif (not(flag_status) and not(flag_deadline) and flag_search):
                # neu truyen vao ca deadline vs content để search và không truyền vào status (tức status == all)
                query_string = "SELECT * FROM pa_feedback " + \
                    f" WHERE EMPLOYEE_FEEDBACK_ID = {employee_id}" + f" AND YEAR(DEADLINE_FEEDBACK) = {deadline_feedback}" + \
                    f" AND CONTENT LIKE {key_word_content}" + \
                        f" ORDER BY RESPONDED_DATE DESC" + \
                        f" LIMIT {offset},{limit}"
            # neu chi truyen vao content search
        elif (not(flag_status) and flag_deadline and flag_search):
                query_string = "SELECT * FROM pa_feedback " + \
                    f" WHERE EMPLOYEE_FEEDBACK_ID = {employee_id}" + f" AND DEADLINE_FEEDBACK >= {deadline_feedback}" + \
                    f" AND CONTENT LIKE {key_word_content}" + \
                    f" ORDER BY RESPONDED_DATE DESC" + \
                    f" LIMIT {offset},{limit}"
            # neu chi truyen vao deadline
        elif (not(flag_status) and not(flag_deadline) and not(flag_search)):
                query_string = "SELECT * FROM pa_feedback " + \
                    f" WHERE EMPLOYEE_FEEDBACK_ID = {employee_id}" + f" AND YEAR(DEADLINE_FEEDBACK) = {deadline_feedback}" + \
                    f" ORDER BY RESPONDED_DATE DESC" + \
                    f" LIMIT {offset},{limit}"
        else:
                query_string = "SELECT * FROM pa_feedback " + \
                    f" WHERE EMPLOYEE_FEEDBACK_ID = {employee_id}" + f" AND DEADLINE_FEEDBACK >= {deadline_feedback}" + \
                    f" ORDER BY RESPONDED_DATE DESC" + \
                    f" LIMIT {offset},{limit}"
    except:
        return "Status is not the array", 500

    cursor.execute(query_string)

    row_headers = [x[0] for x in cursor.description]
    data = cursor.fetchall()
    json_data = []
    for result in data:
        json_data.append(dict(zip(row_headers, result)))
    
    # get the number of total record
    try:
        # Nếu truyền vào cả deadline và key word search (chiều dài status != 0)
        if(flag_status and not(flag_deadline) and flag_search):
                query_string = "SELECT COUNT(*) FROM pa_feedback "+" WHERE STATUS IN (" + ",".join(
                    status) + ")" + f" AND EMPLOYEE_FEEDBACK_ID = {employee_id}" + f" AND YEAR(DEADLINE_FEEDBACK) = {deadline_feedback}" + f" AND CONTENT LIKE {key_word_content}" + f" ORDER BY RESPONDED_DATE DESC"
        elif (flag_status and flag_deadline and flag_search): #nếu không truyền vào deadline, chỉ truyền vào content search và status
                query_string = "SELECT COUNT(*) FROM pa_feedback "+" WHERE STATUS IN (" + ",".join(
                    status) + ")" + f" AND EMPLOYEE_FEEDBACK_ID = {employee_id}" + f" AND CONTENT LIKE {key_word_content}" + f" AND DEADLINE_FEEDBACK >= {deadline_feedback}" + f" ORDER BY RESPONDED_DATE DESC"
                # print(query_string)
        elif (flag_status and not(flag_deadline) and not(flag_search)): #nếu có truyền vào deadline và status, k truyền vào content search 
                query_string = "SELECT COUNT(*) FROM pa_feedback "+" WHERE STATUS IN (" + ",".join(
                    status) + ")" + f" AND EMPLOYEE_FEEDBACK_ID = {employee_id}" + f" AND YEAR(DEADLINE_FEEDBACK) = {deadline_feedback}" + f" ORDER BY RESPONDED_DATE DESC"
                # print(query_string)
        elif (flag_status and flag_deadline and not(flag_search)): # không truyền vào cả deadline và content để search
                query_string = "SELECT COUNT(*) FROM pa_feedback "+" WHERE STATUS IN (" + ",".join(
                    status) + ")" + f" AND EMPLOYEE_FEEDBACK_ID = {employee_id}" + f" AND DEADLINE_FEEDBACK >= {deadline_feedback}" + f" ORDER BY RESPONDED_DATE DESC"
                # print(query_string)
        elif (not(flag_status) and not(flag_deadline) and flag_search):
                # neu truyen vao ca deadline vs content để search và không truyền vào status (tức status == all)
                query_string = "SELECT COUNT(*) FROM pa_feedback " + \
                    f" WHERE EMPLOYEE_FEEDBACK_ID = {employee_id}" + f" AND YEAR(DEADLINE_FEEDBACK) = {deadline_feedback}" + \
                    f" AND CONTENT LIKE {key_word_content}" + \
                        f" ORDER BY RESPONDED_DATE DESC"
            # neu chi truyen vao content search
        elif (not(flag_status) and flag_deadline and flag_search):
                query_string = "SELECT COUNT(*) FROM pa_feedback " + \
                    f" WHERE EMPLOYEE_FEEDBACK_ID = {employee_id}" + f" AND DEADLINE_FEEDBACK >= {deadline_feedback}" + \
                    f" AND CONTENT LIKE {key_word_content}" + \
                    f" ORDER BY RESPONDED_DATE DESC"
            # neu chi truyen vao deadline
        elif (not(flag_status) and not(flag_deadline) and not(flag_search)):
                query_string = "SELECT COUNT(*) FROM pa_feedback " + \
                    f" WHERE EMPLOYEE_FEEDBACK_ID = {employee_id}" + f" AND YEAR(DEADLINE_FEEDBACK) = {deadline_feedback}" + \
                    f" ORDER BY RESPONDED_DATE DESC"
        else:
                query_string = "SELECT COUNT(*) FROM pa_feedback " + \
                    f" WHERE EMPLOYEE_FEEDBACK_ID = {employee_id}" + f" AND DEADLINE_FEEDBACK >= {deadline_feedback}" + \
                    f" ORDER BY RESPONDED_DATE DESC"
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


@app.route('/api/uc13/edit-a-feedback', methods=['POST', 'PATCH'])
def edit_a_feedback():
    '''
        {
            "feedback_id": "1",
            "content":"Anh nay lam viec de thuong lam"
        }
    '''
    conn = mysql.connection
    cursor = conn.cursor()

    body_request = request.get_json()

    feedback_id = 0
    try:
        feedback_id = body_request["feedback_id"]
        # print(feedback_id)
    except:
        return "Feedback ID cannot be found.", 500

    feedback_id = int(feedback_id)

    content = ""  # Cần kiểm tra nội dung content trên FE trước khi truyền xuống dưới BE
    try:
        content = body_request["content"]
        # print(content)
    except:
        print("Content cannot be found!")

    responded_date = datetime.now()
    query_string = "SELECT DEADLINE_FEEDBACK FROM pa_feedback " + \
        f" WHERE PAFB_ID = {feedback_id}"

    # print(query_string)
    cursor.execute(query_string)

    data = cursor.fetchall()
    # ket qua ban dau la tuple (giong list, nhung gia tri trong do khong the thay doi duoc)
    print(data[0][0])

    try:
        # Cần kiểm tra xem thời gian deadline feedback đã qua chưa, nếu chưa thì không cho feedback
        if(responded_date > data[0][0]):
            return "Deadline feedback has passed!", 505
    except:
        return "System has error", 500

    try:
        cursor.execute('UPDATE pa_feedback SET RESPONDED_DATE = %s, STATUS = %s, CONTENT = %s WHERE PAFB_ID = %s',
                       (responded_date, "Responded", content, feedback_id))
        conn.commit()
        return "Update feedback successfully", 200
    except:
        return "System has error", 500


@app.route('/api/uc13/get-a-feedback', methods=['POST', 'GET'])
def get_a_feedback():
    '''
        {
            "feedback_id": "1",
        }
    '''
    conn = mysql.connection
    cursor = conn.cursor()

    body_request = request.get_json()

    feedback_id = 0
    try:
        feedback_id = body_request["feedback_id"]
        print(feedback_id)
    except:
        return "Feedback ID cannot be found.", 500

    feedback_id = int(feedback_id)

    query_string = "SELECT * FROM pa_feedback " + \
        f" WHERE PAFB_ID = {feedback_id}"

    print(query_string)
    cursor.execute(query_string)

    row_headers = [x[0] for x in cursor.description]
    data = cursor.fetchall()
    json_data = []
    for result in data:
        json_data.append(dict(zip(row_headers, result)))

    # cursor.execute(getManagerEmail)
    cursor.close()

    return jsonify({
        "data": json_data,
    })
