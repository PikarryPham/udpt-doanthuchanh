from math import ceil
from flask import Flask, request
import mysql.connector
from flask import jsonify
from datetime import datetime
from flask_cors import CORS, cross_origin

app = Flask(__name__)
cors = CORS(app)
app.config['CORS_HEADERS'] = 'Content-Type'

config = {
  'user': 'root',
  'password': '',
  'host': '127.0.0.1',
  'database': 'wfh',
  'port': 3306
}

config_main_service = {
  'user': 'root',
  'password': '',
  'host': '127.0.0.1',
  'database': 'main_service',
  'port': 3306
}

cnx = mysql.connector.connect(**config)
cnx_main_service =  mysql.connector.connect(**config_main_service)

@app.route('/')
def index():
	return 'Server WFH Request is running!'

@app.route('/wfh-request', methods = ['POST'])
@cross_origin()
def createRequestWFH():
    rwfhID =  None
    employeeID = request.form['EMPLOYEE_ID']
    managerID = request.form['MANAGER_ID']
    reason = request.form['REASON']
    createDate = str(datetime.now())
    updateDate = str(datetime.now())
    status = "Draft"
    managerComment = ""
    fromDate = request.form['FROM_DATE']
    toDate = request.form['TO_DATE']
    unsubmitReason = ""
    notificationFlag = request.form['NOTIFICATION_FLAG']

    # try:
    # QUERY TO GET EMPLOYEE ID AND ROLE FROM TABLE EMPLOYEE
    cur = cnx.cursor()

    cur.execute('INSERT INTO `request wfh` VALUES (%s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s)', 
    (rwfhID, employeeID, managerID, reason, createDate, updateDate, status, managerComment,fromDate, toDate, unsubmitReason, notificationFlag))
    cnx.commit()
    cur.close()

    #query to select max rwfhid
    cur = cnx.cursor()
    cur.execute('SELECT MAX(RWFH_ID) FROM `request wfh`'),
    total = cur.fetchall()
    cur.close()

    return jsonify({
        "200": {
            "description": "WFH Request Created Successfully",
            "rwfhid": total[0][0],
        }
    })
    # except: 
    #     return jsonify({
    #         "500": {
    #             "description": "Internal server error",
    #         }
    #     })

@app.route('/wfh-request/<rwfhID>', methods = ['POST'])
@cross_origin()
def addDetailRequestWFH(rwfhID):
    rwfhDetail_ID = None 
    date = request.form['DATE']

    # try:
    cur = cnx.cursor()
    cur.execute('INSERT INTO `request wfh detail` VALUES (%s, %s, %s)', (rwfhDetail_ID, rwfhID, date))
    cnx.commit()
    cur.close()

    return jsonify({
        "200": {
            "description": "WFH Request Detail Created Successfully",
        }
    })
    # except: 
    #     return jsonify({
    #         "500": {
    #             "description": "Internal server error",
    #         }
    #     })


@app.route('/wfh-request/<rwfhID>/wfh-request-details/<rwfhDetail_ID>', methods = ['DELETE'])
@cross_origin()
def deleteDetailRequestWFH(rwfhID,rwfhDetail_ID):
    # try:
    cur = cnx.cursor()

    cur.execute('''DELETE FROM `request wfh detail` WHERE RWFHDETAIL_ID= %s AND RWFH_ID = %s''', 
    (rwfhDetail_ID, rwfhID))

    # mysql.connection.commit()
    cnx.commit()
    cur.close()

    return jsonify({
        "200": {
            "description": "DELETE WFH Request Detail Successfully",
        }
    })
    # except: 
    #     return jsonify({
    #         "500": {
    #             "description": "Internal server error",
    #         }
    #     })


@app.route('/wfh-request', methods = ['PATCH'])
@cross_origin()
def updateRequestWFH():
    rwfhID =  request.form['RWFH_ID']
    reason = request.form['REASON']
    updateDate = str(datetime.now())
    fromDate = request.form['FROM_DATE']
    toDate = request.form['TO_DATE']
    notificationFlag = request.form['NOTIFICATION_FLAG']

    try:
        cur = cnx.cursor()

        cur.execute('''UPDATE `request wfh` SET REASON = %s, FROM_DATE = %s, TO_DATE = %s, NOTIFICATION_FLAG = %s, UPDATE_DATE = %s WHERE RWFH_ID = %s''', 
        (reason, fromDate, toDate, notificationFlag, updateDate, rwfhID))

        # mysql.connection.commit()
        cnx.commit()
        cur.close()

        return jsonify({
            "200": {
                "description": "WFH Request Update Successfully",
            }
        })
    except: 
        return jsonify({
            "500": {
                "description": "Internal server error",
            }
        })

