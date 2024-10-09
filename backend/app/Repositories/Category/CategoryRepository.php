<?

namespace App\Repositories\Category;

use App\Models\Category;
use App\Repositories\BaseRepository;
use App\Repositories\Category\CategoryRepositoryInterface;

class CategoryRepository extends BaseRepository implements CategoryRepositoryInterface{
    public function getModel(){
        return Category::class;
    }
    public function getChildrenCategory($categoryID){
        return Category::where('ParentID',$categoryID)->get();
    }
    public function getCategoryIDByName($categoryName){
        return Category::select('CategoryID')->
        where('CategoryName',$categoryName)
        ->first();
    }
    public function getAllChildrenCategoryID($parentid){
        return Category::select('CategoryID')
        ->where('ParentID',$parentid)
        ->get();
    }
    public function TraceCategories(){
        return Category::with('ParentID')->get();
    }
}