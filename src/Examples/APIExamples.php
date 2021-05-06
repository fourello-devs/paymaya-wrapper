<?php


namespace FourelloDevs\PaymayaWrapper\Examples;

use PayMaya\API\Checkout;
use PayMaya\Model\Checkout\Address;
use PayMaya\Model\Checkout\Buyer;
use PayMaya\Model\Checkout\Contact;
use PayMaya\Model\Checkout\Item;
use PayMaya\Model\Checkout\ItemAmount;
use PayMaya\Model\Checkout\ItemAmountDetails;

/**
 * Class APIExamples
 * @package FourelloDevs\PaymayaWrapper\Examples
 *
 * @author James Carlo Luchavez <carlo.luchavez@fourello.com>
 * @since 2021-05-07
 */
class APIExamples
{
    public function checkoutTest(): array
    {
        paymaya();

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
        $contact->phone = "+63(2)1234567890";
        $contact->email = "paymayabuyer1@gmail.com";

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
            "success" => url()->to('/api/test/paymaya/success'),
            "failure" => url()->to('/api/test/paymaya/failure'),
            "cancel" => url()->to('/api/test/paymaya/cancel')
        );

        $itemCheckout->execute();

        return [
            'id' => $itemCheckout->id,
            'url' => $itemCheckout->url,
        ];
    }
}
