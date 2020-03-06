from flask import Flask, request, jsonify
from flask_sqlalchemy import SQLAlchemy


app = Flask (__name__)      # making book.py as a Flask app

app.config['SQLALCHEMY_DATABASE_URI'] = 'mysql+mysqlconnector://root@localhost:3306/g7t3_customer'
app.config['SQLALCHEMY_TRACK_MODIFICATIONS'] = False

db = SQLAlchemy(app)

class Customer(db.Model):
    __tablename__ = 'customer'

    customer_name = db.Column(db.String(128), nullable=False)
    customer_mobile = db.Column(db.String(8), primary_key=True)
    customer_address = db.Column(db.String(256), nullable=True)

    def __init__(self, customer_mobile, customer_name, customer_address):
        self.customer_mobile = customer_mobile
        self.customer_name = customer_name        
        self.customer_address = customer_address

    def json(self):
        return {
        "customer_mobile": self.customer_mobile, 
        "customer_name": self.customer_name, 
        "customer_address": self.customer_address
        }

@app.route("/customer")         # when will this page called? Default HTTP protocol is GET, even when not specified
def getAll():
    #return "Get all Books"  # pull the data from the DB
    return jsonify({
        "customers": [customer.json() for customer in Customer.query.all()]
        }) #Book.query.all() is the same as " SELECT * FROM table_name "

@app.route("/customer/<string:customer_mobile>", methods=['GET'])
def findCustomer(customer_mobile):
    customer = Customer.query.filter_by(customer_mobile=customer_mobile).first() 
    # .first() returns the FIRST RECORD : SELECT * FROM book WHERE isbn13 = <isbn13> LIMIT 1
    if customer:
        return jsonify(customer.json())
    return jsonify({"message": "Customer not found"}), 404


@app.route("/customer/<string:customer_mobile>", methods=['POST'])
def createCustomer(customer_mobile):
    if (Customer.query.filter_by(customer_mobile=customer_mobile).first()):
        return jsonify({
            "message": "A customer with Customer ID '{}' already exists.".format(customer_mobile)
            }), 400

    data = request.get_json()
    print(data)
    customer = Customer(customer_mobile, **data)

    try:
        db.session.add(customer)
        db.session.commit()
    except:
        return jsonify({"message": "An error occurred creating the customer."}), 500

    return jsonify(customer.json()), 201
    
if __name__ == "__main__":  # to run this application with out having the name app.py
    app.debug = True
    app.run(host='0.0.0.0', port=1000, debug=True)