<?php

namespace App\Http\Controllers;

use App\Http\Requests\CommentRequest;
use App\Models\Comment;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    public function postComment(CommentRequest $request, $slug)
    {
        $product = Product::where('product_slug_name', $slug)->first();

        $comment = new Comment();
        $comment->product_id = $product->id;
        $comment->user_id = Auth::user()->id;
        $comment->fill($request->except('_token', '_method'));
        $comment->save();

        return redirect()->back()->with('message', 'Đăng bình luận thành công, cảm ơn bạn đã góp ý cho sản phẩm chúng tôi');
    }

    public function commentManager()
    {
        $comments = Comment::orderBy('id', 'DESC')->get();

        return view('admin.comments.comment-manager', compact('comments'));
    }

    public function changeStatusComment($id)
    {
        $comment = Comment::where('id', $id)->first();

        if ($comment) {
            if ($comment->status == 'is_hide') {
                $comment->status = 'is_show';
            } else {
                $comment->status = 'is_hide';
            }

            $comment->save();
        }

        return redirect()->back()->with('status', 'Cập nhật trạng thái bình luận thành công');
    }
}
