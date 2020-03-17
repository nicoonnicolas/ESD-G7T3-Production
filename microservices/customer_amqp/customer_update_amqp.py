import json
import sys
import os
import random
import pika

hostname = "localhost"
port = 5672
connection = pika.BlockingConnection(
    pika.ConnectionParameters(host=hostname, port=port))
channel = connection.channel()
exchangeName = "customer_direct"
channel.exchange_declare(exchange=exchangeName, exchange_type='direct')


class Customer:
    with open("g7t3_customer.json") as customerJsonFile:
        customers = json.load(customerJsonFile)
    customerJsonFile.close()


def customersInJSON():
    return Customer.customers


def receiveCustomerUpdate():
    channelqueue = channel.queue_declare(queue="customer", durable=True)
    queueName = channelqueue.method.queue
    channel.queue_bind(exchange=exchangeName,
                       queue=queueName,
                       routing_key="customer.update")

    channel.basic_qos(prefetch_count=1)
    channel.basic_consume(queue=queueName,
                          on_message_callback=callback,
                          auto_ack=True)
    channel.start_consuming()


def callback(channel, method, properties, body):
    print("Received an update request by " + __file__)
    result = processUpdate(json.loads(body))
    json.dump(result, sys.stdout, default=str)
    print()
    print()


def processUpdate(customer):
    print(customer)
    customers = customersInJSON()
    customers = customers
    for thisCustomer in customers['customers']:
        if thisCustomer['customer_mobile'] == customer['customer_mobile']:
            thisCustomer['customer_name'] = customer['customer_name']
            thisCustomer['customer_address'] = customer['customer_address']
    print("Processing Update: ")
    print("customers")

    with open("g7t3_customer.json", "w") as customerJsonFile:
        json.dump(customers, customerJsonFile)
    print("Update successful")
    resultstatus = 1
    result = {
        "status": resultstatus,
        "message": "Always successful",
        "customer": customer
    }
    return result


if __name__ == "__main__":  # execute this program only if it is run as a script (not by 'import')
    print("This is " + os.path.basename(__file__) +
          ": updating for customer...")
    receiveCustomerUpdate()