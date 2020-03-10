from flask import Flask, request, jsonify
from flask_sqlalchemy import SQLAlchemy


app = Flask (__name__)      # making book.py as a Flask app

app.config['SQLALCHEMY_DATABASE_URI'] = 'mysql+mysqlconnector://root@localhost:3306/g7t3_review'
app.config['SQLALCHEMY_TRACK_MODIFICATIONS'] = False

db = SQLAlchemy(app)

class Review(db.Model):
    __tablename__ = 'review'

    review_id = db.Column(db.Integer, primary_key=True)
    customer_mobile = db.Column(db.Integer, nullable=False)
    provider_mobile = db.Column(db.Integer, nullable=False)
    review_stars = db.Column(db.Integer, nullable=False)
    review_comments = db.Column(db.String(256), nullable=False)

    def __init__(self, review_id, customer_mobile, provider_mobile, review_stars, review_comments):
        self.review_id = review_id
        self.customer_mobile = customer_mobile        
        self.provider_mobile = provider_mobile
        self.review_stars = review_stars
        self.review_comments = review_comments

    def json(self):
        return {
        "review_id": self.review_id, 
        "customer_mobile": self.customer_mobile, 
        "provider_mobile": self.provider_mobile,
        "review_stars": self.review_stars,
        "review_comments": self.review_comments
        }

@app.route("/review")         # when will this page called? Default HTTP protocol is GET, even when not specified
def getAll():
    #return "Get all Reviews"  # pull the data from the DB
    return jsonify({
        "Reviews": [review.json() for review in Review.query.all()]
        }) #Review.query.all() is the same as " SELECT * FROM table_name "

@app.route("/review/<string:review_id>", methods=['GET'])
def findReview(review_id):
    review = Review.query.filter_by(review_id=review_id).first() 
    if review:
        return jsonify(review.json())
    return jsonify({"message": "Review not found"}), 404


@app.route("/review/<string:review_id>", methods=['POST'])
def createReview(review_id):
    if (Review.query.filter_by(review_id=review_id).first()):
        return jsonify({
            "message": "A Review with review ID '{}' already exists.".format(review_id)
            }), 400

    data = request.get_json()
    print(data)
    review = Review(review_id, **data)

    try:
        db.session.add(review)
        db.session.commit()
    except:
        return jsonify({"message": "An error occurred creating the review."}), 500

    return jsonify(review.json()), 201
    
if __name__ == "__main__":  # to run this application with out having the name app.py
    app.debug = True
    app.run(host='0.0.0.0', port=1000, debug=True)