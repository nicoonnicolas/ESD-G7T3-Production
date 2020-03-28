import json
import sys
import os
import random
import datetime
import pika


class Customer:
    with open("g7t3_customer.json") as customerJsonFile:
        customers = json.load(customerJsonFile)
    customerJsonFile.close()


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


def findCustomerByMobile(customerMobile):
    customer = [
        c for c in customersInJSON()["customers"]
        if c["customer_mobile"] == customerMobile
    ]
    if len(customer) == 1:
        return customer[0]
    elif len(customer) > 1:
        return {
            "message":
            "Multiple customers found for mobile number " +
            str(customerMobile),
            "customers":
            customer
        }
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


if __name__ == "__main__":
    print("This is " + os.path.basename(__file__) + ": processing...")
    print("Option 1: Display All Customers")
    print("Option 2: Edit Customers")
    print("Option 0: Quit")
    option = int(input("Enter Option > "))
    while option > 0:
        if option == 1:
            displayCustomers()
        elif option == 2:
            customerMobile = input("Enter customer mobile > ")
            if "message" in (findCustomerByMobile(customerMobile)):
                print("***Mobile number not found!***")
            else:
                customerName = input("Enter customer name > ")
                customerAddress = input("Enter customer address > ")
                print(editCustomer(customerMobile, customerName, customerAddress))
        print("**********")
        print("Option 1: Display All Customers")
        print("Option 2: Edit Customers")
        print("Option 0: Quit")
        option = int(input("Enter Option > "))