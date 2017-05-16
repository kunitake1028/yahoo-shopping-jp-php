<?php

namespace Shippinno\YahooShoppingJp\Request;

use PHPUnit\Framework\TestCase;

class GetItemStockInfoRequestTest extends TestCase
{
    /**
     * @test
     * @expectedException \LogicException
     * @expectedExceptionMessage seller_id is already set.
     */
    public function it_cannot_set_seller_id_more_than_once()
    {
        $request = new GetItemStockInfoRequest;
        $this->assertSame($request, $request->setSellerId('SELLER_ID_1'));

        $request->setSellerId('SELLER_ID_2');
    }

    /**
     * @test
     * @expectedException \LogicException
     * @expectedExceptionMessage The number of the item_code must be less than 1000.
     */
    public function it_cannot_set_item_code_more_than_1000()
    {
        $request = new GetItemStockInfoRequest;
        $this->assertSame($request, $request->setSellerId('VALID_SELLER_ID'));

        for ($i = 1; $i <= 1001; $i++) {
            $request->addItemCode('AN_ITEM_CODE_' . $i);
        }

        $request->getParams();
    }

    /**
     * @test
     * @expectedException \LogicException
     * @expectedExceptionMessage Some of item_code are duplicated.
     */
    public function it_cannot_set_item_code_duplicately()
    {
        $request = new GetItemStockInfoRequest;
        $this->assertSame($request, $request->setSellerId('VALID_SELLER_ID'));

        $request->addItemCode('AN_ITEM_CODE');
        $request->addItemCode('AN_ITEM_CODE');

        $request->getParams();
    }

    /**
     * @test
     * @expectedException \InvalidArgumentException
     * @expectedExceptionMessage The item_code cannot be empty.
     */
    public function it_cannot_set_an_item_code_of_empty_character()
    {
        $request = new GetItemStockInfoRequest;
        $this->assertSame($request, $request->setSellerId('VALID_SELLER_ID'));

        $request->addItemCode('');
    }

    /**
     * @test
     * @expectedException \InvalidArgumentException
     * @expectedExceptionMessage The item_code must be less than 99 characters.
     */
    public function it_cannot_set_an_item_code_of_100_characters_or_more()
    {
        $request = new GetItemStockInfoRequest;
        $this->assertSame($request, $request->setSellerId('VALID_SELLER_ID'));

        $request->addItemCode(str_repeat('a', 100));
    }

//    /**
//     * @test
//     */
//    public function seller_id_is_number_or_alphabet_lowercase_or_dash_set()
//    {
//        $request = new UpdateItemStockInfoRequest;
//        $this->assertSame($request, $request->setSellerId('valid-seller-id'));
//    }

//    /**
//     * @test
//     */
//    public function item_code_and_sub_code_is_number_or_alphabet_upper_or_lowercase_or_dash_set()
//    {
//        $request = new UpdateItemStockInfoRequest;
//        $this->assertSame($request, $request->setItemCode('VALID-ITEM-CODE', 'SUB-CODE'));
//    }

//    /**
//     * @test
//     * @expectedException \Shippinno\YahooShoppingJp\Exception\InvalidRequestException
//     * @expectedExceptionMessage item_code error.
//     */
//    public function item_code_is_only_number_or_alphabet_upper_or_lowercase_or_dash_set()
//    {
//        $request = new UpdateItemStockInfoRequest;
//        $this->assertSame($request, $request->setItemCode('VALID_ITEM_CODE'));
//    }

//    /**
//     * @test
//     * @expectedException \Shippinno\YahooShoppingJp\Exception\InvalidRequestException
//     * @expectedExceptionMessage sub_code error.
//     */
//    public function sub_code_is_only_number_or_alphabet_upper_or_lowercase_or_dash_set()
//    {
//        $request = new UpdateItemStockInfoRequest;
//        $this->assertSame($request, $request->setItemCode('VALID-ITEM-CODE', 'SUB_CODE'));
//    }

//    /**
//     * @test
//     * @expectedException \Shippinno\YahooShoppingJp\Exception\InvalidRequestException
//     * @expectedExceptionMessage Only number or INI can be set.
//     */
//    public function quantity_is_only_number_or_string_ini_set()
//    {
//        $request = new UpdateItemStockInfoRequest;
//        $this->assertSame($request, $request->setQuantity('INT'));
//    }
//    /**
//     * @test
//     */
//    public function allow_overdraft_is_boolean_set()
//    {
//        $request = new UpdateItemStockInfoRequest;
//        $this->assertSame($request, $request->setAllowOverdraft(true));
//    }
//    /**
//     * @test
//     */
//    public function get_params_is_set()
//    {
//        $request = new UpdateItemStockInfoRequest;
//        $this->assertSame($request, $request->setSellerId('valid-seller-id'));
//        $this->assertSame($request, $request->setItemCode('VALID-ITEM-CODE', 'SUB-CODE'));
//        $this->assertSame($request, $request->setQuantity(999999999));
//        $this->assertSame($request, $request->setAllowOverdraft(true));
//        $params = $request->getParams();
//        $this->assertSame('valid-seller-id', $params['seller_id']);
//        $this->assertSame('VALID-ITEM-CODE:SUB-CODE', $params['item_code']);
//        $this->assertSame('999999999', $params['quantity']);
//        $this->assertSame(1, $params['allow_overdraft']);
//    }
}
