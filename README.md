# BiFactor
#### (be factor keep liquidity)

## About Client

Billie is a Berlin based, breakthrough fintech startup that aims to upgrade the operating system of B2B payments.

As an experienced and passionate team we enable businesses to pay and get paid on their own terms.

## Business Requirement

An invoice is a document issued by a seller (creditor) to the buyer (debtor). It provides details
about a sale or services, including the quantities, costs.

Factoring is a process where a company (creditor) sells its invoice to a third-party factoring
company (Billie).

The factoring company then takes care of collecting the money from the debtor.
Since there is always the risk that a debtor won't pay their invoices, Billie sets a debtor limit for
each company. This means that Billie won't accept the invoice if the debtor's total amount of open
invoices reaches the limit.
##The BiFactor
BiFactor is the proposed solution for business requirement to extend current business flow into digital way.


## Functional Requirement

####Invoice CRUD
* Id
* Invoice_No
* Date
* Debtor_id
* Tax_amount
* Total
* Status
#### Invoice Items CRUD
* Id
* invoice_id
* Item name
* Unit price
* Line Tax
* Line Total
#### Company CRUD
* Id
* Reg_No
* Name
* Address
* BR_No
* Debtor Limit
* status
#### Factoring Request
* Id
* Request_No
* Date
* company_id
* invoice_id
* factor_amount(calculate based on company rule.ex:80%,90% of invoice total)
* status
#### Debtors
* Id
* Debtors_no
* NIC
* Name
* Address
* Contact no
* status
#### Debtor Payments
* Id
* invoice_no
* payment
* debtor_id
*

#### User CRUD(Staff,Creditor & Debtor)
* Id
* email
* password
* role
*

## Features
Create Company
Create Invoice
Set Debtor limit

## Todo

* Taxation
* Collection history
* Dynamic Factoring factors & rates
* Factor history analyze


####Commands Used in Symfony
* php vendor/bin/codecept generate:suite api - Run API Test Suit
* php vendor/bin/codecept generate:cest api Registration - Create New Cest
* composer install
* composer recipes
* php vendor/bin/codecept run api
* symfony console make
* symfony console make:controller AuthenticationController
* symfony console make:user
* symfony console make:entity User
* symfony console doctrine:schema:update --force
* symfony console doctrine:schema:update --force --env=test
