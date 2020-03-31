from flask import Flask, request, jsonify
from flask_sqlalchemy import SQLAlchemy
from flask_cors import CORS

app = Flask(__name__)  # making book.py as a Flask app
CORS(app)

app.config[
    'SQLALCHEMY_DATABASE_URI'] = 'mysql+mysqlconnector://root@localhost:3306/g7t3_booking'
app.config['SQLALCHEMY_TRACK_MODIFICATIONS'] = False
# @cross_origin(origin='*',headers=['Content-Type','Authorization'])
db = SQLAlchemy(app)


class Booking(db.Model):
    __tablename__ = 'booking'

    booking_id = db.Column(db.Integer, primary_key=True)
    customer_mobile = db.Column(db.String(8), nullable=False)
    provider_mobile = db.Column(db.String(8), nullable=False)
    provider_name = db.Column(db.String(128), nullable=True)
    booking_time = db.Column(db.String(5), nullable=False)
    booking_date = db.Column(db.String(10), nullable=False)
    booking_price = db.Column(db.Float(precision=2), nullable=False)
    booking_status = db.Column(db.Integer, nullable=False)
    booking_payment_status= db.Column(db.Integer, nullable=False)

    def __init__(self, booking_id, customer_mobile, provider_mobile, provider_name,
                 booking_time, booking_date, booking_price, booking_status, booking_payment_status):
        self.booking_id = booking_id
        self.customer_mobile = customer_mobile
        self.provider_mobile = provider_mobile
        self.provider_name = provider_name
        self.booking_time = booking_time
        self.booking_date = booking_date
        self.booking_price = booking_price
        self.booking_status = booking_status
        self.booking_payment_status = booking_payment_status

    def json(self):
        return {
            "booking_id": self.booking_id,
            "customer_mobile": self.customer_mobile,
            "provider_mobile": self.provider_mobile,
            "provider_name" : self.provider_name,
            "booking_time": self.booking_time,
            "booking_date": self.booking_date,
            "booking_price": self.booking_price,
            "booking_status": self.booking_status,
            "booking_payment_status": self.booking_payment_status
        }


@app.route("/booking")  # when will this page called? Default HTTP protocol is GET, even when not specified
def getAll():
    #return "Get all Books"  # pull the data from the DB
    return jsonify({
        "bookings": [booking.json() for booking in Booking.query.all()]
    })  #Book.query.all() is the same as " SELECT * FROM table_name "


@app.route("/booking/<string:customer_mobile>", methods=['GET'])
def findBooking(customer_mobile):
    allBookings = jsonify({
        "bookings": [
            booking.json() for booking in Booking.query.filter_by(
                customer_mobile=customer_mobile)
        ]
    })
    return allBookings

@app.route("/booking/provider/<string:provider_mobile>", methods=['GET'])
def findBookingByProvider(provider_mobile):
    allBookings = jsonify({
        "bookings": [
            booking.json() for booking in Booking.query.filter_by(
                provider_mobile=provider_mobile
            )
        ]
    })
    return allBookings

@app.route("/booking/<string:booking_id>", methods=['POST'])
def createBooking(booking_id):
    if (Booking.query.filter_by(booking_id=booking_id).first()):
        return jsonify({
            "message":
            "A booking with Booking ID '{}' already exists.".format(booking_id)
        }), 400

    data = request.get_json()
    print(data)
    booking = Booking(booking_id, **data)

    try:
        db.session.add(booking)
        db.session.commit()
    except:
        return jsonify({"message":
                        "An error occurred creating the booking."}), 500

    return jsonify(booking.json()), 201


@app.route("/booking/update/<string:booking_id>", methods=['POST'])
def updateCustomer(booking_id):
    if (not (Booking.query.filter_by(booking_id=booking_id).first())):
        return jsonify({
            "message":
            "A booking with Booking ID '{}' does not exists.".format(
                booking_id)
        }), 400

    data = request.get_json()
    booking = Booking(booking_id, **data)

    try:

        booking = Booking.query.filter_by(booking_id=booking_id).first()
        booking.booking_date = data['booking_date']
        booking.booking_time = data['booking_time']
        booking.customer_mobile = data['customer_mobile']
        booking.provider_mobile = data['provider_mobile']
        booking.booking_price = data['booking_price']
        db.session.commit()
    except:
        return jsonify({"message":
                        "An error occurred updating the booking."}), 500

    return jsonify(booking.json()), 201

@app.route("/booking/status/<string:booking_id>", methods=['POST'])
def updateBookingStatus(booking_id):
    if (not (Booking.query.filter_by(booking_id=booking_id).first())):
        return jsonify({
            "message":
            "A booking with Booking ID '{}' does not exists.".format(
                booking_id)
        }), 400
    try:
        booking = Booking.query.filter_by(booking_id = booking_id).first()
        booking.booking_status = 1
        db.session.commit()
    except:
        return jsonify({"message":"An error occurred updating the booking status"}), 500
    return jsonify(booking.json()), 201

@app.route("/booking/payment/<string:booking_id>", methods=['POST'])
def updatePaymentStatus(booking_id):
    if(not(Booking.query.filter_by(booking_id=booking_id).first())):
        return jsonify({
            "message":
            "A booking with Booking ID '{}' does not exists.".format(
                booking_id)
        }), 400
    try:
        booking = Booking.query.filter_by(booking_id = booking_id).first()
        booking.booking_payment_status = 1
        db.session.commit()
    except:
        return jsonify(
            {
                "message":"An error occurred updating the payment status"
            }
        ), 500
    return jsonify(booking.json()), 201

if __name__ == "__main__":  # to run this application with out having the name app.py
    app.debug = True
    app.run(host='0.0.0.0', port=1002, debug=True)
