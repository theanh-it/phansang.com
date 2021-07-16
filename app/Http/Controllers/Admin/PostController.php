<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Collection;
use App\Models\Post;
use App\Services\Translate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Session;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class PostController extends Controller
{
    protected $translate_service;

    public function __construct(Translate $translate_service)
    {
        $this->translate_service = $translate_service;
    }

    public function index(Request $request, $collection_id)
    {
        $posts = $this->list_posts_paginate($collection_id);
        return view('admin.post.index')->with([
            'collection_id' => $collection_id,
            'posts' => $posts
        ]);
    }

    public function add(Request $request, $collection_id)
    {
        return view('admin.post.add_or_edit')->with([
            'collection_id' => $collection_id
        ]);
    }

    public function edit(Request $request, $id)
    {
        $post = null;

        if ($id) {
            $post = Post::find($id);
        }

        return view('admin.post.add_or_edit')->with([
            'post' => $post
        ]);
    }

    public function create(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'required',
            'image' => 'required|mimes:jpeg,png,jpg|max:8096',
        ]);
        $collection_id = (int)$request->get('collection_id');
        $name = $request->get('name') ? $request->get('name') : "";
        $description = $request->get('description') ? $request->get('description') : "";
        $detail = $request->get('detail') ? $request->get('detail') : "";
        $content_qr = $request->get('content_qr') ? $request->get('content_qr') : "";
        $image_name = "";
        if ($request->hasFile('image')) {
            $arr_image_name = explode('.', $request->file('image')->getClientOriginalName());
            $image_name = $arr_image_name[0] . '-' . time() . '.' . $arr_image_name[1];
            $request->file('image')->move(public_path('images'), $image_name);
        }
        Post::create([
            'image' => $image_name,
            'collection_id' => $collection_id,
            'description' => $description,
            'content_qr' => $content_qr,
            'description_en' => $this->translate_service->gg_translate('vi', 'en', $description),
            'description_fr' => $this->translate_service->gg_translate('vi', 'fr', $description),
            'detail' => $detail,
            'detail_en' => $this->translate_service->gg_translate('vi', 'en', $detail),
            'detail_fr' => $this->translate_service->gg_translate('vi', 'fr', $detail),
            'name' => $name,
            'name_en' => $this->translate_service->gg_translate('vi', 'en', $name),
            'name_fr' => $this->translate_service->gg_translate('vi', 'fr', $name),
        ]);
        return redirect()->back()->with('success', 'Thêm Thành Công.');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'description' => 'required',
        ]);

        $post = Post::find($id);

        if ($post) {
            $name = $request->get('name') ? $request->get('name') : "";
            $description = $request->get('description') ? $request->get('description') : "";
            $detail = $request->get('detail') ? $request->get('detail') : "";
            $content_qr = $request->get('content_qr') ? $request->get('content_qr') : "";
            $arr_update_data = [
                'content_qr' => $content_qr,
                'description' => $description,
                'description_en' => $this->translate_service->gg_translate('vi', 'en', $description),
                'description_fr' => $this->translate_service->gg_translate('vi', 'fr', $description),
                'detail' => $detail,
                'detail_en' => $this->translate_service->gg_translate('vi', 'en', $detail),
                'detail_fr' => $this->translate_service->gg_translate('vi', 'fr', $detail),
                'name' => $name,
                'name_en' => $this->translate_service->gg_translate('vi', 'en', $name),
                'name_fr' => $this->translate_service->gg_translate('vi', 'fr', $name),
            ];
            if ($request->hasFile('image')) {
                $request->validate([
                    'image' => 'required|mimes:jpeg,png,jpg|max:8096',
                ]);
                $arr_image_name = explode('.', $request->file('image')->getClientOriginalName());
                $image_name = $arr_image_name[0] . '-' . time() . '.' . $arr_image_name[1];
                $request->file('image')->move(public_path('images'), $image_name);
                //delete old image
                if (file_exists(public_path('images/') . $post['image'])) {
                    unlink(public_path('images/') . $post['image']);
                }
                $arr_update_data = array_merge($arr_update_data, [
                    'image' => $image_name,
                ]);
            }
            Post::where('id', $id)->update($arr_update_data);
            return redirect()->back()->with('success', 'Sửa Thành Công.');
        }
        return redirect()->back();
    }

    public function destroy(Request $request, $id)
    {
        $post = Post::find($id);
        if ($post) {
            //delete old image
            if (file_exists(public_path('images/') . $post['image'])) {
                unlink(public_path('images/') . $post['image']);
            }
            $post->delete();
        }
        return redirect()->back()->with('success', 'Xóa Thành Công.');
    }

    public function list_posts_paginate($collection_id)
    {
        return Post::where('collection_id', $collection_id)->orderBy('id', 'desc')->paginate(Config::get('constants.paginate_admin'));
    }

    public function posts_by_collection(Request $request, $collection_id)
    {
        $posts = Post::where('collection_id', $collection_id)->orderBy('id', 'desc')->paginate(2);

        return view('ui.components.image_collection_v2')->with([
            'posts' => $posts,
        ]);
    }

    public function language_content(Request $request, $post_id)
    {
        Post::where('id', $post_id)
            ->update([
                'description_en' => $request->get('description_en'),
                'description_fr' => $request->get('description_fr'),
            ]);

        return redirect()->back()->with('success', 'Sửa Thành Công.');
    }

    public function get_qr(Request $request, $post_id)
    {
        if ($post_id) {
            $host = $request->getHttpHost();
            $url = 'https://' . $host . '/mo-ta-tac-pham/' . $post_id;
            $qr = QrCode::format('png')
                ->size(200)->errorCorrection('H')
                ->generate($url);
            return view('admin.post.get_qr')->with([
                'qr' => $qr
            ]);
        }
    }

    public function get_detail_post(Request $request, $post_id)
    {
        $post = null;
        $collection = null;
        if ($post_id) {
            $post = Post::find($post_id);
            $collection = Collection::find($post->collection_id);
        }
        return view('ui.detail_post_v2')->with([
            'post' => $post,
            'collection' => $collection
        ]);
    }
}
