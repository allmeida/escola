<?php

namespace App\Service;

use App\Cliente;
use App\Formacao;
use Exception;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;

class ClienteService
{
    public static function store($request)
    {
        try {
            DB::beginTransaction();

            $cliente = Cliente::create(Arr::except($request, ['clientes','imagem_temp']));

            $cliente->update([
                'imagem' => self::uploadImagem($cliente, $request['imagem_temp'])
            ]);

            DB::commit();
            return [
                'status' => true,
                'cliente' => $cliente
            ];
        } catch (Exception $err) {
            DB::rollBack();
            return [
                'status' => false,
                'erro' => $err->getMessage()
            ];
        }
    }

    public static function getClientePorId($id)
    {
         try{
             return[
                 'status' => true,
                 'cliente' => Cliente::findOrFail($id),
                 'formacao' => Formacao::all()->pluck('nome','id')
             ];
         }catch(Exception $err)
         {
             return [
                 'status' => false,
                 'erro' => $err->getMessage()
             ];
         }
    }

    public static function update($request, $id)
    {
        try {
            DB::beginTransaction();
            $cliente = Cliente::findOrFail($id);
            $cliente->update(Arr::except($request, ['formacao', 'imagem_temp']));

            if (isset($request['imagem_temp'])) {
                $cliente->update([
                    'imagem' => self::uploadImagem($cliente, $request['imagem_temp'])
                ]);
            }

            DB::commit();
            return [
                'status' => true,
                'cliente' => $cliente
            ];
        } catch (Exception $err) {
            DB::rollBack();
            return [
                'status' => false,
                'erro' => $err->getMessage()
            ];
        }
    }

    public static function destroy($id)
    {
        try{
            $user = Cliente::findOrFail($id);
            $user->delete();
            return[
                'status' => true,
            ];
        }catch (Exception $err){
            return [
                'status' => false,
                'erro' => $err->getMessage()
            ];
        }
    }



    public static function uploadImagem($cliente, $arquivo)
    {
        $imagem =  $cliente->id . time() . "." . $arquivo->getClientOriginalExtension();
        $arquivo->move(public_path() . '/imagens/', $imagem);

        return $imagem;
    }
}
