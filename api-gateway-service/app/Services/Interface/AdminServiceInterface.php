<?php
namespace App\Services\Interface;

use Illuminate\Http\Client\Response;
use Illuminate\Http\Request;

interface AdminServiceInterface
{
    /**
     * @param Request $request
     * @return Response
     */
    public function login(Request $request): Response;

    /**
     * @param Request $request
     * @return Response
     */
    public function logout(Request $request): Response;

    /**
     * @param string $token
     * @return Response
     */
    public function getAdminByToken(string $token): Response;
}
