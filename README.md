# BillPlz API on PHP

Simple library for BillPlz Payment Software API

## Getting Started

### Composer
```bash
composer require h2akim/billplz
```

## How to Use

#### Create a new Collection
Parameters available for collection creation:
* title
* logo _(optional)_  - (not tested)
* split_payment[email] _(optional)_
* split_payment[fixed_cut] _(optional)_
* split_payment[variable_cut] _(optional)_
* object _(optional)_ - return as object (if true)

```php
namespace H2akim\Billplz;

$billplz = new Billplz([
	'api_key' => 'your-api-key'
]);

$billplz->collection()->create([
	'title' => 'My Collection'
]);
```

#### Create a new Open Collection
Parameters available for open collection creation:
* title
* description
* amount
* fixed_amount _(optional)_
* fixed_quantity _(optional)_
* payment_button _(optional)_
* reference_1_label _(optional)_
* reference_2_label _(optional)_
* email_link _(optional)_
* tax _(optional)_
* photo _(optional)_ - (not tested)
* split_payment[email] _(optional)_
* split_payment[fixed_cut] _(optional)_
* split_payment[variable_cut] _(optional)_
* object _(optional)_ - return as object (if true)

```php
namespace H2akim\Billplz;

$billplz = new Billplz([
	'api_key' => 'your-api-key'
]);

$billplz->collection()->createOpen([
	'title' => 'My Collection'
]);

```

#### Create a new Bill
Parameters available for bill creation:
* collection_id
* email
* mobile
* name
* amount
* callback_url
* description
* due_at _(optional)_
* redirect_url _(optional)_
* deliver _(optional)_ - SMS if set to true (RM0.15)
* reference_1_label _(optional)_
* reference_1 _(optional)_
* reference_2_label _(optional)_
* reference_2 _(optional)_
* object _(optional)_ - return as object (if true)

```php
namespace H2akim\Billplz;

$billplz = new Billplz([
	'api_key' => 'your-api-key'
]);

$billplz->bill()->create([
	'collection_id' => 'your-collection-id',
    'email' => 'your.client@email.com',
    'mobile' => '60123456789',
    'name' => 'Mak Jemah',
    'due_at' => '1991-4-21',
    'amount' => 5000, // RM50
    'callback_url' => "http://my-website-with-comic-sans.com/return_url"
]);
```

#### Retrieve a Bill
Parameters available for bill retrieval:
* bill_id **(required)**
* object _(optional)_ - return as object (if true)
* auto_submit _(optional)_ - Skip BillPlz page. [ Value: ***fpx*** or ***paypal*** ]
```php
namespace H2akim\Billplz;

$billplz = new Billplz([
	'api_key' => 'your-api-key'
]);

$billplz->bill()->get([
	'bill_id' => 'your-bill-id',
]);
```

#### Delete a Bill
Parameters available for bill deletion:
* bill_id **(required)**
```php
namespace H2akim\Billplz;

$billplz = new Billplz([
	'api_key' => 'your-api-key'
]);

$billplz->bill()->delete([
	'bill_id' => 'your-bill-id',
]);
```
