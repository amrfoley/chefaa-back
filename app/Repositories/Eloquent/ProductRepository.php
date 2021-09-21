<?php
namespace App\Repositories\Eloquent;

use App\Models\Product;
use Illuminate\Support\Facades\File;
use App\Repositories\IProductRepository;

class ProductRepository extends BaseRepository implements IProductRepository
{
    protected $model;

    public function __construct(Product $product)
    {
        $this->model = $product;
    }

    public function withPaginated($productID, $relation, $options, $perPage)
    {
        $product = $this->model->find($productID);

        return $product->$relation ?
            $product->setRelation($relation, $product->$relation()->where($options)->paginate($perPage)) : $product;
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

        if (!empty($product->image) && File::exists(public_path(substr($product->image, strpos($product->image, 'storage/'))))) {
            File::delete(public_path(substr($product->image, strpos($product->image, 'storage/'))));
        }

        $product->image = 'images/'.$fileNameToStore;
        $product->save();

        return true;
    }

    public function ajaxSearch($query)
    {
        return $this->model->select(['id', 'title'])
            ->where('title', 'LIKE', "%$query%")
            ->orwhere('sku', 'LIKE', "%$query%")
            ->get();
    }

    public function search($query, $perPage = 25)
    {
        return $this->model
            ->where('title', 'LIKE', "%$query%")
            ->orwhere('sku', 'LIKE', "%$query%")
            ->paginate($perPage);
    }
}