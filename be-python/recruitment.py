from flask import Flask
from flask_cors import CORS, cross_origin

app = Flask(__name__)
CORS(app)


from flaskext.mysql import MySQL
from pymysql.cursors import DictCursor

mysql = MySQL(cursorclass=DictCursor)
app.config['MYSQL_DATABASE_USER'] = 'root'
app.config['MYSQL_DATABASE_PASSWORD'] = ''
app.config['MYSQL_DATABASE_DB'] = 'recruitment'
app.config['MYSQL_DATABASE_HOST'] = 'localhost'
mysql.init_app(app)


class CV:
  def __init__(self, cv_id, manager_id,employee_id,name,email,url,academic_transcript_url,job_title,comment,date_of_application):
    self.cv_id = cv_id
    self.manager_id = manager_id
    self.employee_id=employee_id
    self.name=name
    self.email=email
    self.url=url
    self.academic_transcript_url=academic_transcript_url
    self.job_title=job_title
    self.comment=comment
    self.date_of_application=date_of_application
    self.status='Pending'

  def create(self):
    conn = mysql.connect()
    cursor = conn.cursor()
    sqlQuery = ('INSERT INTO `cv`(`MANAGER_ID`, `EMPLOYEE_ID`, `NAME`, `EMAIL`, `URL`, `ACADEMIC_TRANSCRIPT_URL`, `JOB_TITLE`, `COMMENT`, `DATE_OF_APPLICATION`, `STATUS`) VALUES(%(_manager_id)s,%(_employee_id)s,%(_name)s,%(_email)s,%(_url)s,%(_academic_transcript_url)s,%(_job_title)s,%(_comment)s,%(_date_of_application)s,%(_status)s)')
    #.format(self.manager_id,self.employee_id,self.name,self.email,self.url,self.academic_transcript_url,self.job_title,self.comment,self.date_of_application,self.status))          
    #data_insert=(self.manager_id,self.employee_id,self.name,self.email,self.url,self.academic_transcript_url,self.job_title,self.comment,self.date_of_application,self.status)
    data_insert = {
    '_manager_id' : self.manager_id,
    '_employee_id' : self.employee_id,
    '_name' : self.name,
    '_email' : self.email,
    '_url' : self.url,
    '_academic_transcript_url' : self.academic_transcript_url,
    '_job_title' : self.job_title,
    '_comment' : self.comment,
    '_date_of_application' : self.date_of_application,
    '_status' : self.status
    }
    cursor.execute(sqlQuery,data_insert)
    conn.commit()
    cursor.close()
    conn.close()
    return None

  def filter(position,status,order):
    conn = mysql.connect()
    cursor = conn.cursor()
    sqlQuery="SELECT * FROM cv WHERE 1"
    if (position!="All"):
      sqlQuery1=" AND JOB_TITLE=%(_position)s"
      sqlQuery+=sqlQuery1

    if(status!="All"):
      sqlQuery2=" AND STATUS=%(_status)s"
      sqlQuery+=sqlQuery2

    if(order=="Newest to Oldest"):
      sqlQuery3=" ORDER BY=DATE_OF_APPLICATION DESC"
      sqlQuery+=sqlQuery3

    if (order=="Oldest to Newest"):
        sqlQuery4=" ORDER BY=DATE_OF_APPLICATION"
        sqlQuery+=sqlQuery4
    
    data_select={
        '_position':position,
        '_status':status
    }
    cursor.execute(sqlQuery,data_select)
    listcv = cursor.fetchall()
    cursor.close()
    conn.close()
    return listcv
  
  def listall():
    conn = mysql.connect()
    cursor = conn.cursor()
    cursor.execute("SELECT * FROM cv ORDER BY DATE_OF_APPLICATION DESC")
    listcv = cursor.fetchall()
    cursor.close()
    conn.close()
    return listcv


  def viewdetail(cv_id):
    conn = mysql.connect()
    cursor = conn.cursor()
    sqlQuery=('SELECT * FROM cv WHERE CV_ID=%(_cv_id)s')
    data_select={
      '_cv_id':cv_id
    }
    cursor.execute(sqlQuery,data_select)
    detail_cv = cursor.fetchall()
    cursor.close()
    conn.close()
    return detail_cv


  def update_status(cv_id,status,comment):
    conn = mysql.connect()
    cursor = conn.cursor()
    sqlQuery=('UPDATE cv SET STATUS=%(_status)s, COMMENT=%(_comment)s WHERE CV_ID=%(_cv_id)s')
    data_update = {
    '_status' : status,
    '_comment' : comment,
    '_cv_id' : cv_id
    }
    cursor.execute(sqlQuery,data_update)
    conn.commit()
    cursor.close()
    conn.close()
    return None

  def delete(cv_id):
    conn = mysql.connect()
    cursor = conn.cursor()
    sqlQuery=('DELETE FROM cv WHERE CV_ID=%(_cv_id)s')
    data_delete={
      '_cv_id':cv_id
    }
    cursor.execute(sqlQuery,data_delete)
    conn.commit()
    cursor.close()
    conn.close()
    return None

