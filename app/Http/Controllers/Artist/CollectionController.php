<?php

namespace App\Http\Controllers\Artist;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Collection;
use App\Models\Post;

class CollectionController extends Controller
{
    public function index(Collection $collectionModel, Post $postModel, $collection_id=0){
        $default = 0;
        $collections = $collectionModel->select("*")->orderBy("id", "DESC")->get();

        foreach($collections as  $index => $item){
            if($item["id"]==$collection_id){
                $default = $index;
                break;
            }
        }
        
        if($default==0){
            $post = count($collections) > 0 ? $postModel->where("collection_id", $collections[0]->id)->get() : [];
        }else $post = count($collections) > 0 ? $postModel->where("collection_id", $collection_id)->get() : [];

        $postDefault=0;
        foreach($post as  $index => $item){
            if($item["id"]==$collections[0]["main_post_id"]){
                $postDefault = $index;
                break;
            }
        };

        return view("artist.collection", compact("collections","post","default","postDefault"));
    }
}
