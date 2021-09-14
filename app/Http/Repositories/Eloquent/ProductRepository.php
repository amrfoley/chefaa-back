<?php
namespace App\Http\Repositories\Eloquent;

use App\Models\Product;
use Illuminate\Support\Facades\File;
use App\Http\Repositories\IProductRepository;

class ProductRepository extends BaseRepository implements IProductRepository
{
    protected $model;

    public function __construct(Product $product)
    {
        $this->model = $product;
    }

    public function with($productID, $relation, $relationID)
    {
        $product = $this->model->find($productID);

        return $product->$relation ? 
            $product->setRelation($relation, $product->$relation()->find($relationID)) : $product;
    }

    public function withPaginated($productID, $relation, $perPage)
    {
        $product = $this->model->find($productID);

        return $product->$relation ?
            $product->setRelation($relation, $product->$relation()->paginate($perPage)) : $product;
    }

    public function saveImage($imageFile, $productID)
    {
        // Get filename with the extension
        $filenameWithExt = $imageFile->getClientOriginalName();
        // Get just filename
        $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
        // Get just ext
        $extension = $imageFile->getClientOriginalExtension();
        // Filename to store
        $fileNameToStore= $filename.'_'.time().'.'.$extension;
        // Upload Image
        $imageFile->storeAs('public/images', $fileNameToStore);

        $product = $this->model->find($productID);
        
        // Delete Old Image
        if (File::exists(public_path('storage/'.$product->image))) {
            File::delete(public_path('storage/'.$product->image));
        }

        $product->image = 'images/'.$fileNameToStore;
        $product->save();

        return true;
    }

    public function search($query)
    {
        return $this->model->select(['id', 'title'])
            ->where('title', 'LIKE', "%$query%")
            ->orwhere('sku', 'LIKE', "%$query%")
            ->get();
    }
}