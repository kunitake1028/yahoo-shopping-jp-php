<?php

namespace Shippinno\YahooShoppingJp\Request;

use DateTimeImmutable;
use PHPUnit\Framework\TestCase;

class UpdateItemStockInfoTest extends TestCase
{
    /**
     * @test
     * @expectedException \Shippinno\YahooShoppingJp\Exception\InvalidRequestException
     * @expectedExceptionMessage quantity is not set.
     */
    public function quantity_is_not_set()
    {
        $request = new UpdateItemStockInfoRequest;

        $this->assertSame($request, $request->setSellerId('valid-seller-id')->setItemCode('VALID-ITEM-CODE'));
        $request->getParams();
    }

    /**
     * @test
     * @expectedException \Shippinno\YahooShoppingJp\Exception\InvalidRequestException
     * @expectedExceptionMessage item_code is not set.
     */
    public function item_code_is_not_set()
    {
        $request = new UpdateItemStockInfoRequest;

        $this->assertSame($request, $request->setSellerId('valid-seller-id')->setQuantity(2));
        $request->getParams();
    }

    /**
     * @test
     * @expectedException \Shippinno\YahooShoppingJp\Exception\InvalidRequestException
     * @expectedExceptionMessage seller_id is not set.
     */
    public function seller_id_is_not_set()
    {
        $request = new UpdateItemStockInfoRequest;

        $this->assertSame($request, $request->setItemCode('VALID-ITEM-CODE')->setQuantity(2));
        $request->getParams();
    }

    /**
     * @test
     */
    public function seller_id_is_number_or_alphabet_lowercase_or_dash_set()
    {
        $request = new UpdateItemStockInfoRequest;

        $this->assertSame($request, $request->setSellerId('valid-seller-id'));
    }

    /**
     * @test
     */
    public function sub_code_is_not_set()
    {
        $request = new UpdateItemStockInfoRequest;

        $this->assertSame($request, $request->setItemCode('VALID-ITEM-CODE'));
    }

    /**
     * @test
     */
    public function item_code_and_sub_code_is_number_or_alphabet_upper_or_lowercase_or_dash_set()
    {
        $request = new UpdateItemStockInfoRequest;

        $this->assertSame($request, $request->setItemCode('VALID-ITEM-CODE', 'SUB-CODE'));
    }

    /**
     * @test
     * @expectedException \Shippinno\YahooShoppingJp\Exception\InvalidRequestException
     * @expectedExceptionMessage item_code error.
     */
    public function item_code_is_only_number_or_alphabet_upper_or_lowercase_or_dash_set()
    {
        $request = new UpdateItemStockInfoRequest;

        $this->assertSame($request, $request->setItemCode('VALID_ITEM_CODE'));
    }

    /**
     * @test
     * @expectedException \Shippinno\YahooShoppingJp\Exception\InvalidRequestException
     * @expectedExceptionMessage sub_code error.
     */
    public function sub_code_is_only_number_or_alphabet_upper_or_lowercase_or_dash_set()
    {
        $request = new UpdateItemStockInfoRequest;

        $this->assertSame($request, $request->setItemCode('VALID-ITEM-CODE', 'SUB_CODE'));
    }

    /**
     * @test
     */
    public function quantity_is_number_set()
    {
        $request = new UpdateItemStockInfoRequest;

        $this->assertSame($request, $request->setQuantity(999999999));
    }

    /**
     * @test
     */
        public function quantity_is_negative_number_set()
    {
        $request = new UpdateItemStockInfoRequest;

        $this->assertSame($request, $request->setQuantity(-999999999));
    }

    /**
     * @test
     */
    public function quantity_is_string_ini_set()
    {
        $request = new UpdateItemStockInfoRequest;

        $this->assertSame($request, $request->setQuantity('INI'));
    }

    /**
     * @test
     * @expectedException \Shippinno\YahooShoppingJp\Exception\InvalidRequestException
     * @expectedExceptionMessage Only number or INI can be set.
     */
    public function quantity_is_only_number_or_string_ini_set()
    {
        $request = new UpdateItemStockInfoRequest;

        $this->assertSame($request, $request->setQuantity('INT'));
    }

    /**
     * @test
     */
    public function allow_overdraft_is_boolean_set()
    {
        $request = new UpdateItemStockInfoRequest;

        $this->assertSame($request, $request->setAllowOverdraft(true));
    }

    /**
     * @test
     */
    public function get_params_is_set()
    {
        $request = new UpdateItemStockInfoRequest;

        $this->assertSame($request, $request->setSellerId('valid-seller-id'));
        $this->assertSame($request, $request->setItemCode('VALID-ITEM-CODE', 'SUB-CODE'));
        $this->assertSame($request, $request->setQuantity(999999999));
        $this->assertSame($request, $request->setAllowOverdraft(true));

        $params = $request->getParams();

        $this->assertSame('valid-seller-id', $params['seller_id']);
        $this->assertSame('VALID-ITEM-CODE:SUB-CODE', $params['item_code']);
        $this->assertSame('999999999', $params['quantity']);
        $this->assertSame(1, $params['allow_overdraft']);
    }
}
