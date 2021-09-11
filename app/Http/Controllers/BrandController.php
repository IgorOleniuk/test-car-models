<?php

namespace App\Http\Controllers;

use App\Http\Resources\BrandCollection;
use App\Http\Resources\BrandResource;
use App\Jobs\SendConfirmBrandDeleteEmail;
use App\Models\Brand;
use App\Services\BrandService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class BrandController extends Controller
{
    public $brandService;

    public function __construct(BrandService $brandService)
    {
        $this->brandService = $brandService;
    }

    public function getPaginatedBrands(): JsonResource
    {
        return BrandCollection::collection(Brand::paginate(10));
    }

    public function createBrand(Request $request): BrandResource
    {
        return new BrandResource($this->brandService->saveOrUpdateBrand($request));
    }

    public function updateBrand(Request $request, int $id): BrandResource
    {
        return new BrandResource($this->brandService->saveOrUpdateBrand($request, $id));
    }

    public function sendConfirmationToDeleteBrand(Brand $brand): JsonResponse
    {
        // create delete confirmation token and save it to the brand
        $this->brandService->createConfirmationToken($brand);
        // dispatch the job for queuing the sending of the confirmation email
        SendConfirmBrandDeleteEmail::dispatch($brand, Auth::user());

        return response()->json(['message' => 'Confirmation email was sent to your email!']);
    }

    public function deleteBrandConfirmed(int $id, string $token)
    {
        $brand = Brand::findOrFail($id);
        if ($brand->token->confirmation_token !== $token) {
            abort(422, 'The confirmation link has expired');
        }

        $brand->token()->delete();
        $brand->car_models()->delete();
        $brand->delete();

        Session::flash('message','The brand and all of its models have been deleted successfully');
        return redirect('/brands');
    }
}
