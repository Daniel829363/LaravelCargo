<?php

namespace App\Http\Controllers;
use App\Exports\ProductsExport;
use App\Imports\ProductsImport;
use Maatwebsite\Excel\Facades\Excel;
use App\Models\Product;
use App\Models\Prices;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::get();

        return view('products.product', compact('products'));
    }

    public function export()
    {
        return Excel::download(new ProductsExport, 'products.xlsx');
    }

    /**
    * @return \Illuminate\Support\Collection
    */
    public function import(Request $request)
    {
        if (!$request->status) {
            return back()->withErrors(['file' => 'Выберите статус']);
        }

        if (!$request->hasFile('file')) {
            return back()->withErrors(['file' => 'Файл для импорта не выбран!']);
        }

        Excel::import(new ProductsImport($request), request()->file('file'));

        return back()->with('success', 'Users imported successfully.');
    }





    public function create(Request $request)
{
    $price=Prices::get()->first();
    if ($request->trek_kod){

    $status = $request->status; // Получаем значение выбранного radiobutton

    // Проверяем выбранный статус и обновляем соответствующие поля
    if ($status == 'receipt_A') {
        $product = Product::where('trek_kod', $request->trek_kod)->first();
        if ($product){$this->update2($request,$product);}
        else{
            $product = new Product;
            $product->trek_kod = $request->trek_kod;
            if ($request->kod)$product->kod = $request->kod;
            if ($request->weight)$product->weight = $request->weight;
            if($request->price)$product->price = $request->price;
            elseif($request->weight) $product->price = ceil($price->rate_dollar*$price->price_delivery*$request->weight);
            $product->receipt_A = now();
            $product->save();
    }
    } elseif ($status == 'dispatch_A') {
        $product = Product::where('trek_kod', $request->trek_kod)->first();
        if ($product){$this->update2($request,$product);}
         else {
            $product = new Product;
            $product->trek_kod = $request->trek_kod;
            if ($request->kod)$product->kod = $request->kod;
            if ($request->weight)$product->weight = $request->weight;
            if($request->price)$product->price = $request->price;
            elseif($request->weight) $product->price = ceil($price->rate_dollar*$price->price_delivery*$request->weight);
            $product->receipt_A = now();
            $product->dispatch_A = now();
            $product->save();
        }
    } elseif ($status == 'receipt_B') {
        // Аналогично предыдущему случаю
        $product = Product::where('trek_kod', $request->trek_kod)->first();
        if ($product){$this->update2($request,$product);}
        else {
            $product = new Product;
            $product->trek_kod = $request->trek_kod;
            if ($request->kod)$product->kod = $request->kod;
            if ($request->weight)$product->weight = $request->weight;
            if($request->price)$product->price = $request->price;
            elseif($request->weight) $product->price = ceil($price->rate_dollar*$price->price_delivery*$request->weight);
            $product->receipt_A = now();
            $product->dispatch_A = now();
            $product->receipt_B = now();
            $product->save();
        }
    } elseif ($status == 'issue') {
        $product = Product::where('trek_kod', $request->trek_kod)->first();
        if ($product){$this->update2($request,$product);}
         else {
            $product = new Product;
            $product->trek_kod = $request->trek_kod;
            if ($request->kod)$product->kod = $request->kod;
            if ($request->weight)$product->weight = $request->weight;
            if($request->price)$product->price = $request->price;
            elseif($request->weight) $product->price = ceil($price->rate_dollar*$price->price_delivery*$request->weight);
            $product->receipt_A = now();
            $product->dispatch_A = now();
            $product->receipt_B = now();
            $product->issue = now();
            $product->save();
        }
    }


    return redirect()->back()->with('success', 'Успешно добавлена.');
}
else{

    return redirect()->back()->with('error', 'Введите трек код!');

}
}


public function update(Request $request, Product $product)
{


    $price=Prices::get()->first();
    $product->update(['trek_kod' => $request->trek_kod]);
  if ($request->kod)$product->update(['kod' => $request->kod]);
  if ($request->weight)$product->update(['weight' => $request->weight]);
  $product->update(['receipt_A' => $request->receipt_A]);
  $product->update(['dispatch_A' => $request->dispatch_A]);
  $product->update(['receipt_B' => $request->receipt_B]);
  $product->update(['issue' => $request->issue]);
  if($request->price)$product->update(['price' => $request->price]);
  elseif($request->weight) $product->update(['price' => ceil($price->rate_dollar*$price->price_delivery*$request->weight)]);


    return redirect()->route('products')->with('success', 'успешно обновлена.');
}

