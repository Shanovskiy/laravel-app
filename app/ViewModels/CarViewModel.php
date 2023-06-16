<?php

namespace App\ViewModels;

class CarViewModel
{
    //protected $fillable=["brand","model","color","engine","year","description","image_url","price","discount"];
    public int $id;
    public string $brand;
    public string $model;
    public string $color;
    public float $engine;
    public int $year;
    public string $description;
    public string $imageUrl;
    public int $price;
    public float $discount;
    public bool $isFavorite;

    /**
     * @param int $id
     * @param string $brand
     * @param string $model
     * @param string $color
     * @param float $engine
     * @param int $year
     * @param string $description
     * @param string $imageUrl
     * @param int $price
     * @param float $discount
     * @param bool $isFavorite
     */
    public function __construct(int $id, string $brand, string $model, string $color, float $engine, int $year, string $description, string $imageUrl, int $price, float $discount, bool $isFavorite=false)
    {
        $this->id = $id;
        $this->brand = $brand;
        $this->model = $model;
        $this->color = $color;
        $this->engine = $engine;
        $this->year = $year;
        $this->description = $description;
        $this->imageUrl = $imageUrl;
        $this->price = $price;
        $this->discount = $discount;
        $this->isFavorite = $isFavorite;
    }


}
