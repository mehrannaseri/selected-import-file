<?php

namespace App\Services\Importer;

use App\Models\Catalog;
use App\Models\Category;
use App\Models\Item;
use App\Models\ItemWarehouse;
use App\Models\Warehouse;
use Exception;

class JsonImporter implements ImporterInterface
{
    private $file;
    public Category $category_model;
    public Catalog $catalog_model;
    public Item $item_model;
    public Warehouse $warehouse_model;
    public ItemWarehouse $itemWarehouse_model;

    public function __construct($file)
    {
        $this->file = $file;
        $this->category_model = new Category();
        $this->catalog_model = new Catalog();
        $this->item_model = new Item();
        $this->warehouse_model = new Warehouse();
        $this->itemWarehouse_model = new ItemWarehouse();
    }

    public function readFile() :array|Exception
    {
        $file_content = file_get_contents($this->file['tmp_name']);
        $file_content = json_decode($file_content);

        if(count($file_content) == 0){
            throw new Exception("The selected file is empty", 400);
        }

        return $file_content;
    }


    public function saveData(array $fileData)
    {
        foreach ($fileData as $data){

            $category_id = $this->category_model->insertIfNotExists([
                'category_id' => $data->Category_ID,
                'title' => $data->Category
            ]);

            $sub_category_id = $this->category_model->insertIfNotExists([
                'category_id' => $data->SubCategory_ID,
                'title' => $data->SubCategory
            ]);

            $catalog_id =  $this->catalog_model->insert([
                'product_id' => $data->Product_ID,
                'NR' => $data->NR,
                'name' => $data->Name,
                'url' => $data->Product_URL,
                'keywords' => $data->Search_Keywords,
                'description' => $data->Description,
                'category_id' => $category_id,
                'sub_category_id' => $sub_category_id,
                'brand' => $data->Brand,
            ]);


            foreach ($data->Items as $item){
                $item_id = $this->item_model->insert([
                    'catalog_id' => $catalog_id,
                    'SKU' => $item->SKU,
                    'price' => $item->Price,
                    'retail_price' => $item->Retail_Price,
                    'thumbnail_url' => $item->Thumbnail_URL,
                    'color' => $item->Color,
                    'color_family' => $item->Color_Family,
                    'size' => is_string($item->Size) ? $item->Size : "Invalid format",
                    'size_family' => is_string($item->Size_Family) ? $item->Size_Family : "Invalid format",
                    'occassion' => json_encode($item->Occassion),
                    'season' => json_encode($item->Season),
                    'rating_avg' => $item->Rating_Avg,
                    'rating_count' => $item->Rating_Count,
                    'active' => isset($item->Active) ? $item->Active : 0
                ]);


                foreach ($item->Warehouse as $key => $value){
                    $warehouse_id = $this->warehouse_model->insertIfNotExists([
                        'name' => $key
                    ]);

                    $this->itemWarehouse_model->insert([
                        'item_id' => $item_id,
                        'warehouse_id' => $warehouse_id,
                        'inventory_count' => $value->Inventory_Count
                    ]);
                }

            }

        }

        return true;
    }
}