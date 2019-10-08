<?php

namespace App\Http\Controllers;

use App\Category;
use App\Http\Controllers\Controller;
use App\Item;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

/**
 * Class CategoriesController
 * @package App\Http\Controllers\Main
 */
class CategoriesController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function list(Request $request)
    {
        $categories = Category::withCount(['items'])->paginate(10);

        return new JsonResponse($categories);
    }
}
