from flask import Flask, request
from flask_mysqldb import MySQL
from flask import jsonify
from datetime import datetime
app = Flask(__name__)

app.config['MYSQL_HOST'] = "localhost"
app.config['MYSQL_USER'] = "root"
app.config['MYSQL_PASSWORD'] = ""
app.config['MYSQL_DB'] = "qlnv"

mysql = MySQL(app)

@app.route('/timesheet')
def getAllTimeSheet():
  cur = mysql.connection.cursor()

  cur.execute('SELECT * FROM timesheet')

  mysql.connection.commit()

  myresult = cur.fetchall()
  columns = [desc[0] for desc in cur.description]
  result = []

  for row in myresult:
    row = dict(zip(columns, row))
    result.append(row)
  row = {"columns": columns,"rows":myresult,"results":result}

  cur.close()

  return jsonify(data=result)

@app.route('/detail-timesheet/<timesheet_id>')
def getDetailOneDocument(timesheet_id):
  cur = mysql.connection.cursor()

  cur.execute('''SELECT * FROM timesheet_detail where timesheet_id = %s''',(timesheet_id))

  mysql.connection.commit()

  myresult = cur.fetchall()
  columns = [desc[0] for desc in cur.description]
  result = []

  for row in myresult:
    row = dict(zip(columns, row))
    result.append(row)
  row = {"columns": columns,"rows":myresult,"results":result}

  cur.close()

  return jsonify(data=result)

@app.route('/filter-timesheet/<date>') #filter by date (it can be start date or end date)
def filterTimeSheet(date):
  cur = mysql.connection.cursor()

  cur.execute('''SELECT * FROM timesheet where start_date = %s or end_date = %s''',(date, date))

  mysql.connection.commit()

  myresult = cur.fetchall()
  columns = [desc[0] for desc in cur.description]
  result = []

  for row in myresult:
    row = dict(zip(columns, row))
    result.append(row)
  row = {"columns": columns,"rows":myresult,"results":result}

  cur.close()

  return jsonify(data=result)

@app.route('/enter-time-sheet', methods=['POST'])
def enterTimeSheet():
  #passing HTML form data into python variable
  timesheet_id = request.form['timesheet_id']
  number_hour = request.form['number_hour']
  task_name = request.form['task_name']
  team_project_name = request.form['team_project_name']
  date = str(datetime.now())

  cur = mysql.connection.cursor()

  cur.execute('SELECT max(timedetail_id) from timesheet_detail');

  timedetail_id = cur.fetchone()

  cur.execute('INSERT INTO timesheet_detail VALUES (% s, % s, % s, % s,% s,% s)', 
  (timesheet_id, timedetail_id, date, number_hour, task_name, team_project_name))

  mysql.connection.commit()

  cur.close()

  return 'Insert Data Successfully!!!'

@app.route('/delete-timesheet/<timesheetdetail_id>', methods=['POST'])
def deleteDocument(timesheetdetail_id):
  cur = mysql.connection.cursor()

  cur.execute('''Delete from timesheet_detail where timedetail_id = %s''',(timesheetdetail_id))

  mysql.connection.commit()

  cur.close()

  return 'Delete Data Successfully!!!'

@app.route('/update-timesheet', methods=['POST'])
def updateDocument():
  #passing HTML form data into python variable
  timesheet_id = request.form['timesheet_id']
  timedetail_id = request.form['timedetail_id']
  date = request.form['date']
  number_hour = request.form['number_hour']
  task_name = request.form['task_name']
  team_project_name = request.form['team_project_name']

  cur = mysql.connection.cursor()

  cur.execute('''update timesheet_detail set 
  date = %s, 
  number_hour = %s, 
  task_name = %s, 
  team_project_name = %s where   timesheet_id = %s, 
  timedetail_id = %s, 
  ''',(date, number_hour, task_name, team_project_name, timesheet_id, timedetail_id))

  mysql.connection.commit()

  cur.close()

  return 'Update Data Successfully!!!'

@app.route('/save-timesheet', methods=['POST'])
def saveTimeSheet():
  timesheet_id = request.form['timesheet_id']
  submit_date =  str(datetime.now())

  cur = mysql.connection.cursor()

  cur.execute('''select sum(number_hour) from timesheet_detail where timesheet_id = %s''',(timesheet_id))

  total_hour = cur.fetchone()

  cur.execute('''update timesheet set 
  status = %s, 
  submit_date = %s, 
  total_hour = %s where timesheet_id = %s ''',('Draft', submit_date, total_hour, timesheet_id))

  mysql.connection.commit()

  cur.close()

  return 'Save Data Successfully!!!'

@app.route('/submit-timesheet', methods=['POST'])
def submitTimeSheet():
  timesheet_id = request.form['timesheet_id']
  submit_date =  str(datetime.now())

  cur = mysql.connection.cursor()

  cur.execute('''select sum(number_hour) from timesheet_detail where timesheet_id = %s''',(timesheet_id))

  total_hour = cur.fetchone()

  cur.execute('''update timesheet set 
  status = %s, 
  submit_date = %s, 
  total_hour = %s where timesheet_id = %s ''',('Pending', submit_date, total_hour, timesheet_id))

  mysql.connection.commit()

  cur.close()

  return 'Save Data Successfully!!!'

@app.route('/comment-timesheet', methods=['POST'])
def commentTimeSheet():
  timesheet_id = request.form['timesheet_id']
  comment = request.form['comment']

  cur = mysql.connection.cursor()

  cur.execute('''update timesheet set 
  comment = %s where timesheet_id = %s ''',(comment, timesheet_id))

  mysql.connection.commit()

  cur.close()

  return 'Comment Successfully!!!'

if __name__ == '__main__':
    app.run()