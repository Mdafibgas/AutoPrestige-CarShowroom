<?php


class car
{
    // Properti publik untuk atribut-atribut mobil
    public int $car_id;
    public float $price;
    public int $year;
    public string $manufacturer;
    public string $model;
    public string $image_file;
    public string $image_id;

    // Konstruktor untuk menginisialisasi objek mobil dengan nilai-nilai yang diberikan
    public function __construct(int $id, float $price, int $yr, string $manufacturer, string $model, string $image_file, string $image_id)
    {
        $this->car_id           = $id;
        $this->price            = $price;
        $this->year             = $yr;
        $this->manufacturer     = $manufacturer;
        $this->model            = $model;
        $this->image_file       = $image_file;
        $this->image_id         = $image_id;
    }
}
