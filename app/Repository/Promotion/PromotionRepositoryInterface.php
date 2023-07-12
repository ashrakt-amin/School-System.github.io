<?php
namespace App\Repository\Promotion;

interface PromotionRepositoryInterface{

    public function index();

    public function store($request);

    public function create();

    public function destroy($request);




}