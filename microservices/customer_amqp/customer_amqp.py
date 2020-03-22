import json
import sys
import os
import random
import datetime
import pika

from flask import Flask, request, jsonify
from flask_sqlalchemy import SQLAlchemy
from flask_cors import CORS

app = Flask (__name__)
CORS(app)


class Customer:
    with open("g7t3_customer.json") as customerJsonFile:
        customers = json.load(customerJsonFile)
    customerJsonFile.close()

    def json(self):
        return {
        "customer_mobile": self.customer_mobile, 
        "customer_name": self.customer_name, 
        "customer_address": self.customer_address
        }

@app.route("/customer_amqp", methods=['GET'])
def customersInJSON():
    return Customer.customers


def displayCustomers():
    customersInJSONFormat = customersInJSON()
    customersArray = customersInJSONFormat['customers']
    print("---All Customers---")
    for customer in customersArray:
        print(customer['customer_name'])
        print(customer['customer_mobile'])
        print(customer['customer_address'])
        print()

@app.route("/customer_amqp/login/<string:customerMobile>", methods=['GET'])
def findCustomerByMobile(customerMobile):
    customer = [
        c for c in customersInJSON()["customers"]
        if c["customer_mobile"] == customerMobile
    ]
    if len(customer) == 1:
        return customer[0]
    else:
        return {
            "message":
            "Customer not found for mobile number " + str(customerMobile)
        }


def editCustomer(customerMobile, customerName, customerAddress):
    customer = findCustomerByMobile(customerMobile)
    if "message" in customer:
        return customer["message"]
    else:
        customer['customer_mobile'] = customerMobile
        customer['customer_name'] = customerName
        customer['customer_address'] = customerAddress
        hostname = "localhost"
        port = 5672
        connection = pika.BlockingConnection(
            pika.ConnectionParameters(host=hostname, port=port))
        channel = connection.channel()
        exchangeName = "customer_direct"
        channel.exchange_declare(exchange=exchangeName, exchange_type="direct")
        message = json.dumps(customer, default=str)
        channel.basic_publish(exchange=exchangeName,
                              routing_key="customer.info",
                              body=message)

        channel.queue_declare(queue="customer", durable=True)
        channel.queue_bind(exchange=exchangeName,
                           queue="customer",
                           routing_key="customer.update")
        channel.basic_publish(exchange=exchangeName,
                              routing_key="customer.update",
                              body=message,
                              properties=pika.BasicProperties(delivery_mode=2))
        print("Customer sent to update")


@app.route("/customer_amqp/register/<string:customer_mobile>", methods=['POST'])
def registerCustomer(customer_mobile):
    customer = [
        c for c in customersInJSON()["customers"]
        if c["customer_mobile"] == customer_mobile
    ]
    print(customer)
    if len(customer) > 0:
        return jsonify({
            "message": "A customer with Customer ID '{}' exists.".format(customer_mobile)
            }), 400
    data = request.get_json()
    print(data)
    customers = customersInJSON();
    customer = {
        "customer_mobile" : customer_mobile,
        "customer_name" : data['customer_name'],
        "customer_address" : data['customer_address']
    }
    customers['customers'].append(customer)
    with open("g7t3_customer.json", "w") as customerJsonFile:
        json.dump(customers, customerJsonFile)

    result = {
        "status": 1,
        "message": "Always successful",
        "customer": customer
    }
    return result

if __name__ == "__main__":
    app.run(host = '0.0.0.0',port=1000, debug=True)