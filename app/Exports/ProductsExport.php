<?php

namespace App\Exports;

use App\Models\Product;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ProductsExport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Product::select("id", "trek_kod", "kod", "weight", "price", "receipt_A", "dispatch_A", "receipt_B", "issue")->get();
    }

    /**
     * Write code on Method
     *
     * @return response()
     */
    public function headings(): array
    {
        return ["ID", "trek_kod", "kod", "weight", "price", "receipt_A", "dispatch_A", "receipt_B", "issue"];
    }
}
