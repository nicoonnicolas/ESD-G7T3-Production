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
    
    review_id = db.Column(db.Integer, primary_key=True)
    booking_id = db.Column(db.Integer, nullable=False)
    review_star = db.Column(db.Integer, nullable=False)
    review_comment = db.Column(db.Integer, nullable=True)

    def __init__(self, review_id, booking_id, review_star, review_comment):
        self.review_id = review_id
        self.booking_id = booking_id
        self.review_star = review_star
        self.review_comment = review_comment
    
    def json(self):
        return {
        "review_id": self.review_id, 
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

if __name__ == "__main__":  # to run this application with out having the name app.py
    app.debug = True
    app.run(host='127.0.0.1', port=1003, debug=True)