from flask import Flask
from datetime import datetime as DT 
import os
import psycopg2
from flask_bootstrap import Bootstrap

app = Flask(__name__) 


conn = psycopg2.connect(
        host="localhost",
        database="SensorData",
        user=os.environ['DB_USERNAME'],
        password=os.environ['DB_PASSWORD'])

date_time = DT.today()

# Open a cursor to perform database operations
# cur = conn.cursor()
# cur.execute('''INSERT INTO dhtdata (humidity, temperature, date_time)
#             VALUES ('10','20',%s);''',([date_time]))
            
# conn.commit()

# cur.close()


bootstrap = Bootstrap(app)

from app import routes




