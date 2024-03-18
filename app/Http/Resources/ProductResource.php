<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public static $wrap = null;

    public function toArray(Request $request): array
    {
        return [
            "id" => $this->id,
            "name" => $this->name,
            "short_description" => $this->short_description,
            "type" => $this->type,
            "unit" => $this->unit,
            "weight" => $this->weight,
            "quantity" => $this->quantity,
            "price" => $this->price,
            "sale_price" => $this->sale_price,
            "discount" => $this->discount,
            "is_featured" => $this->is_featured,
            "shipping_days" => $this->shipping_days,
            "is_cod" => $this->is_cod,
            "is_free_shipping" => $this->is_free_shipping,
            "is_sale_enable" => $this->is_sale_enable,
            "is_return" => $this->is_return,
            "is_trending" => $this->is_trending,
            "is_approved" => $this->is_approved,
            "is_external" => $this->is_external,
            "external_button_text" => $this->external_button_text,
            "external_url" => $this->external_url,
            "sale_starts_at" => $this->sale_starts_at,
            "sale_expired_at" => $this->sale_expired_at,
            "sku" => $this->sku,
            "is_random_related_products" => $this->is_random_related_products,
            "stock_status" => $this->stock_status,
            "meta_title" => $this->meta_title,
            "product_thumbnail_id" => $this->product_thumbnail_id,
            "product_meta_image_id" => $this->product_meta_image_id,
            "size_chart_image_id" => $this->size_chart_image_id,
            "estimated_delivery_text" => $this->estimated_delivery_text,
            "return_policy_text" => $this->return_policy_text,
            "safe_checkout" => $this->safe_checkout,
            "secure_checkout" => $this->secure_checkout,
            "social_share" => $this->social_share,
            "encourage_order" => $this->encourage_order,
            "encourage_view" => $this->encourage_view,
            "slug" => $this->slug,
            "status" => $this->status,
            "store_id" => $this->store_id,
            "created_by_id" => $this->created_by_id,
            "tax_id" => $this->tax_id,
            "created_at" => $this->created_at,
            "design" => $this->design,
            "designer" => $this->designer,
            "orders_count" => $this->orders_count,
            "reviews_count" => $this->reviews_count,
            "user_review" => $this->user_review,
            "can_review" => $this->can_review,
            "rating_count" => $this->rating_count,
            "order_amount" => $this->order_amount,
            "review_ratings" => $this->review_ratings,
            "related_products" => $this->related_products,
            "cross_sell_products" => $this->cross_sell_products,
            "variations" => $this->variations,
            "product_thumbnail" => $this->product_thumbnail,
            "product_meta_image" => $this->product_meta_image,
            "product_galleries" => $this->product_galleries,
            "attributes" => $this->attributes,
            "categories" => $this->categories,
            "tags" => $this->tags,
            "store" => $this->store,
            "reviews" => $this->reviews,
            "product_images" => ProductPhotoResource::collection($this->productPhotos),
        ];
    }
}
