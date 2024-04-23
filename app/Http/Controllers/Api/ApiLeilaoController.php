<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\LeilaoRequest;
use App\Repositories\ILeilaoRepository;
use Illuminate\Http\Request;
use App\Models\Leilao;

class ApiLeilaoController extends Controller
{

    public function __construct(private ILeilaoRepository $repository)
    {
        
    }

    public function healthCheck()
    {
        return response()->json([
            'status' => 'ok',
            'leilao' => 'Leilão API',
            'versao' => '1.0.0'
        ]);
    }
    
    public function index(Request $request)
    {
        $status = $request->query('status');
    
        if ($status) {
            $leiloes = Leilao::where('status', strtoupper($status))->get();
            if ($leiloes->isEmpty()) {
                return response()->json(['message' => 'Nenhum leilão encontrado com o status ' . $status], 404);
            }
            return $leiloes;
        }
    
        $leiloes = Leilao::all();
        if ($leiloes->isEmpty()) {
            return response()->json(['message' => 'Nenhum leilão encontrado'], 404);
        }
    
        return $leiloes;
    }

    public function store(LeilaoRequest $request)
    {
        $leilao = $this->repository->add($request);

        return response()->json($leilao);
    }

    public function update(Request $request, $id)
    {
        $leilao = Leilao::findOrFail($id);
        $leilao->update($request->all());

        return response()->json([
            'mensagem' => 'Leilão atualizado com sucesso'
        ]);
    }

    public function destroy($id)
    {
        $leilao = Leilao::findOrFail($id);
        $leilao->delete();
    
        return response()->json([
            'mensagem' => 'Leilão deletado com sucesso'
        ]);
    }

    public function show($id)
    {
        try {
            $leilao = Leilao::findOrFail($id);
            return response()->json(['mensagem' => 'Leilão encontrado!', 'leilao' => $leilao], 200);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response()->json(['mensagem' => 'Leilão não encontrado!'], 404);
        }
    }

    public function finalizarLeilao($id)
    {
        $leilao = Leilao::findOrFail($id);
        $leilao->status = 'FINALIZADO';
        $leilao->save();

        return response()->json([
            'mensagem' => 'Leilão finalizado com sucesso'
        ]);
    }

    
}
