from flask import Flask, request, jsonify
from flask_sqlalchemy import SQLAlchemy


app = Flask (__name__)      # making book.py as a Flask app

app.config['SQLALCHEMY_DATABASE_URI'] = 'mysql+mysqlconnector://root@localhost:3306/g7t3_booking'
app.config['SQLALCHEMY_TRACK_MODIFICATIONS'] = False

db = SQLAlchemy(app)

class Booking(db.Model):
    __tablename__ = 'booking'

    booking_id = db.Column(db.Integer, primary_key=True)
    customer_mobile = db.Column(db.String(8), nullable=False)
    provider_mobile = db.Column(db.String(8), nullable=False)
    booking_time = db.Column(db.String(5), nullable=False)
    booking_date = db.Column(db.String(10), nullable=False)
    booking_price = db.Column(db.Float(precision=2), nullable=False)

    def __init__(self, booking_id, customer_mobile, provider_mobile, booking_time, booking_date ,booking_price):
        self.booking_id = booking_id
        self.customer_mobile = customer_mobile        
        self.provider_mobile = provider_mobile
        self.booking_time = booking_time
        self.booking_date = booking_date
        self.booking_price = booking_price

    def json(self):
        return {
        "booking_id": self.booking_id, 
        "customer_mobile": self.customer_mobile, 
        "provider_mobile": self.provider_mobile,
        "booking_time": self.booking_time,
        "booking_date": self.booking_date,
        "booking_price": self.booking_price
        }

@app.route("/booking")         
def getAll():
    return jsonify({
        "bookings": [
            booking.json() for booking in Booking.query.all()
        ]
        })

@app.route("/booking/<string:booking_id>", methods=['GET'])
def findBooking(booking_id):
    booking = Booking.query.filter_by(booking_id=booking_id).first() 
    if booking:
        return jsonify(booking.json())
    return jsonify({"message": "Booking not found"}), 404


@app.route("/booking/<string:booking_id>", methods=['POST'])
def createBooking(booking_id):
    if (Booking.query.filter_by(booking_id=booking_id).first()):
        return jsonify({
            "message": "A booking with booking ID '{}' already exists.".format(booking_id)
            }), 400

    data = request.get_json()
    print(data)
    booking = Booking(booking_id, **data)

    try:
        db.session.add(booking)
        db.session.commit()
    except:
        return jsonify({"message": "An error occurred creating the booking."}), 500

    return jsonify(booking.json()), 201
    
if __name__ == "__main__":  # to run this application with out having the name app.py
    app.debug = True
    app.run(host='0.0.0.0', port=1002, debug=True)