<?php

namespace App\Observers;

use App\Models\Category;
use Illuminate\Support\Str;

class CategoryObserver
{
    /**
     * Handle the Category "creating" event.
     */
    public function creating(Category $category)
    {
        // Tạo slug cho danh mục
        $category->category_slug_name = Str::slug($category->category_name);
    }

    /**
     * Handle the Category "updating" event.
     */
    public function updating(Category $category)
    {
        // Cập nhật slug cho danh mục
        $category->category_slug_name = Str::slug($category->category_name);
    }

    /**
     * Handle the Category "deleting" event.
     */
    public function deleting(Category $category)
    {
        // Kiểm tra nếu danh mục có sản phẩm trước khi xóa
        if ($category->products()->count() > 0) {
            session()->flash('error', 'Không thể xóa danh mục vì danh mục này có sản phẩm.');
            return false; // Ngăn việc xóa danh mục
        }

        session()->flash('message', 'Xóa danh mục sản phẩm thành công');
    }
}

