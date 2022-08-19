from flask import Flask, request
from flask_mysqldb import MySQL
from flask import jsonify
from datetime import datetime as datetime
app = Flask(__name__)

app.config['MYSQL_HOST'] = "qlnv.cizg8kaur6ll.ap-south-1.rds.amazonaws.com"
app.config['MYSQL_USER'] = "admin"
app.config['MYSQL_PASSWORD'] = "admin123456"
app.config['MYSQL_DB'] = "qlnv"

mysql = MySQL(app)

@app.route('/get-all-check-in-check-out-time/<employee_id>')
def getAllCheckInCheckOutTime(employee_id):
  cur = mysql.connection.cursor()
  cur.execute('SELECT * FROM check_in_check_out where EMPLOYEE_ID = ' + employee_id)
  mysql.connection.commit()
  myresult = cur.fetchall()
  columns = [desc[0] for desc in cur.description]
  result = []

  for row in myresult:
    row = dict(zip(columns, row))
    result.append(row)
  row = {"columns": columns,"rows":myresult,"results":result}

  cur.close()

  #cur_date = str(datetime.now().date())
  #new_date = cur_date[8:] + "-" + cur_date[5:7] + "-" + cur_date[:4]

  return jsonify(data=result)

@app.route('/enter-check-in-check-out', methods=['POST'])
def enterCICOTime():
  employee_id = request.form.get('EMPLOYEE_ID')
  time_in = request.form.get('TIME_IN')
  time_out = request.form.get('TIME_OUT')
  duration = request.form.get('DURATION')
  date = request.form.get('DATE')

  cur = mysql.connection.cursor()
  result = cur.execute('''SELECT * FROM check_in_check_out where date = %s and employee_id = %s''',(date, employee_id))
  if result: 
    query = "UPDATE `check_in_check_out` SET `TIME_IN`='" + time_in + "',`DURATION`='" + duration + "', `TIME_OUT`='" + time_out + "' WHERE `EMPLOYEE_ID`='" + employee_id + "' and `DATE`='" + date + "'";
    cur.execute(query)
    mysql.connection.commit()
    cur.close()
    return "Update data successfully!"
  else:
    query = "INSERT INTO `check_in_check_out` (`EMPLOYEE_ID`, `TIME_IN`, `DURATION`, `WEEK`, `MONTH`, `YEAR`, `TIME_OUT`, `DATE`) VALUES (" + employee_id + ",'" + time_in + "', '" + duration + "', NULL, NULL, NULL, '" + time_out + "', '" + date +"')"
    cur.execute(query)
    mysql.connection.commit()
    cur.close()
  return 'Insert Data Successfully!!!'

@app.route('/delete-check-in-check-out/<param>', methods=['GET'])
def deleteCICO(param):
  pos = param.find("+")
  date = '\'' + param[:pos] + '\''
  employee_id = param[pos+1:]

  cur = mysql.connection.cursor()
  query = 'Delete from check_in_check_out where EMPLOYEE_ID = ' + employee_id + ' and DATE = ' + date 
  cur.execute(query)
  mysql.connection.commit()
  cur.close()
  return 'Insert Data Successfully!!!'

@app.route('/update-check-in-check-out', methods=['POST'])
def updateCICOTime():
  employee_id = request.form.get('EMPLOYEE_ID')
  time_in = request.form.get('TIME_IN')
  time_out = request.form.get('TIME_OUT')
  duration = request.form.get('DURATION')
  date = request.form.get('DATE')

  cur = mysql.connection.cursor()
  query = "UPDATE `check_in_check_out` SET `TIME_IN`='" + time_in + "',`DURATION`='" + duration + "', `TIME_OUT`='" + time_out + "' WHERE `EMPLOYEE_ID`='" + employee_id + "' and `DATE`='" + date + "'"
  print(query)
  cur.execute(query)
  mysql.connection.commit()
  cur.close()
  return "Update data successfully!"

if __name__ == '__main__':
    app.run()