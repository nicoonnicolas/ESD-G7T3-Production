from flask import Flask, request, jsonify
from flask_sqlalchemy import SQLAlchemy
from flask_cors import CORS

app = Flask (__name__)
CORS(app)

app.config['SQLALCHEMY_DATABASE_URI'] = 'mysql+mysqlconnector://root@localhost:3306/g7t3_payment'
app.config['SQLALCHEMY_TRACK_MODIFICATIONS'] = False
db = SQLAlchemy(app)


class Payment(db.Model):
    __tablename__ = "payment"
    
    payment_id = db.Column(db.Integer, primary_key=True)
    booking_id = db.Column(db.Integer, primary_key=False)
    booking_price = db.Column(db.Float(precision=2), nullable=False)
    provider_mobile = db.Column(db.Integer, nullable=True)

    def __init__(self, payment_id, booking_id, booking_price, provider_mobile):
        self.payment_id = payment_id
        self.booking_id = booking_id
        self.booking_price = booking_price
        self.provider_mobile = provider_mobile
    
    def json(self):
        return {
        "payment_id": self.payment_id, 
        "booking_id": self.booking_id,
        "booking_price": self.booking_price,
        "provider_mobile": self.provider_mobile
        }

@app.route("/payment")         
def getAll():
    return jsonify({
        "payments": [
            payment.json() for payment in Payment.query.all()
        ]
        })

@app.route("/payment/<string:payment_id>", methods=["GET"])
def findPaymentByPaymentID(payment_id):
    payment = Payment.query.filter_by(payment_id = payment_id).first()
    if payment:
        return jsonify(payment.json())
    return jsonify({"message": "Payment with Payment ID '{}' not found.".format(payment_id)}), 404

@app.route("/payment/<string:payment_id>", methods=['POST'])
def createPayment(payment_id):
    if (Payment.query.filter_by(payment_id=payment_id).first()):
        return jsonify({
            "message": "A Payment with this Payment ID '{}' already exists.".format(payment_id)
            }), 400

    data = request.get_json()
    print(data)
    payment = Payment(payment_id, **data)

    try:
        db.session.add(payment)
        db.session.commit()
    except:
        return jsonify({"message": "An error occurred creating the payment."}), 500

    return jsonify(payment.json()), 201

@app.route("/payment/provider/<string:provider_mobile>", methods=['GET'])
def getPaymentByProvider(provider_mobile):
    return jsonify({
        "payments": [
            payment.json() for payment in Payment.query.filter_by(provider_mobile = provider_mobile)
        ]
        })
    

if __name__ == "__main__":  # to run this application with out having the name app.py
    app.run(host='127.0.0.1', port=1007, debug=True)