@app.route('/submit-wfh-request', methods = ['PATCH'])
@cross_origin()
def submitRequestWFH():
    rwfhID =  request.form['RWFH_ID']
    updateDate = str(datetime.now())

    try:
        cur = cnx.cursor()
        cur.execute('''UPDATE `request wfh` SET STATUS = 'Pending', UPDATE_DATE = %s WHERE RWFH_ID = %s''', 
        (updateDate, rwfhID))
        cnx.commit()
        cur.close()

        return jsonify({
            "200": {
                "description": "WFH Request Submit Successfully",
            }
        })

    except: 
        return jsonify({
            "500": {
                "description": "Internal server error",
            }
        })

@app.route('/delete-wfh-request', methods = ['DELETE'])
@cross_origin()
def deleteRequestWFH():

    rwfhID =  request.form['RWFH_ID']
    try:
        # Delete detail wfh
        cur = cnx.cursor()
        cur.execute('DELETE FROM `request wfh detail` WHERE RWFH_ID = %s', (rwfhID,))
        cnx.commit()
        cur.close()

        cur = cnx.cursor()
        cur.execute('DELETE FROM `request wfh` WHERE RWFH_ID = %s', (rwfhID,))
        cnx.commit()
        cur.close()

        return jsonify({
            "200": {
                "description": "WFH Request Delete Successfully",
            }
        })
        
    except: 
        return jsonify({
            "500": {
                "description": "Internal server error",
            }
        })


@app.route('/wfh-requests', methods = ['GET'])
@cross_origin()
def getListRequestWFH():
    current_page = request.args.get('current_page')
    employee_id = request.args.get('employee_id')
    
    try:
        cur = cnx.cursor()
        cur.execute('SELECT COUNT(*) FROM `request wfh` WHERE EMPLOYEE_ID = %s',(employee_id,))
        total = cur.fetchall()
        cur.close()

        pagesize = 4
        start = (int(current_page)-1) * pagesize; 
            
        cur = cnx.cursor()
        cur.execute('SELECT * FROM `request wfh` WHERE EMPLOYEE_ID = %s LIMIT %s, %s', (employee_id, start, pagesize))
        data = cur.fetchall()
        cur.close()

        
        value = []
        for item in data:
            cur = cnx_main_service.cursor()
            cur.execute('SELECT `NAME` FROM `employee` WHERE `EMPLOYEE_ID` = %s', (item[2],))
            managerName = cur.fetchall()
            cur.close()
            value.append({
                "RWFH_ID": item[0],
                "MANAGER_ID": managerName[0][0],
                "CREATE_DATE": 	item[4],
                "UPDATE_DATE":	item[5],
                "STATUS": item[6],
                "MANAGER_COMMENT": item[7],
                "FROM_DATE": item[8],
                "TO_DATE": item[9],
                
            })

        return jsonify({
            "200": {
                "description": "Get List Request WFH Successfully",
                "content": {
                    "examples": {
                        "ListRequestWFH": {
                            "value": value,
                            "totalPages": ceil(total[0][0] / pagesize)
                        }
                    }
                }
            }
        })
        
    except: 
        return jsonify({
            "500": {
                "description": "Internal server error",
            }
        })


@app.route('/wfh-request/<rwfhID>/wfh-request-details', methods = ['GET'])
@cross_origin()
def getListDetailRequestWFH(rwfhID):
    current_page = request.args.get('current_page')
    
    try:
        pagesize = 3
        start = (int(current_page)-1) * pagesize; 
        cur = cnx.cursor()
        cur.execute('SELECT * FROM `request wfh detail` WHERE RWFH_ID = %s LIMIT %s, %s', (rwfhID ,start, pagesize))
        data = cur.fetchall()
        cur.close()

        value = []
        for item in data:
            value.append({
                "RWFHDETAIL_ID": item[0],
                "DATE": item[2],
            })

        if len(data) > 0:
            return jsonify({
                "200": {
                    "description": "Get List Request WFH Successfully",
                    "content": {
                        "examples": {
                            "List Request WFH": {
                                "value": value,
                            }
                        }
                    }
                }
            })
            
    except: 
        return jsonify({
            "500": {
                "description": "Internal server error",
            }
        })


