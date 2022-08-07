from flask import Flask, request
import mysql.connector
from flask import jsonify
from datetime import datetime, timedelta
from flask_cors import CORS, cross_origin

from flask_jwt_extended import create_access_token
from flask_jwt_extended import get_jwt_identity
from flask_jwt_extended import jwt_required
from flask_jwt_extended import JWTManager

app = Flask(__name__)
cors = CORS(app)
app.config['CORS_HEADERS'] = 'Content-Type'

# Setup the Flask-JWT-Extended extension
app.config["JWT_SECRET_KEY"] = "super-secret"
jwt = JWTManager(app)

config = {
  'user': 'root',
  'password': 'root',
  'host': '127.0.0.1',
  'database': 'main_service',
  'port': 8889
}

cnx = mysql.connector.connect(**config)

@app.route('/')
def index():
	return 'Server is running'

@app.route('/login', methods = ['POST'])
@cross_origin()
def login():
    username = request.form['USERNAME']
    password = request.form['PASSWORD']

    # QUERY TO GET EMPLOYEE ID AND ROLE FROM TABLE EMPLOYEE
    cur = cnx.cursor()
    cur.execute("SELECT EMPLOYEE_ID, ROLE FROM employee WHERE username = %s AND password = %s", (username, password))
    data = cur.fetchall()
    cur.close()

    if len(data) > 0:
        access_token = create_access_token(identity=username)

        return jsonify({
            "200": {
                "description": "Login Successfully",
                "content": {
                    "examples": {
                        "Verify Login Account": {
                            "value": {
                                "EMPLOYEE_ID": data[0][0],
                                "ROLE": data[0][1],
                                "API_KEY": access_token,
                            }
                        }
                    }
                }
            }
        })
    else:
        return jsonify({
            "200": {
                "description": "Wrong username or password",
            }
        })

@app.route('/protected')
@jwt_required()
def protected():
	return "Welcome to Protected page"

if __name__ == '__main__':
    app.run()


#     except Exception as error:
#         print(error)
#         return jsonify({
#             "500": {
#                 "description": "Internal Server Error",
#             }
#         })