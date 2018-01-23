<?php

namespace Paymill\Tests\Unit\Models\Request;

use Paymill\Models\Request\PaypalChecksum;
use PHPUnit_Framework_TestCase;

/**
 * Paymill\Models\Request\PaypalChecksum test case.
 */
class PaypalChecksumTest extends PHPUnit_Framework_TestCase
{
    /**
     * @return array
     */
    public function dataProviderForTestParameterize()
    {
        $cases = [];

        // Case 0
        $model = new PaypalChecksum();
        $method = 'create';
        $expectedParameters = [];
        $cases[] = [$model, $method, $expectedParameters];

        // Case 1
        $model = (new PaypalChecksum())
            ->setAmount(4200)
            ->setCurrency('EUR')
            ->setDescription('Some description')
            ->setCheckoutOptions([
                'shipping_address_editable' => true
            ])
        ->setReturnUrl('http://foo.de/return')
        ->setCancelUrl('http://foo.de/cancel');
        $method = 'create';
        $expectedParameters = [
            'amount' => 4200,
            'currency' => 'EUR',
            'description' => 'Some description',
            'return_url' => 'http://foo.de/return',
            'cancel_url' => 'http://foo.de/cancel',
            'checkout_options[shipping_address_editable]' => true
        ];
        $cases[] = [$model, $method, $expectedParameters];

        return $cases;
    }

    /**
     * @param PaypalChecksum $model
     * @param string $method
     * @param array $expectedParameters
     *
     * @dataProvider dataProviderForTestParameterize
     */
    public function testParameterize(PaypalChecksum $model, $method, $expectedParameters)
    {
        $parameters = $model->parameterize($method);

        $this->assertEquals($expectedParameters, $parameters);
    }
}
