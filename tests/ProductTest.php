 <?php
 
class ProductTest extends TestCase
{
//Soal no.5 membuat Unit Test API

//call with php vendor/phpunit/phpunit/phpunit --filter testShouldReturnProduct
    /**
     * /products [GET]
     */
    public function testShouldReturnAllProducts(){

        $this->get("test/product", []);
        $this->seeStatusCode(200);
        $this->seeJsonStructure([
            'product' => ['*' =>
                [
                    'name',
                    'price',
                    'unit',
                    'qty',
                    'created_at',
                    'updated_at'
                ]
            ]
        ]);
    }

    /**
     * /products/id [GET]
     */
    public function testShouldReturnProduct(){
        $this->get("test/product/607edec3b84c0000bc002163", []);
        $this->seeStatusCode(400);
        $this->seeJsonStructure([
                'error',
        ]);        
    }
    /**
     * /products/id [DELETE]
     */
    public function testShouldDeleteProduct(){
        
        $this->patch("test/product/delete/607edec3b84c0000bc002163", [], []);
        $this->seeStatusCode(200);
        $this->seeJsonStructure([
                'status',
        ]);
    }
    /**
     * /products [POST]
     */
    public function testShouldCreateProduct(){

        $parameters = [
            'name' => 'Indomie Soto',
            'price' => 2100,
            'unit' => 'pcs',
            'qty' => 5000,
        ];

        $this->post("test/product", $parameters, []);
        $this->seeStatusCode(200);
        $this->seeJsonStructure([
                'status',
        ]);
    }
    
    /**
     * /products/id [PUT]
     */
    public function testShouldUpdateProduct(){

        $parameters = [
            'name' => 'Indomie Goreng',
			'price' => 2500,
            'qty' => 10000,
        ];

        $this->patch("test/product/607edec3b84c0000bc002163", $parameters, []);
        $this->seeStatusCode(400);
        $this->seeJsonStructure([
                'error',
        ]);     
    }
}