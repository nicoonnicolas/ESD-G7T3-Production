from flask import Flask, request, jsonify
from flask_sqlalchemy import SQLAlchemy
from flask_cors import CORS
from os import environ


app = Flask (__name__)      # making book.py as a Flask app
CORS(app)

app.config['SQLALCHEMY_DATABASE_URI'] = 'mysql+mysqlconnector://root@localhost:3308/g7t3_serviceProvider'
app.config['SQLALCHEMY_TRACK_MODIFICATIONS'] = False
app.config['CORS_HEADERS'] = 'Content-Type'

db = SQLAlchemy(app)

class ServiceProvider(db.Model):
    __tablename__ = 'serviceprovider'
    
    provider_mobile = db.Column(db.String(8), primary_key=True)
    provider_name = db.Column(db.String(128), nullable = False)
    provider_service1 = db.Column(db.String(256), nullable=True)
    provider_service2= db.Column(db.String(256), nullable=True)
    provider_service3 = db.Column(db.String(256), nullable=True)
    provider_price = db.Column(db.Float(precision=2), nullable=False)

    def __init__(self, provider_mobile, provider_name, provider_service1, provider_service2, provider_service3, provider_price):
        self.provider_mobile = provider_mobile
        self.provider_name = provider_name
        self.provider_service1 = provider_service1        
        self.provider_service2 = provider_service2
        self.provider_service3 = provider_service3
        self.provider_price = provider_price

    def json(self):
        return {
        "provider_mobile": self.provider_mobile,
        "provider_name": self.provider_name,
        "provider_service1": self.provider_service1, 
        "provider_service2": self.provider_service2,
        "provider_service3": self.provider_service3,
        "provider_price": self.provider_price
        }

@app.route("/serviceprovider")         # when will this page called? Default HTTP protocol is GET, even when not specified
def getAll():
    #return "Get all Books"  # pull the data from the DB
    return jsonify({
        "seviceproviders": [serviceprovider.json() for serviceprovider in ServiceProvider.query.all()]
        }) #Book.query.all() is the same as " SELECT * FROM table_name "

@app.route("/serviceprovider/<string:provider_mobile>", methods=['GET'])
def findServiceProvider(provider_mobile):
    serviceprovider = ServiceProvider.query.filter_by(provider_mobile=provider_mobile).first() 
    # .first() returns the FIRST RECORD : SELECT * FROM book WHERE isbn13 = <isbn13> LIMIT 1
    if serviceprovider:
        return jsonify(serviceprovider.json())
    return jsonify({"message": "Service Provider not found"}), 404


@app.route("/serviceprovider/<string:provider_mobile>", methods=['POST'])
def createServiceProvider(provider_mobile):
    if (ServiceProvider.query.filter_by(provider_mobile=provider_mobile).first()):
        return jsonify({
            "message": "A service provider with Provider ID '{}' already exists.".format(provider_mobile)
            }), 400

    data = request.get_json()
    print(data)
    serviceprovider = ServiceProvider(provider_mobile, **data)

    try:
        db.session.add(serviceprovider)
        db.session.commit()
    except:
        return jsonify({"message": "An error occurred creating the service provider."}), 500

    return jsonify(serviceprovider.json()), 201

@app.route("/serviceprovider/update/<string:provider_mobile>", methods=['POST'])
def updateServiceProvider(provider_mobile):
    if (not(ServiceProvider.query.filter_by(provider_mobile=provider_mobile).first())):
        return jsonify({
            "message": "A service provider with Provider ID '{}' does not exists.".format(provider_mobile)
            }), 400

    data = request.get_json()
    print(data)
    serviceprovider = ServiceProvider(provider_mobile, **data)

    try:
        serviceprovider = ServiceProvider.query.filter_by(provider_mobile=provider_mobile).first()
        serviceprovider.provider_name = data['provider_name']
        serviceprovider.provider_service1 = data['provider_service1']
        serviceprovider.provider_service2 = data['provider_service2']
        serviceprovider.provider_service3 = data['provider_service3']
        serviceprovider.provider_price = data['provider_price']
        db.session.commit()
    except:
        return jsonify({"message": "An error occurred updating the service provider."}), 500

    return jsonify(serviceprovider.json()), 201
    
if __name__ == "__main__":  # to run this application with out having the name app.py
    app.debug = True
    app.run(host='0.0.0.0', port=1001, debug=True)