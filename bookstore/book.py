from flask import Flask, request, jsonify
from flask_sqlalchemy import SQLAlchemy
from flask_cors import CORS



app = Flask (__name__)      # making book.py as a Flask app
CORS(app)

app.config['SQLALCHEMY_DATABASE_URI'] = 'mysql+mysqlconnector://root@localhost:3306/book'
app.config['SQLALCHEMY_TRACK_MODIFICATIONS'] = False

db = SQLAlchemy(app)

class Book(db.Model):
    __tablename__ = 'book'

    isbn13 = db.Column(db.String(13), primary_key=True)
    title = db.Column(db.String(64), nullable=False)
    price = db.Column(db.Float(precision=2), nullable=False)
    availability = db.Column(db.Integer)

    def __init__(self, isbn13, title, price, availability):
        self.isbn13 = isbn13
        self.title = title
        self.price = price
        self.availability = availability

    def json(self):
        return {"isbn13": self.isbn13, "title": self.title, "price": self.price, "availability": self.availability}

@app.route("/book")         # when will this page called? Default HTTP protocol is GET, even when not specified
def get_all():
    #return "Get all Books"  # pull the data from the DB
    return jsonify({"books": [book.json() for book in Book.query.all()]}) #Book.query.all() is the same as " SELECT * FROM table_name "

@app.route("/book/<string:isbn13>")
def find_by_isbn13(isbn13):
    book = Book.query.filter_by(isbn13=isbn13).first() # .first() returns the FIRST RECORD : SELECT * FROM book WHERE isbn13 = <isbn13> LIMIT 1
    if book:
        return jsonify(book.json())
    return jsonify({"message": "Book not found"}), 404


@app.route("/book/<string:isbn13>", methods=['POST'])
def create_book(isbn13):
    if (Book.query.filter_by(isbn13=isbn13).first()):
        return jsonify({"message": "A book with isbn13 '{}' already exists.".format(isbn13)}), 400

    data = request.get_json()
    book = Book(isbn13, **data) # **data represent everything else besides "isbn13" = INSERT INTO book (isbn13, all_other_records..., ) VALUES (<isbn13>, all_other_data)

    try:
        db.session.add(book)
        db.session.commit()
    except:
        return jsonify({"message": "An error occurred creating the book."}), 500

    return jsonify(book.json()), 201
    
if __name__ == "__main__":  # to run this application with out having the name app.py
    app.run()