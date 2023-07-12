<?php
namespace App\Repository\Graduated;

interface GraduatedRepositoryInterface{

    public function index();

    public function softDelete($request);

    public function restore($request);

    public function create();

    public function destroy($request);




}