public function update2(Request $request, Product $product)
{


    $price=Prices::get()->first();
    if ($request->kod)$product->update(['kod' => $request->kod]);
  if ($request->weight)$product->update(['weight' => $request->weight]);
  if ($request->price)$product->update(['price' => $request->price]);
  elseif($request->weight) $product->update(['price' => ceil($price->rate_dollar*$price->price_delivery*$request->weight)]);
  if ($request->status=='receipt_A'){
    $product->update(['receipt_A' => now()]);
  }elseif ($request->status=='dispatch_A'){
    if ($product->receipt_A==null){
    $product->update(['receipt_A' => now()]);
    }
    $product->update(['dispatch_A' => now()]);
  }elseif ($request->status=='receipt_B'){
    if ($product->receipt_A==null){
    $product->update(['receipt_A' => now()]);
    }
    elseif ($product->dispatch_A==null){

    $product->update(['dispatch_A' => now()]);

    }
    $product->update(['receipt_B' => now()]);
  }elseif ($request->status=='issue'){
    if ($product->receipt_A==null){
    $product->update(['receipt_A' => now()]);
    }
    elseif ($product->dispatch_A==null){
    $product->update(['dispatch_A' => now()]);
    }
    elseif ($product->receipt_B==null){

    $product->update(['receipt_B' => now()]);

    }
  $product->update(['issue' => now()]);
  }

    return redirect()->back()->with('success', 'успешно обновлена.');
}

public function filter(Request $request)
{
    $query = Product::query();

    // Применяем фильтры, если они были предоставлены в запросе
    if ($request->filled('trek_kod')) {
        $query->where('trek_kod', 'like', '%' . $request->input('trek_kod') . '%');
    }

    if ($request->filled('kod')) {
        $query->where('kod', 'like', '%' . $request->input('kod') . '%');
    }

    if ($request->filled('weight')) {
        $query->where('weight', '=', $request->input('weight'));
    }

    if ($request->filled('price')) {
        $query->where('price', '=', $request->input('price'));
    }
    if ($request->activity=='issue') {
        $query->where('receipt_A', '!=', null)->where('dispatch_A', '!=', null)->where('receipt_B', '!=', null)->where('issue', '!=', null);
    }
    elseif ($request->activity=='receipt_B') {
        $query->where('receipt_A', '!=', null)->where('dispatch_A', '!=', null)->where('receipt_B', '!=', null)->where('issue', '=', null);
    }elseif ($request->activity=="dispatch_A") {
        $query->where('receipt_A', '!=', null)->where('dispatch_A', '!=', null)->where('receipt_B', '=', null)->where('issue', '=', null);
    }
    elseif ($request->activity=="receipt_A") {
        $query->where('receipt_A', '!=', null)->where('dispatch_A', '=', null)->where('receipt_B', '=', null)->where('issue', '=', null);
    }
    // Добавьте другие условия фильтрации по необходимости

    // Получаем отфильтрованные данные
    $products = $query->get();

    return view('products.product', compact('products'))->with('success', 'Успешно обновлено.');
}

public function filterUser(Request $request)
{
    $user=$request->user();
    $price=Prices::get()->first();
    $query = Product::query();

    // Применяем фильтры, если они были предоставлены в запросе
    if ($request->filled('trek_kod')) {
        $query->where('trek_kod', 'like', '%' . $request->input('trek_kod') . '%');
    }

    $query->where('kod', $user->code);


    if ($request->filled('weight')) {
        $query->where('weight', '=', $request->input('weight'));
    }

    if ($request->filled('price')) {
        $query->where('price', '=', $request->input('price'));
    }
    if ($request->activity=='issue') {
        $query->where('receipt_A', '!=', null)->where('dispatch_A', '!=', null)->where('receipt_B', '!=', null)->where('issue', '!=', null);
    }
    elseif ($request->activity=='receipt_B') {
        $query->where('receipt_A', '!=', null)->where('dispatch_A', '!=', null)->where('receipt_B', '!=', null)->where('issue', '=', null);
    }elseif ($request->activity=="dispatch_A") {
        $query->where('receipt_A', '!=', null)->where('dispatch_A', '!=', null)->where('receipt_B', '=', null)->where('issue', '=', null);
    }
    elseif ($request->activity=="receipt_A") {
        $query->where('receipt_A', '!=', null)->where('dispatch_A', '=', null)->where('receipt_B', '=', null)->where('issue', '=', null);
    }
    // Добавьте другие условия фильтрации по необходимости

    // Получаем отфильтрованные данные
    $products = $query->get();

    return view('dashboard',[
        'products'=>$products,'user'=>$user,'price'=>$price
    ])->with('success', 'Успешно обновлено.');
}


}
