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

@app.route('/document')
def getAllDocument():
  cur = mysql.connection.cursor()

  cur.execute('SELECT * FROM document_post')

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

@app.route('/detail-document/<document_id>')
def getDetailOneDocument(document_id):
  cur = mysql.connection.cursor()

  cur.execute('''SELECT * FROM media_related_contents where document_id = %s''',(document_id))

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

@app.route('/insert-document', methods=['POST'])
def insertDocument():
  #passing HTML form data into python variable
  # categories = request.form['categories']
  # content = request.form['content']
  # manager_id = request.form['manager_id']
  # title = request.form['title']

  title = request.form.get('title')
  categories= request.form.get('categories')
  content= request.form.get('content')
  manager_id= request.form.get('managerid')
  date = str(datetime.now())

  cur = mysql.connection.cursor()

  cur.execute('SELECT max(document_id) from document_post');

  if (cur.fetchone()[0] is not None):
    document_id = cur.fetchone()[0] + 1
    print(document_id)
  else:
    document_id = 1

  cur.execute('INSERT INTO document_post VALUES (% s, % s, % s, % s,% s,% s, % s)', 
  (document_id, manager_id, title, content, date, date, categories))

  mysql.connection.commit()

  cur.close()

  return 'Insert Data Successfully!!!'

@app.route('/insert-media-document', methods=['POST'])
def insertMediaDocument():
  #passing HTML form data into python variable
  url = request.form['url']
  title = request.form['title']
  date = str(datetime.now())

  cur = mysql.connection.cursor()

  cur.execute('SELECT max(document_id) from media_related_contents')

  document_id = cur.fetchone()

  cur.execute('SELECT max(media_contentid) from media_related_contents')

  media_contentid = cur.fetchone()

  cur.execute('INSERT INTO media_related_contents VALUES (% s, % s, % s, % s,% s,% s)', 
  (document_id, media_contentid, title, url, date, date))

  mysql.connection.commit()

  cur.close()

  return 'Insert Media Data Successfully!!!'

@app.route('/delete-document/<document_id>', methods=['GET'])
def deleteDocument(document_id):

  cur = mysql.connection.cursor()

  query = 'Delete from media_related_contents where document_id = ' + document_id
  print(query)

  cur.execute(query)

  query = 'Delete from document_post where document_id = ' + document_id

  cur.execute(query)

  mysql.connection.commit()

  cur.close()

  return 'Delete Data Successfully!!!'

@app.route('/update-document', methods=['POST'])
def updateDocument():
  #passing HTML form data into python variable
  categories = request.form['categories']
  content = request.form['content']
  manager_id = request.form['manager_id']
  title = request.form['title']
  document_id = request.form['document_id']
  date = str(datetime.now())

  cur = mysql.connection.cursor()

  cur.execute('''update document_post set 
  document_id = %s, 
  manager_id = %s, 
  title = %s, 
  content = %s, 
  update_date = %s, 
  categories = %s''',(document_id, manager_id, title, content, date, categories))

  mysql.connection.commit()

  cur.close()

  return 'Update Data Successfully!!!'

if __name__ == '__main__':
    app.run()