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

@app.route('/get-all-check-in-check-out-time')
def getAllCheckInCheckOutTime():
  cur = mysql.connection.cursor()

  cur.execute('SELECT * FROM check_in_check_out')

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

@app.route('/filter-check-in-check-out-time/<month>') #filter by month
def filterCheckInCheckOutTime(month):
  cur = mysql.connection.cursor()

  cur.execute('''SELECT * FROM media_related_contents where month = %s''',(month))

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

@app.route('/enter-check-in', methods=['POST'])
def enterCheckInTime():
  employee_id = request.form['employee_id']
  time_in = request.form['time_in']
  duration = request.form['duration']
  week = request.form['week']
  month = request.form['month']
  year = request.form['year']
  date = request.form['date']

  cur = mysql.connection.cursor()

  result = cur.execute('''SELECT * FROM media_related_contents where date = %s and employee_id = %s''',(date, employee_id))

  if result: 
    #return 'Data duplicated!!!'
    cur.execute('UPDATE document_post SET date = %s, time_in = %s, duration = %s, week = %s, month = %s, year = %s where employee_id = %s', (date, time_in, duration, week, month, year, employee_id))

    mysql.connection.commit()

    cur.close()
    #update
  else:
    cur.execute('INSERT INTO document_post VALUES (% s, % s, % s, % s,% s,% s, % s, %s)', 
    (date, employee_id, time_in, duration, week, month, year, ''))

    mysql.connection.commit()

    cur.close()

    return 'Insert Data Successfully!!!'

@app.route('/enter-check-out', methods=['POST'])
def enterCheckOutTime():
  #passing HTML form data into python variable
  employee_id = request.form['employee_id']
  duration = request.form['duration']
  week = request.form['week']
  month = request.form['month']
  year = request.form['year']
  time_out = request.form['time_out']
  date = str(datetime.date(datetime.now()))

  cur = mysql.connection.cursor()

  result = cur.execute('''SELECT * FROM media_related_contents where date = %s and employee_id = %s''',(date, employee_id))

  if result: 
    cur.execute('UPDATE document_post SET date = %s, time_out = %s, duration = %s, week = %s, month = %s, year = %s where employee_id = %s', (date, time_out, duration, week, month, year, employee_id))

    mysql.connection.commit()

    cur.close()
    #update
  else:
    cur.execute('INSERT INTO document_post VALUES (% s, % s, % s, % s,% s,% s, % s, %s)', 
    (date, employee_id, time_in, duration, week, month, year, time_out))

    mysql.connection.commit()

    cur.close()

  return 'Insert Data Successfully!!!'


if __name__ == '__main__':
    app.run()
