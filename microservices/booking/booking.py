from flask import Flask, request, jsonify
from flask_sqlalchemy import SQLAlchemy


app = Flask (__name__)      # making book.py as a Flask app

app.config['SQLALCHEMY_DATABASE_URI'] = 'mysql+mysqlconnector://root@localhost:3306/g7t3_booking'
app.config['SQLALCHEMY_TRACK_MODIFICATIONS'] = False

db = SQLAlchemy(app)

class Review(db.Model):
    __tablename__ = 'booking'

    booking_id = db.Column(db.Integer, primary_key=True)
    customer_id = db.Column(db.Integer, nullable=False)
    provider_id = db.Column(db.Integer, nullable=False)
    booking_time = db.Column(db.String(256), nullable=False)
    booking_price = db.Column(db.Double, nullable=False)

    def __init__(self, booking_id, customer_id, provider_id, booking_time, booking_price):
        self.booking_id = booking_id
        self.customer_id = customer_id        
        self.provider_id = provider_id
        self.booking_time = booking_time
        self.booking_price = booking_price

    def json(self):
        return {
        "booking_id": self.booking_id, 
        "customer_id": self.customer_id, 
        "provider_id": self.provider_id,
        "booking_time": self.booking_time,
        "booking_price": self.booking_price
        }

@app.route("/review")         # when will this page called? Default HTTP protocol is GET, even when not specified
def getAll():
    #return "Get all reviews"  # pull the data from the DB
    return jsonify({
        "reviews": [review.json() for review in Review.query.all()]
        }) #Review.query.all() is the same as " SELECT * FROM table_name "

@app.route("/review/<string:booking_id>", methods=['GET'])
def findReview(booking_id):
    review = Review.query.filter_by(booking_id=booking_id).first() 
    # .first() returns the FIRST RECORD : SELECT * FROM book WHERE isbn13 = <isbn13> LIMIT 1
    if review:
        return jsonify(review.json())
    return jsonify({"message": "Reviews not found"}), 404


@app.route("/review/<string:booking_id>", methods=['POST'])
def createReview(booking_id):
    if (Review.query.filter_by(booking_id=booking_id).first()):
        return jsonify({
            "message": "A review with booking ID '{}' already exists.".format(booking_id)
            }), 400

    data = request.get_json()
    print(data)
    review = Review(booking_id, **data)

    try:
        db.session.add(review)
        db.session.commit()
    except:
        return jsonify({"message": "An error occurred creating the review."}), 500

    return jsonify(review.json()), 201
    
if __name__ == "__main__":  # to run this application with out having the name app.py
    app.debug = True
    app.run(host='0.0.0.0', port=1000, debug=True)