from sqlalchemy import null
from flask import jsonify
from flask import flash, request
from model import CV
from datetime import date

@app.route('/create', methods=['POST'])
def create_cv():
    try:        
        _json = request.json
        _cv_id = _json['cv_id']
        _manager_id = _json['manager_id']
        _employee_id = _json['employee_id']
        _name = _json['name']
        _email=_json['email']
        _url=_json['url']
        _academic_transcript_url=_json['academic_transcript_url']
        _job_title=_json['job_title']
        _comment=_json['comment']
        _date_of_application='2022-08-08'#date.today()
        #if _cv_id and _manager_id and _employee_id and _name and _email and _url and _academic_transcript_url and _job_title and _comment and request.method == 'POST':
        if request.method=='POST':
            new_cv=CV(_cv_id,_manager_id,_employee_id,_name,_email,_url,_academic_transcript_url,_job_title,_comment,_date_of_application)
            new_cv.create()
            respone = jsonify('CV added successfully!')
            respone.status_code = 200
            return respone
        else:
            print("here")
            return showMessage404()
    except Exception as e:
        return("oh no")        


@app.route('/listall', methods=['GET'])
def listall_cv():
    try:
        listcv=CV.listall()
        respone = jsonify(listcv)
        respone.status_code = 200
        return respone
    except Exception as e:
        return("oh no")


@app.route('/filter', methods=['GET'])
def filter_cv():
    try:
        _json = request.json
        _position = _json['position']
        _status = _json['status']
        _order = _json['order']
        listcv=CV.filter(_position,_status,_order)
        respone = jsonify(listcv)
        respone.status_code = 200
        return respone
    except Exception as e:
        return("oh no")


@app.route('/viewdetail', methods=['GET'])
def viewdetail_cv():
    try:
        _json=request.json
        _cv_id=_json['cv_id']
        detail_cv=CV.viewdetail(_cv_id)
        respone = jsonify(detail_cv)
        respone.status_code = 200
        return respone
    except Exception as e:
        return("oh no")


@app.route('/updatestatus', methods=['PATCH'])
def update_status_cv():
    try:
        _json = request.json
        _cv_id=_json['cv_id']
        _status = _json['status']
        _comment = _json['comment']
        if _cv_id and _status and request.method == 'PATCH':			
            CV.update_status(_cv_id,_status,_comment)
            respone = jsonify('CV Status updated successfully!')
            respone.status_code = 200
            return respone
        else:
            return showMessage404()
    except Exception as e:
        return("oh no")

@app.route('/delete/<cv_id>', methods=['DELETE'])
def delete_emp(cv_id):
    try:
        CV.delete({cv_id})
        respone = jsonify('CV deleted successfully!')
        respone.status_code = 200
        return respone
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
    app.run(debug=True, port=5014)