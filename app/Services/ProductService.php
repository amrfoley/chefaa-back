<?php
namespace App\Services;

use App\Repositories\IProductRepository;
use Illuminate\Http\Request;

class ProductService 
{
    protected $productRepo;

    public function __construct(IProductRepository $productRepository)
    {
        $this->productRepo = $productRepository;
    }

    public function paginate(int $per_page = 25)
    {
        return $this->productRepo->paginate($per_page);
    }

    public function withPharmacies(int $productID, bool $availableOnly = false)
    {
        $options = $availableOnly ? [['status', '=', 1]] : [];
        return $this->productRepo->withPaginated($productID, 'pharmacies', $options, 10);
    }

    public function find(int $productID)
    {
        return $this->productRepo->find($productID);
    }

    public function destroy(int $productID)
    {
        return $this->productRepo->delete($productID);
    }

    public function search(Request $request, int $per_page = 25)
    {
        return empty($request->search) ? '' : $this->productRepo->search($request->search, $per_page);
    }

    public function ajaxSearch(Request $request)
    {
        return empty($request->search) ? '' : $this->productRepo->ajaxSearch($request->search);
    }

    public function create(Request $request)
    {

        $product = $this->productRepo->create($this->validateReq($request));

        if($request->hasFile('image'))
        {
            $this->productRepo->saveImage($request->file('image'), $product->id);
        }

        return $product;
    }

    public function update(Request $request, int $productID)
    {
        $this->productRepo->update($this->validateReq($request, $productID), $productID);

        if($request->hasFile('image'))
        {
            $this->productRepo->saveImage($request->file('image'), $productID);
        }

        return;
    }

    protected function validateReq(Request $request, int $productID = null)
    {
        $request->validate([
            'title'         => 'required|max:160',
            'description'   => 'required|max:260',
            'image'         => 'image|mimes:jpeg,png,jpg,gif,svg|max:200',
            'sku'           => 'required|unique:products,sku'.($productID !== null ? ",$productID" : '')
        ]);

        return $request->only(['title', 'description', 'sku']);
    }
}