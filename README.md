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


##Documentation
This path included entire documentation regarding development
```<project path>/docs/ ```

##Features
* Invoice payments are tracking from company end & debtor end.
 ex: debtor payments to factoring company & company payments to ex creditor against the invoice
* Can be setup factoring ratio based on each invoice.


## Todo

* Taxation
* Collection history
* Dynamic Factoring factors & rates
* Factor history analyze


##Installation
```
$ git clone https://github.com/nteej/bifactor.git
$ composer install
$ cp .env.example .env
$ mysql -uroot -p
$ nano .env
$ php artisan migrate --seed
$ php artisan vendor:publish --> select 0 option by just pressing enter
$ php artisan key:generate
$ php artisan serve

Run Unit Testing
$ ./vendor/bin/pest

Coverage report
$ XDEBUG_MODE=coverage ./vendor/bin/pest --coverage
 
 
```
##Postman Collection

Please import this collection into postman & create environment variable {{url}}
All URLs are token guarded.

Login is essential to test api

Default logins

* Username: nteeje@gmail.com

* password: password

https://www.getpostman.com/collections/9d1e7307373763ce3662
