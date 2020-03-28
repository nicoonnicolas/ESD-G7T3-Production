from flask import *
from flask_sqlalchemy import *

import json
import requests
import sys
import inspect

customerURL = "http://localhost:1000/customer"

debugFlag = True

def browseAllCustomer():
    if debugFlag:
        funname = inspect.currentframe().f_code.co_name # Get the current function name
        print("===> Starting", funname)

    try:
        r = requests.get(customerURL, timeout=2)
    except requests.exceptions.RequestException as e:
        # See the reference for more detailed exception handling:
        # https://2.python-requests.org//en/latest/user/quickstart/#errors-and-exceptions
        print(e)
        sys.exit(1)

    if r.status_code == requests.codes.ok:
        customers = json.loads(r.text)["customers"] # Convert response string to a JSON object and take out the book array/list
        print(*customers, sep='\n') # unpack the book array and print each of the books
        if debugFlag:
            print("<=== Done", funname)
    else:
        print(r.status_code)
        if debugFlag:
            print("<=== Failed", funname)

def browseCustomerOneByOne(): # without error handling code
    r = requests.get(customerURL, timeout=2)
    books = json.loads(r.text)["books"] # Convert response string to a JSON object and take out the book array/list
    for b in books:
        r = requests.get(customerURL + "/" + b['isbn13'], timeout=1)
        print(r.status_code, r.text, sep='\n')

def browseCustomer(customer_mobile): # without error handling code
    r = requests.get(customerURL + "/" + customer_mobile)
    print(r.status_code, r.text, sep='\n')

def addCustomer(customer_mobile, customer_data): # without error handling code
    r = requests.post(customerURL + "/" + customer_mobile, json=customer_data, timeout=1)
    print(r.status_code, r.text, sep='\n')

if __name__ == '__main__':
    print("Calling various functions in the Book service...")
    print("== browse all books in one go ==")
    browseAllCustomer()
    print("== browse all books one by one ==")
    browseCustomerOneByOne()
    print("== adding a new book ==")
    newCustomer = {
        "customer_name": "Nicolas Wijaya",
        "customer_address": "SMU at SMU, Singapore" 
    }
    addCustomer("customer_mobile", newCustomer)
    print("All calls are done.")