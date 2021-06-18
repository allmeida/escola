<?php

namespace App\Services;

use App\Formacao;
use Exception;

class FormacaoService
{
    public static function store($request)
    {
        try {
            return [
                'status' => true,
                'user' => Formacao::create($request)
            ];
        } catch (Exception $erro) {
            return [
                'status' => false,
                'erro' => $erro->getMessage()
            ];
        }
    }

    public static function getFormacaoPorId($id)
    {
        try {
            $user = Formacao::findOrFail($id);
            return [
                'status' => true,
                'formacao' => $user
            ];
        } catch (Exception $erro) {
            return [
                'status' => false,
                'erro' => $erro->getMessage()
            ];
        }
    }

    public static function update($request, $id)
    {
        try {
            $user = Formacao::findOrFail($id);
            $user->update($request);
            return [
                'status' => true,
                'user' => $user
            ];
        } catch (Exception $erro) {
           return [
            'status' => false,
            'erro' => $erro->getMessage()
           ];
        }
    }

    public static function destroy($id)
    {
        try {
            $user = Formacao::findOrFail($id);
            $user->delete();
            return [
                'status' => true,
            ];
        } catch (Exception $erro) {
            return [
                'status' => false,
                'erro' => $erro->getMessage()
            ];
        }
    }
}