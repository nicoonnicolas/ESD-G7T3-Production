from flask import Flask, request, jsonify
from flask_sqlalchemy import SQLAlchemy
from flask_cors import CORS

app = Flask (__name__)
CORS(app)

app.config['SQLALCHEMY_DATABASE_URI'] = 'mysql+mysqlconnector://root@localhost:3306/g7t3_review'
app.config['SQLALCHEMY_TRACK_MODIFICATIONS'] = False
db = SQLAlchemy(app)


class Review(db.Model):
    __tablename__ = "review"
    
    booking_id = db.Column(db.String, primary_key=True)
    review_star = db.Column(db.String, nullable=False)
    review_comment = db.Column(db.String, nullable=True)

    def __init__(self, booking_id, review_star, review_comment):
        self.booking_id = booking_id
        self.review_star = review_star
        self.review_comment = review_comment
    
    def json(self):
        return {
        "booking_id": self.booking_id, 
        "review_star": self.review_star,
        "review_comment": self.review_comment
        }

@app.route("/review")         
def getAll():
    return jsonify({
        "reviews": [
            review.json() for review in Review.query.all()
        ]
        })

@app.route("/review/<string:booking_id>", methods=["GET"])
def findReviewByBooking(booking_id):
    review = Review.query.filter_by(booking_id = booking_id).first()
    if review:
        return jsonify(review.json())
    return jsonify({"message": "Review with Booking ID '{}' not found.".format(booking_id)}), 404

@app.route("/review/<string:booking_id>", methods=['POST'])
def createReview(booking_id):
    if (Review.query.filter_by(booking_id=booking_id).first()):
        return jsonify({
            "message": "A Review with this Booking ID '{}' already exists.".format(booking_id)
            }), 400

    data = request.get_json()
    print(data)
    review = Review(booking_id, **data)

    try:
        db.session.add(review)
        db.session.commit()
    except:
        return jsonify({"message": "An error occurred creating the service provider."}), 500

    return jsonify(review.json()), 201

if __name__ == "__main__":  # to run this application with out having the name app.py
    app.run(host='127.0.0.1', port=1003, debug=True)