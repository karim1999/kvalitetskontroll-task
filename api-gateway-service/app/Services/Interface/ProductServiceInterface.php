<?php
namespace App\Services\Interface;

use Illuminate\Http\Client\Response;
use Illuminate\Http\Request;

interface ProductServiceInterface
{
    /**
     * @param Request $request
     * @return Response
     */
    public function list(Request $request): Response;

    /**
     * @param Request $request
     * @param int $id
     * @return Response
     */
    public function find(Request $request, int $id): Response;

    /**
     * @param Request $request
     * @return Response
     */
    public function create(Request $request): Response;

    /**
     * @param Request $request
     * @param int $id
     * @return Response
     */
    public function update(Request $request, int $id): Response;

    /**
     * @param Request $request
     * @param int $id
     * @return Response
     */
    public function destroy(Request $request, int $id): Response;
}
