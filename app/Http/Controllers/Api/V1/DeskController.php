<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\BaseController;
use App\Http\Requests\DeskStoreRequest;
use App\Http\Resources\DeskResource;
use App\Models\Desk;
use Illuminate\Http\Response;

class DeskController extends BaseController
{
    /**
     * Список всех досок
     */
    public function index()
    {
        //ресурс выбирает только необходимые поля
        return DeskResource::collection(Desk::all());
    }

    /**
     * Сохранить новую доску
     */
    public function store(DeskStoreRequest $request)
    {
        //метод validated нужен что бы записывались в бд только провалидированные поля, а остальные игнорировались
        $created_desk = Desk::create($request->validated());

        return new DeskResource($created_desk);
    }

    /**
     * Показать доску по id
     */
    public function show(Desk $desk)
    {
        return new DeskResource($desk);
    }

    /**
     * Изменить доску по id
     */
    public function update(DeskStoreRequest $request, Desk $desk)
    {
        $desk->update($request->validated());

        return new DeskResource($desk);
    }

    /**
     * Удалить доску по id
     */
    public function destroy(Desk $desk)
    {
        $desk->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
