<?php

namespace App\Imports;

use App\Models\Product;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class ProductImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Product([
            'product_name' => $row[0],
            'product_slug_name' => $row[1],
            'product_short_description' => $row[2],
            'product_description' => $row[3],
            'product_regular_price' => $row[4],
            'product_percent_sale' => $row[5],
            'product_SKU' => $row[6],
            'product_quantity' => $row[7],
            'product_image' => $row[8],
            'category_id' => $row[9],
        ]);
    }
}
