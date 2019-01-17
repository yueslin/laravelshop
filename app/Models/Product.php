<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class Product extends Model
{
    
    const TYPE_NORMAL = 'normal';
    const TYPE_CROWDFUNDING = 'crowdfunding';
    public static $typeMap = [
        self::TYPE_NORMAL  => '普通商品',
        self::TYPE_CROWDFUNDING => '众筹商品',
    ];
    
    protected $fillable = [
        'title', 'description', 'image', 'on_sale','long_title',
        'rating', 'sold_count', 'review_count', 'price','type'
    ];

    protected $casts = [
        'on_sale' => 'boolean', // on_sale 是一个布尔类型的字段
    ];
    
    //众筹商品
    public  function crowdfunding()
    {
        return $this->hasOne(CrowdfundingProduct::class);
    }
    
    // 与商品SKU关联
    public function skus()
    {
        return $this->hasMany(ProductSku::class);
    }

    
    // 商品分类
    public function category()
    {
        return $this->belongsTo(Category::class);
    }


    // 查询关联
    public function properties()
    {
        return $this->hasMany(ProductProperty::class);
    }

    //拼接图片路径
    public function getImageUrlAttribute()
    {
        // 如果 image 字段本身就已经是完整的 url 就直接返回
        if (Str::startsWith($this->attributes['image'], ['http://', 'https://'])) {
            return $this->attributes['image'];
        }
        return config('custom.updateFile').$this->attributes['image'];
    }

    //商品属性访问器
    public function getGroupedPropertiesAttribute()
    {
        return $this->properties
            //按照属性名聚合，返回的集合的 key 是属性名，value是包含该属性名的所有属性集合
            ->groupBy('name')
            ->map(function ($properties){
                // 使用 map 方法将属性集合变为属性值集合
                return $properties->pluck('value')->all();
            });
    }

    // 转数据格式 方便Elasticsearch 插入数据
    public function toESArray()
    {
        // 只取出需要的字段
        $arr = array_only($this->toArray(),[
            'id',
            'type',
            'title',
            'category_id',
            'long_title',
            'on_sale',
            'rating',
            'sold_count',
            'review_count',
            'price',
        ]);

        // 如果商品有类目，则 category 字段为类目名数组，否则为空字符串
        $arr['category'] = $this->category?explode('-',$this->category->full_name) :'';
        //类目的 path 字段
        $arr['category_path'] = $this->category?$this->category->path:'';
        // strip_tags 函数可以将 html 标签去除
        $arr['description'] = strip_tags($this->description);
        //只取出需要的 SKU 字段
        $arr['sku'] = $this->skus->map(function (ProductSku $sku){
            return array_only($sku->toArray(),['title','description','price']);
        });
        // 只取出需要的商品属性字段
        $arr['properties'] = $this->properties->map(function (ProductProperty $property){
            return array_only($property->toArray(),['name','value']);
        });

        return $arr;


    }

}
