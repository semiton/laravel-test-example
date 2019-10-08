<?php

namespace App\Http\Controllers;

use App\Category;
use App\Http\Controllers\Controller;
use App\Item;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

/**
 * Class ItemsController
 * @package App\Http\Controllers\Main
 */
class ItemsController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function add(Request $request)
    {
        $category = Category::find($request->input('category'));
        if (!$category) {
            return abort(400, 'category not found');
        }

        $item = new Item;
        $item->name = $request->input('name');
        $item->save();
        $category->items()->attach($item->id);
        $category->save();

        try {
            Mail::send('emails.newitem', ['id' => $item->id], function($message)
            {
                $message->to(Config::get('mail.from.address'), Config::get('mail.from.name'))->subject('Привет!');
            });
            Log::info($item->id);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
        }


        return new JsonResponse(['id' => $item->id]);
    }
}
