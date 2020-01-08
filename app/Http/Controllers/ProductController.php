<?php

namespace App\Http\Controllers;

use App\Order;
use App\Product;
use Dompdf\Dompdf;
use Illuminate\Http\Request;

class ProductController extends ResourceController
{
    public static $model = Product::class;

    public function categoryProducts() {
        return Order::find(1)->products;
    }

    public function getPdf(){
        $dompdf = new Dompdf();
        $dompdf->loadHtml('Hello world');
        $dompdf->render();

        $dompdf->stream("dompdf_out.pdf", ["Attachment" => false]);
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        //
    }

}
