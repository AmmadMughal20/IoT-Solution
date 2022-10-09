from app import app, conn
from flask import render_template

@app.route('/')
@app.route('/ultrasonicdata')
def view_Ultrasonicdata():
    cursor = conn.cursor()
    query_Ultrasonic = 'SELECT * FROM UltrasonicData;'
    cursor.execute(query_Ultrasonic)
    ultrasonic_data = cursor.fetchall()
    cursor.close()
    return render_template('UltrasonicData.html', ultrasonic_data = ultrasonic_data)

@app.route('/dhtdata')
def view_DHTdata():
    cursor = conn.cursor()
    query_DHT11 = 'SELECT * FROM DHTData;'
    cursor.execute(query_DHT11)
    dht_data = cursor.fetchall()
    cursor.close()
    return render_template('DHTData.html', dht_data = dht_data)
