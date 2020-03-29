from flask import Flask, request, jsonify
from flask_sqlalchemy import SQLAlchemy
from flask_cors import CORS
from os import environ


app = Flask (__name__)      # making book.py as a Flask app
CORS(app)

app.config['SQLALCHEMY_DATABASE_URI'] = 'mysql+mysqlconnector://root@localhost:3308/g7t3_serviceprovidertrial'
app.config['SQLALCHEMY_TRACK_MODIFICATIONS'] = False
app.config['CORS_HEADERS'] = 'Content-Type'

db = SQLAlchemy(app)

class ServiceProvider(db.Model):
    __tablename__ = 'serviceprovider_trial'
    
    provider_mobile = db.Column(db.String(8), primary_key=True)
    provider_name = db.Column(db.String(128), nullable = False)
    provider_price = db.Column(db.Float(precision=2), nullable=False)
    provider_time = db.Column(db.String(8), nullable=True)
    provider_day= db.Column(db.String(3), nullable=True)
    provider_service= db.Column(db.String(128), primary_key=True)

    def __init__(self, provider_mobile, provider_name, provider_service, provider_time, provider_day, provider_price):
        self.provider_mobile = provider_mobile
        self.provider_name = provider_name
        self.provider_service = provider_service        
        self.provider_time = provider_time
        self.provider_day = provider_day
        self.provider_price = provider_price

    def json(self):
        return {
        "provider_mobile": self.provider_mobile,
        "provider_name": self.provider_name,
        "provider_service": self.provider_service, 
        "provider_time": self.provider_time,
        "provider_day": self.provider_day,
        "provider_price": self.provider_price
        }

@app.route("/serviceprovider_trial")         # when will this page called? Default HTTP protocol is GET, even when not specified
def getAll():
    #return "Get all Books"  # pull the data from the DB
    return jsonify({
        "serviceProviders": [serviceprovider.json() for serviceprovider in ServiceProvider.query.all()]
        })

@app.route("/serviceprovider_trial/<string:provider_mobile>", methods=['GET'])
def getAllServicesByProvider(provider_mobile):
    return jsonify({
        "serviceProviders": [serviceprovider.json() for serviceprovider in ServiceProvider.query.filter_by(
                provider_mobile=provider_mobile)
        ]
    })

@app.route("/serviceprovider_trial/login/<string:provider_mobile>", methods=['GET'])
def getProvider(provider_mobile):
    serviceprovider = ServiceProvider.query.filter_by(provider_mobile=provider_mobile).first()
    if serviceprovider:
        return jsonify(serviceprovider.json())
    return jsonify({"message": "Service Provider not found"}), 404

@app.route("/serviceprovider_trial/<string:provider_mobile>", methods=["POST"])
def addService(provider_mobile):
    data = request.get_json()
    serviceProvider = ServiceProvider(provider_mobile, **data)
    try:
        db.session.add(serviceProvider)
        db.session.commit()
    except:
        return jsonify({"message": "An error occurred creating the service provider."}), 500

    return jsonify(serviceProvider.json()), 201
    
if __name__ == "__main__":  # to run this application with out having the name app.py
    app.debug = True
    app.run(host='0.0.0.0', port=1001, debug=True)