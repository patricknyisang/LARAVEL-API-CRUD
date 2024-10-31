<?php

namespace App\Http\Controllers;

use App\Models\TBMaritalStatus;
use App\Models\TBGender;
use App\Models\TBMuteStatus;
use App\Models\TBUsers;
use App\Models\TBProducts;
use App\Models\TBCategories;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Log;

use Carbon\Carbon;

class ProductController extends Controller
{

      
  
    
        // Delete a product by ID
        public function deleteproduct($id)
        {
            try {
                $product = TBProducts::findOrFail($id);
                $product->delete();
                return response()->json(['error' => false, 'message' => 'Task deleted successfully'], 200);
            } catch (\Exception $e) {
                return response()->json(['error' => true, 'message' => $e->getMessage()], 500);
            }
        }
    
        // Update product by ID
        public function updatetproduct(Request $request, $id)
        {
            $nameofproduct = $request->get('productname');  
            $productcost = $request->get('productprice');
            $quantity = $request->get('StockQuantity');
            
    
            try {
                $task = TBtask::findOrFail($id); // Use findOrFail to handle not found
                $task->update([
                    "productname" => $nameofproduct,
                    "productprice" => $productcost,
                    "ProductStockQuantity" => $quantity,
                     
                ]);
    
                return response()->json(['error' => false, 'message' => 'Task updated successfully'], 200);
            } catch (\Exception $e) {
                return response()->json(['error' => true, 'message' => $e->getMessage()], 500);
            }
        }



        
    public function storeproduct(Request $request)
    {
        try {
           
            $categoryid = $request->get('CategoryId');
            $productName = $request->get('ProductName');
            $productprice = $request->get('ProductPrice');
            $productstock = $request->get('ProductStock');
            $productimage = $request->get('ProductImage');
        
    
         
            $products = [
                'categoryid' => $categoryid,
                'productname' => $productName,
                'productprice' => $productprice,
                'ProductStockQuantity' => $productstock,
                'ProductImage' => $productimage,
                
            ];
    
            TBProducts::create($products);
    
          
    
            // Return a JSON success response
            return response()->json(['message' => 'Product created successfully'], 201);
    
        } catch (\Exception $e) {
            // Catch and return any exception as a JSON response
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }


        public function getproducts(){   
            try {
            $productses = TBProducts:: all();
            $products= [];
            foreach($productses as $product) {
                $products[] = [
                    "id" => $product->{'productid'},
                    "catid" => $product->{'categoryid'},
                    "productname" => $product->{'productname'},
                    "price" => $product->{'productprice'},
                    "quantity" => $product->{'ProductStockQuantity'},
                    "image" => $product->{'ProductImage'},
                
                ];
                
             
            }
            return response()->json($products, 200);
        } catch (\Exception $e) {
            return response()->json([
                'error' => true,
                'message' => $e->getMessage()
            ], 400);
        }
            
        }


        public function getebookproducts(){   
            try {
            $productses = TBProducts:: getWhere(['categoryid'=>1]);
            $products= [];
            foreach($productses as $product) {
                $products[] = [
                    "id" => $product->{'productid'},
                    "catid" => $product->{'categoryid'},
                    "productname" => $product->{'productname'},
                    "price" => $product->{'productprice'},
                    "quantity" => $product->{'ProductStockQuantity'},
                    "image" => $product->{'ProductImage'},
                
                ];
                
             
            }
            return response()->json($products, 200);
        } catch (\Exception $e) {
            return response()->json([
                'error' => true,
                'message' => $e->getMessage()
            ], 400);
        }
            
        }

        public function getmusicproducts(){   
            try {
            $productses = TBProducts:: getWhere(['categoryid'=>2]);
            $products= [];
            foreach($productses as $product) {
                $products[] = [
                    "id" => $product->{'productid'},
                    "catid" => $product->{'categoryid'},
                    "productname" => $product->{'productname'},
                    "price" => $product->{'productprice'},
                    "quantity" => $product->{'ProductStockQuantity'},
                    "image" => $product->{'ProductImage'},
                
                ];
                
             
            }
            return response()->json($products, 200);
        } catch (\Exception $e) {
            return response()->json([
                'error' => true,
                'message' => $e->getMessage()
            ], 400);
        }
            
        }


        public function getvideoproducts(){   
            try {
            $productses = TBProducts:: getWhere(['categoryid'=>3]);
            $products= [];
            foreach($productses as $product) {
                $products[] = [
                    "id" => $product->{'productid'},
                    "catid" => $product->{'categoryid'},
                    "productname" => $product->{'productname'},
                    "price" => $product->{'productprice'},
                    "quantity" => $product->{'ProductStockQuantity'},
                    "image" => $product->{'ProductImage'},
                
                ];
                
             
            }
            return response()->json($products, 200);
        } catch (\Exception $e) {
            return response()->json([
                'error' => true,
                'message' => $e->getMessage()
            ], 400);
        }
            
        }

        public function getondemanproducts(){   
            try {
            $productses = TBProducts:: getWhere(['categoryid'=>4]);
            $products= [];
            foreach($productses as $product) {
                $products[] = [
                    "id" => $product->{'productid'},
                    "catid" => $product->{'categoryid'},
                    "productname" => $product->{'productname'},
                    "price" => $product->{'productprice'},
                    "quantity" => $product->{'ProductStockQuantity'},
                    "image" => $product->{'ProductImage'},
                
                ];
                
             
            }
            return response()->json($products, 200);
        } catch (\Exception $e) {
            return response()->json([
                'error' => true,
                'message' => $e->getMessage()
            ], 400);
        }
            
        }


        public function getcategories(){   
            try {
            $categorieses = TBCategories:: all();
            $categories= [];
            foreach($categorieses as $cat) {
                $categories[] = [
                    "id" => $cat->{'categoryid'},
                    "category" => $cat->{'categoryname'},
                
                ];
                
              
            }
            return response()->json($categories, 200);
        } catch (\Exception $e) {
            return response()->json([
                'error' => true,
                'message' => $e->getMessage()
            ], 400);
        }
            
        }

}