@app.route('/employee', methods = ['GET'])
@cross_origin()
def getEmployeeInfo():
    employeeID = request.args.get('employeeID')

    # try:
    cur = cnx_main_service.cursor()
    cur.execute('SELECT employee.EMPLOYEE_ID, department.NAME, employee.NAME, employee.MANAGER_ID, `EMAIL` FROM `employee`, `department` WHERE employee.DEPART_ID = department.DEPART_ID AND employee.EMPLOYEE_ID= %s', (employeeID,)) 
    data = cur.fetchall()
    cur.close()
    valueEmployee = []
    for item in data:
        valueEmployee.append({
            "EMPLOYEE_ID": item[0],
            "DEPARTMENT_NAME": item[1],
            "EMPLOYEE_NAME": item[2],
            "MANAGER_ID": item[3],
            "EMAIL": item[4],
        })
    managerID = valueEmployee[0]["MANAGER_ID"]

    cur = cnx_main_service.cursor()
    cur.execute('SELECT employee.EMPLOYEE_ID, department.NAME, employee.NAME, employee.MANAGER_ID, `EMAIL` FROM `employee`, `department` WHERE employee.DEPART_ID = department.DEPART_ID AND employee.EMPLOYEE_ID= %s', (managerID,)) 
    dataManager= cur.fetchall()
    cur.close()
    valueManager = []
    for item in dataManager:
        valueManager.append({
            "EMPLOYEE_ID": item[0],
            "DEPARTMENT_NAME": item[1],
            "NAME": item[2],
            "EMAIL": item[4],
        })

   
    if len(data) > 0:
        return jsonify({
            "200": {
                "description": "Get Employee Info Successfully",
                "content": {
                    "examples": {
                        "EmployeeInfo": {
                            "value": valueEmployee,
                        },
                        "ManagerInfo": {
                            "value": valueManager,
                        }
                    }
                }
            }
        })
            
    # except: 
    #     return jsonify({
    #         "500": {
    #             "description": "Internal server error",
    #         }
    #     })



@app.route('/wfh-request', methods = ['GET'])
@cross_origin()
def getDetailRequestWFH():
    rWfhID = request.args.get('rWfhID')

    try:
        cur = cnx.cursor()
        cur.execute('SELECT * FROM `request wfh` WHERE RWFH_ID = %s', (rWfhID,))
        data = cur.fetchall()
        cur.close()
        value = []
        for item in data:
            cur = cnx_main_service.cursor()
            cur.execute('SELECT `NAME` FROM `employee` WHERE `EMPLOYEE_ID` = %s', (item[2],))
            managerName = cur.fetchall()
            cur.close()
            value.append({
                "RWFH_ID": item[0],
                "MANAGER_ID": managerName[0][0],
                "CREATE_DATE": 	item[4],
                "UPDATE_DATE":	item[5],
                "STATUS": item[6],
                "MANAGER_COMMENT": item[7],
                "FROM_DATE": item[8],
                "TO_DATE": item[9],
                "NOTIFICATION_FLAG": item[11],
            })
        cur = cnx.cursor()
        cur.execute('SELECT * FROM `request wfh detail` WHERE RWFH_ID = %s', (rWfhID,))
        data = cur.fetchall()
        cur.close()
        listDetail = []
        for item in data:
            listDetail.append({
                "RWFHDETAIL_ID": item[0],
                "RWFH_ID": item[1],
                "DATE": 	item[2],
            })

        return jsonify({
            "200": {
                "description": "Get Detail Request WFH Successfully",
                "content": {
                    "examples": {
                        "DetailRequestWFH": {
                            "value": value,
                        },
                        "listDetail" : {
                            "value":listDetail
                        }
                    }
                }
            }
        })
        
    except: 
        return jsonify({
            "500": {
                "description": "Internal server error",
            }
        })

@app.route('/wfh-request/delete-wfh-request-details/<rwfhID>', methods = ['DELETE'])
@cross_origin()
def deleteAllDetailRequestWFH(rwfhID):
    # try:
    cur = cnx.cursor()

    cur.execute('''DELETE FROM `request wfh detail` WHERE RWFH_ID = %s''', 
    (rwfhID,))

    cnx.commit()
    cur.close()

    return jsonify({
        "200": {
            "description": "DELETE WFH Request Detail Successfully",
        }
    })
    # except: 
    #     return jsonify({
    #         "500": {
    #             "description": "Internal server error",
    #         }
    #     })

if __name__ == '__main__':
    app.run(host='localhost', port=5041, debug=True)
