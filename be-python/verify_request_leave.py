#app
from flask import Flask
from flask_cors import CORS, cross_origin

app = Flask(__name__)
CORS(app)

#config
from flaskext.mysql import MySQL
from pymysql.cursors import DictCursor

mysql = MySQL(cursorclass=DictCursor)
app.config['MYSQL_DATABASE_USER'] = 'root'
app.config['MYSQL_DATABASE_PASSWORD'] = ''
app.config['MYSQL_DATABASE_DB'] = 'leave_request'
app.config['MYSQL_DATABASE_HOST'] = 'localhost'
mysql.init_app(app)



#model
class Request_Verify:
  def __init__(self, status,comment):
    self.status=status
    self.comment=comment
    
  def update_status_approved(request_id,status):
    conn = mysql.connect()
    cursor = conn.cursor()
    sqlQuery=('UPDATE request_leave SET STATUS=%(_status)s WHERE RLEAVE_ID=%(_request_id)s')
    data_update = {
    '_status' : status,
    '_request_id' : request_id
    }
    cursor.execute(sqlQuery,data_update)
    conn.commit()
    cursor.close()
    conn.close()
    return None

  def update_status_rejected(request_id,status,comment):
    conn = mysql.connect()
    cursor = conn.cursor()
    sqlQuery=('UPDATE request_leave SET STATUS=%(_status)s, MANAGER_COMMENT=%(_comment)s WHERE RLEAVE_ID=%(_request_id)s')
    data_update = {
    '_status' : status,
    '_comment' : comment,
    '_request_id' : request_id
    }
    cursor.execute(sqlQuery,data_update)
    conn.commit()
    cursor.close()
    conn.close()
    return None

  def listall_leave_request_with_manager(manager_id):
    conn = mysql.connect()
    cursor = conn.cursor()
    sqlQuery=('SELECT * FROM request_leave WHERE MANAGER_ID=%(_manager_id)s')
    data_select = {
    '_manager_id' : manager_id
    }
    cursor.execute(sqlQuery,data_select)
    listrequest = cursor.fetchall()
    cursor.close()
    conn.close()
    return listrequest

  def update_leave_request_submit_approve(request_id,manager_id):
    conn = mysql.connect()
    cursor = conn.cursor()
    sqlQuery=('UPDATE request_leave SET MANAGER_ID=%(_manager_id)s WHERE RLEAVE_ID=%(_request_id)s')
    data_update = {
    '_manager_id' : manager_id,
    '_request_id':request_id
    }
    cursor.execute(sqlQuery,data_update)
    conn.commit()
    cursor.close()
    conn.close()
    return None

import requests
from sqlalchemy import null
from flask import jsonify
from flask import flash, request
from datetime import date


@app.route('/reject_leave_request', methods=['PATCH'])
def reject_leave_request():
    try:
        _json = request.json
        _request_id = _json['request_id']
        _status = _json['status']
        _comment = _json['comment']
        if _request_id and _status and _comment and request.method == 'PATCH':			
            Request_Verify.update_status_rejected(_request_id,_status,_comment)
            respone = jsonify('Request rejected!')
            respone.status_code = 200
            return respone
        else:
            return showMessage404()
    except Exception as e:
        return("oh no")



@app.route('/approve_leave_request', methods=['PATCH'])
def approve_leave_request():
    try:
        _json = request.json
        _request_id = _json['request_id']
        _status = _json['status']
        '''_days=_json['days']
        _employee_id=_json['employee_id']
        _leave_type=_json['leave_type']'''
        if _request_id and _status and request.method == 'PATCH':			
            Request_Verify.update_status_approved(_request_id,_status)
            '''paras = {"_employee_id":_employee_id, "_leave_type":_leave_type,"_days":_days}
            requests.put(url="http://127.0.0.1:5018/update_leave_type",data=paras)'''
            respone = jsonify('Request approved!')
            respone.status_code = 200
            return respone
        else:
            return showMessage404()
    except Exception as e:
        return("oh no")


@app.route('/listall', methods=['GET'])
def get_all_leave_request():
    try:
        _json = request.json
        _manager_id=_json['manager_id']
        if _manager_id and request.method == 'GET':			
            listrequest=Request_Verify.listall_leave_request_with_manager(_manager_id)
            respone = jsonify(listrequest)
            respone.status_code = 200
            return respone
        else:
            return showMessage404()
    except Exception as e:
        return("oh no")


@app.route('/submit_for_approve', methods=['PATCH'])
def submit_for_approve():
    try:
        _json = request.json
        _request_id=_json['request_id']
        _manager_id=_json['manager_id']
        if _request_id and _manager_id and request.method == 'PATCH':		
            Request_Verify.update_leave_request_submit_approve(_request_id,_manager_id)
            respone = jsonify("Update success")
            respone.status_code = 200
            return respone
        else:
            return showMessage404()
    except Exception as e:
        return("oh no")

@app.errorhandler(404)
def showMessage404(error=None):
    message = {
        'status': 404,
        'message': 'Record not found: ' + request.url,
    }
    respone = jsonify(message)
    respone.status_code = 404
    return respone

@app.errorhandler(500)
def showMessage500(error=None):
    message = {
        'status': 500,
        'message': 'Noooooooooooooooooooo',
    }
    respone = jsonify(message)
    respone.status_code = 500
    return respone
        
if __name__ == "__main__":
    app.run(debug=True,port=5007)
    
    