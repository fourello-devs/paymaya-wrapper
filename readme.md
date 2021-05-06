# PaymayaWrapper

[![Latest Version on Packagist][ico-version]][link-packagist]
[![Total Downloads][ico-downloads]][link-downloads]
[![Build Status][ico-travis]][link-travis]
[![StyleCI][ico-styleci]][link-styleci]

This is where your description should go. Take a look at [contributing.md](contributing.md) to see a to do list.

## Installation

Via Composer

``` bash
$ composer require fourello-devs/paymayawrapper
```

## Usage

This package offers two convenient way to directly use PaymayaSDK.

- <b>PaymayaWrapper</b> facade
- <b>paymaya()</b> helper function

### Setup Environment Variables

```dotenv
PAYMAYA_CHECKOUT_PUBLIC_KEY=
PAYMAYA_CHECKOUT_SECRET_KEY=
PAYMAYA_CHECKOUT_ENVIRONMENT=SANDBOX
PAYMAYA_PAYMENT_PUBLIC_KEY=
PAYMAYA_PAYMENT_SECRET_KEY=
PAYMAYA_PAYMENT_ENVIRONMENT=SANDBOX
PAYMAYA_LOGO_URL=
PAYMAYA_ICON_URL=
PAYMAYA_APPLE_TOUCH_ICON_URL=
PAYMAYA_CUSTOM_TITLE=AppName
PAYMAYA_COLOR_SCHEME='#368d5c'
```
### Demonstration

```php
use PayMaya\API\Checkout;
use PayMaya\Model\Checkout\Address;
use PayMaya\Model\Checkout\Buyer;
use PayMaya\Model\Checkout\Contact;
use PayMaya\Model\Checkout\Item;
use PayMaya\Model\Checkout\ItemAmount;
use PayMaya\Model\Checkout\ItemAmountDetails;

public function checkoutTest(): array
{
    // Initialize PaymayaSDK
    paymaya();
    
    // Create Checkout
    $itemCheckout = new Checkout();

    // Checkout Address
    $address = new Address();
    $address->line1 = "9F Robinsons Cybergate 3";
    $address->line2 = "Pioneer Street";
    $address->city = "Mandaluyong City";
    $address->state = "Metro Manila";
    $address->zipCode = "12345";
    $address->countryCode = "PH";

    // Checkout Buyer
    $buyer = new Buyer();
    $buyer->firstName = 'James Carlo';
    $buyer->middleName = 'Sebial';
    $buyer->lastName = 'Luchavez';

    // Contact
    $contact = new Contact();
    $contact->phone = "09061886959";
    $contact->email = "carlo.luchavez@fourello.com";

    $buyer->contact = $contact;

    $buyer->shippingAddress = $address;
    $buyer->billingAddress = $address;

    $itemCheckout->buyer = $buyer;

    // Item
    $itemAmountDetails = new ItemAmountDetails();
    $itemAmountDetails->shippingFee = "14.00";
    $itemAmountDetails->tax = "5.00";
    $itemAmountDetails->subtotal = "50.00";
    $itemAmount = new ItemAmount();
    $itemAmount->currency = "PHP";
    $itemAmount->value = "100.00";
    $itemAmount->details = $itemAmountDetails;
    $item = new Item();
    $item->name = "Leather Belt";
    $item->code = "pm_belt";
    $item->description = "Medium-sized belt made from authentic leather";
    $item->quantity = "1";
    $item->amount = $itemAmount;
    $item->totalAmount = $itemAmount;

    $itemCheckout->items = array($item);
    $itemCheckout->totalAmount = $itemAmount;
    $itemCheckout->requestReferenceNumber = "123456789";
    $itemCheckout->redirectUrl = array(
        "success" => url()->to('/api/paymaya/success'),
        "failure" => url()->to('/api/paymaya/failure'),
        "cancel" => url()->to('/api/paymaya/cancel')
    );

    $itemCheckout->execute();

    return [
        'id' => $itemCheckout->id,
        'url' => $itemCheckout->url,
    ];
}
```

## Change log

Please see the [changelog](changelog.md) for more information on what has changed recently.

## Testing

``` bash
$ composer test
```

## Contributing

Please see [contributing.md](contributing.md) for details and a todolist.

## Security

If you discover any security related issues, please email carlo.luchavez@fourello.com instead of using the issue tracker.

## Credits

- [James Carlo Luchavez][link-author]
- [All Contributors][link-contributors]

## License

MIT. Please see the [license file](license.md) for more information.

[ico-version]: https://img.shields.io/packagist/v/fourello-devs/paymayawrapper.svg?style=flat-square
[ico-downloads]: https://img.shields.io/packagist/dt/fourello-devs/paymayawrapper.svg?style=flat-square
[ico-travis]: https://img.shields.io/travis/fourello-devs/paymayawrapper/master.svg?style=flat-square
[ico-styleci]: https://styleci.io/repos/12345678/shield

[link-packagist]: https://packagist.org/packages/fourello-devs/paymayawrapper
[link-downloads]: https://packagist.org/packages/fourello-devs/paymayawrapper
[link-travis]: https://travis-ci.org/fourello-devs/paymayawrapper
[link-styleci]: https://styleci.io/repos/12345678
[link-author]: https://github.com/fourello-devs
[link-contributors]: ../../contributors
