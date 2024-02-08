<?php

namespace App\Imports;

use App\Models\Product;
use App\Models\Prices;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Illuminate\Http\Request;

class ProductsImport implements  ToModel,  WithHeadingRow
{
    /**
    * @param Collection $collection
    */
    protected $request;

        public function __construct(Request $request)
        {
            $this->request = $request;
        }

        public function model(array $row): ?Product
{

    if (!$this->request->status) {
        return null;
    }

    try {
        $now = now();
        $status = $this->request->status;

        if ($status == 'receipt_A') {
            return new Product([
                'trek_kod'   => $row['trek_kod'],
                'kod'        => $row['kod'],
                'weight'     => $row['weight'],
                'price'      => $row['price'],
                'receipt_A'  => $now,
            ]);
        } elseif ($status == 'dispatch_A' || $status == 'receipt_B' || $status == 'issue') {
            $product = Product::where('trek_kod', $row['trek_kod'])->first();

            if ($product) {
                $product->fill([
                    'kod'       => $row['kod'],
                    'weight'    => $row['weight'],
                    'price'     => $row['price'],
                ]);

                if ($status == 'dispatch_A' && !$product->dispatch_A) {
                    if(!$product->receipt_A)$product->receipt_A = $now;
                    $product->dispatch_A = $now;
                } elseif ($status == 'receipt_B' &&  !$product->receipt_B) {
                    if(!$product->receipt_A)if($product->dispatch_A)$product->receipt_A =$product->dispatch_A ;
                    else $product->receipt_A = $now;
                    if(!$product->dispatch_A)$product->dispatch_A = $now;
                    $product->receipt_B = $now;
                } elseif ($status == 'issue' &&  !$product->issue) {
                    if(!$product->receipt_A)if($product->dispatch_A)$product->receipt_A =$product->dispatch_A ;
                    else $product->receipt_A = $now;
                    if(!$product->dispatch_A)if($product->receipt_B)$product->dispatch_A =$product->receipt_B ;
                    else $product->dispatch_A = $now;
                    if(!$product->receipt_B)$product->receipt_B = $now;
                    $product->issue = $now;
                }

                $product->save();

                return null;
            }

            return new Product([
                'trek_kod'   => $row['trek_kod'],
                'kod'        => $row['kod'],
                'weight'     => $row['weight'],
                'price'      => $row['price'],
                'receipt_A'  => $now,
                'dispatch_A' => $status == 'dispatch_A' ? $now : null,
                'receipt_B'  => $status == 'receipt_B' ? $now : null,
                'issue'      => $status == 'issue' ? $now : null,
            ]);
        }
    } catch (\Exception $e) {
        // Обработка ошибок, например, логирование
        return null;
    }

    return null;
}

}
