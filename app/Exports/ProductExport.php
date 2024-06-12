<?php

namespace App\Exports;

use App\Models\Product;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ProductExport implements FromCollection,WithHeadings
{
    public function headings(): array
    {
        return [
            'product_name',
            'product_slug_name',
            'product_short_description',
            'product_description',
            'product_regular_price',
            'product_percent_sale',
            'product_SKU',
            'product_quantity',
            'product_image',
            'category_id'
        ];
    }

    public function collection()
    {
        return Product::all();
    }
}
