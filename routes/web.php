<?php

ini_set('display_errors', 1);
error_reporting(E_ALL);

use Illuminate\Support\Facades\Route;
use \Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::prefix('/aluno')->group(function() {

    Route::get('/', function() {

        $alunos = array(
            array("matricula" => 1,
                    "nome" => "Ana"),
            array("matricula" => 2,
                    "nome" => "Bruno"),
            array("matricula" => 3,
                    "nome" => "Carol"),
            array("matricula" => 4,
                    "nome" => "Danilo"),
            array("matricula" => 5,
                    "nome" => "Ellen")
        );

        $response = "<ul>";

        foreach($alunos as $aluno) {
            $response .= "<li> {$aluno['matricula']} - {$aluno['nome']}</li>";
        }

        $response .= "</ul>";
        
        return $response;
    });

    Route::get('/limite/{id}', function($id) {

        $alunos = array(
            array("matricula" => 1,
                    "nome" => "Ana"),
            array("matricula" => 2,
                    "nome" => "Bruno"),
            array("matricula" => 3,
                    "nome" => "Carol"),
            array("matricula" => 4,
                    "nome" => "Danilo"),
            array("matricula" => 5,
                    "nome" => "Ellen")
        );

        $response = "<ul>";

        for($i = 0; $i < $id; $i++) {
            $response .= "<li> {$alunos[$i]['matricula']} - {$alunos[$i]['nome']}</li>";
        }

        $response .= "</ul>";

        return $response;
    })->where('id', '[0-9]+');

    Route::get('/matricula/{matricula}', function($matricula) {

        $alunos = array(
            array("matricula" => 1,
                    "nome" => "Ana"),
            array("matricula" => 2,
                    "nome" => "Bruno"),
            array("matricula" => 3,
                    "nome" => "Carol"),
            array("matricula" => 4,
                    "nome" => "Danilo"),
            array("matricula" => 5,
                    "nome" => "Ellen")
        );

        $achou = false;
        $response = "<ul>";

        foreach($alunos as $aluno) {
            if($aluno['matricula'] == $matricula) {
                $response .= "<li> {$aluno['matricula']} - {$aluno['nome']}</li>";
                $achou = true;
            }
        }

        $response .= "</ul>";

        if(!$achou)
            return "<h1>Aluno não encontrado</h1>";

        return $response;
    })->where('matricula', '[0-9]+');

    Route::get('/nome/{nome}', function($nome) {
        $alunos = array(
            array("matricula" => 1,
                    "nome" => "Ana"),
            array("matricula" => 2,
                    "nome" => "Bruno"),
            array("matricula" => 3,
                    "nome" => "Carol"),
            array("matricula" => 4,
                    "nome" => "Danilo"),
            array("matricula" => 5,
                    "nome" => "Ellen")
        );

        $achou = false;
        $response = "<ul>";

        foreach($alunos as $aluno) {
            if(strcasecmp($aluno['nome'], $nome) == 0) {
                $response .= "<li> {$aluno['matricula']} - {$aluno['nome']}</li>";
                $achou = true;
            }
        }

        $response .= "</ul>";

        if(!$achou)
            return "<h1>Aluno não foi encontrado</h1>";

        return $response;
    })->where('nome', '[a-zA-Z]+');
});

Route::prefix('/nota') ->group(function() {
    
    Route::get('/', function() {
        $alunos = array(
            array("matricula" => 1,
                    "nome" => "Ana",
                    "nota" => 9),
            array("matricula" => 2,
                    "nome" => "Bruno",
                    "nota" => 2),
            array("matricula" => 3,
                    "nome" => "Carol",
                    "nota" => 8),
            array("matricula" => 4,
                    "nome" => "Danilo",
                    "nota" => 6),
            array("matricula" => 5,
                    "nome" => "Ellen",
                    "nota" => 4)
        );

        $response = "<table>
                        <tr>
                            <th>Matricula</th>
                            <th>Aluno</th>
                            <th>Nota</th>
                        </tr>";

        foreach($alunos as $aluno) {
            $response .= "<tr>";
            foreach($aluno as $item) {
                $response .= "<td>{$item}</td>";
            }
            $response .= "</tr>";
        }

        $response .= "</table>";

        return $response;
    });

    Route::get('/limite/{id}', function($id) {
        $alunos = array(
            array("matricula" => 1,
                    "nome" => "Ana",
                    "nota" => 9),
            array("matricula" => 2,
                    "nome" => "Bruno",
                    "nota" => 2),
            array("matricula" => 3,
                    "nome" => "Carol",
                    "nota" => 8),
            array("matricula" => 4,
                    "nome" => "Danilo",
                    "nota" => 6),
            array("matricula" => 5,
                    "nome" => "Ellen",
                    "nota" => 4)
        );

        $response = "<table>
                        <tr>
                            <th>Matricula</th>
                            <th>Aluno</th>
                            <th>Nota</th>
                        </tr>";

        for($i = 0; $i < $id; $i++) {
            $response .= "<tr>";
            foreach($alunos[$i] as $item) {
                $response .= "<td>{$item}</td>";
            }
            $response .= "</tr>";
        }

        $response .= "</table>";

        return $response;
    })->where('id', '[0-9]+');

    Route::get('/lancar/{nota}/{matricula}/{nome?}', function($nota, $matricula, $nome=null) {
        $alunos = array(
            array("matricula" => 1,
                    "nome" => "Ana",
                    "nota" => 9),
            array("matricula" => 2,
                    "nome" => "Bruno",
                    "nota" => 2),
            array("matricula" => 3,
                    "nome" => "Carol",
                    "nota" => 8),
            array("matricula" => 4,
                    "nome" => "Danilo",
                    "nota" => 6),
            array("matricula" => 5,
                    "nome" => "Ellen",
                    "nota" => 4)
        );

        $contemAlunoNome = false;
        $contemAlunoMatricula = false;

        $response = "<table>
                        <tr>
                            <th>Matricula</th>
                            <th>Aluno</th>
                            <th>Nota</th>
                        </tr>";

        foreach($alunos as $aluno) {
            
            $response .= "<tr>";
            if($nome != null) {;
                if(strcasecmp($nome, $aluno['nome']) == 0) {
                    $aluno['nota'] = $nota;
                    $contemAlunoNome = true;
                }
            } else {
                if($matricula == $aluno['matricula']) {
                    $aluno['nota'] = $nota;
                    $contemAlunoMatricula = true;
                }
            }
            
            foreach($aluno as $item) {
                $response .= "<td>{$item}</td>";
            }

            $response .= "</tr>";
        }

        $response .= "</table>";

        if($contemAlunoNome) {
            return $response;
        } else if ($contemAlunoMatricula) {
            return $response;
        }

        return "<h1>Aluno não encontrado!!</h1>";
    })->where('nota', '[0-9]+')->where('matricula', '[0-9]+')->where('nome', '[a-zA-Z]+');

    Route::get('/conceito/{A}/{B}/{C}', function($A, $B, $C) {
        $alunos = array(
            array("matricula" => 1,
                    "nome" => "Ana",
                    "nota" => 9),
            array("matricula" => 2,
                    "nome" => "Bruno",
                    "nota" => 2),
            array("matricula" => 3,
                    "nome" => "Carol",
                    "nota" => 8),
            array("matricula" => 4,
                    "nome" => "Danilo",
                    "nota" => 6),
            array("matricula" => 5,
                    "nome" => "Ellen",
                    "nota" => 4)
        );

        $response = "<table>
                        <tr>
                            <th>Matricula</th>
                            <th>Aluno</th>
                            <th>Nota</th>
                        </tr>";

        foreach($alunos as $aluno) {
            $response .= "<tr>";

            if($aluno['nota'] >= $A) {
                $aluno['nota'] = 'A';
            } else if($aluno['nota'] >= $B) {
                $aluno['nota'] = 'B';
            } else if($aluno['nota'] >= $C) {
                $aluno['nota'] = 'C';
            } else {
                $aluno['nota'] = 'D';
            }

            foreach($aluno as $item) {
                $response .= "<td> $item </td>";
            }

            $response .= "</tr>";
        }

        $response .= "</table>";

        return $response;
    })->where('A', '[0-9]+')->where('B', '[0-9]+')->where('C', '[0-9]+');

    Route::post('/conceito', function(Request $request) {
        $alunos = array(
            array("matricula" => 1,
                    "nome" => "Ana",
                    "nota" => 9),
            array("matricula" => 2,
                    "nome" => "Bruno",
                    "nota" => 2),
            array("matricula" => 3,
                    "nome" => "Carol",
                    "nota" => 8),
            array("matricula" => 4,
                    "nome" => "Danilo",
                    "nota" => 6),
            array("matricula" => 5,
                    "nome" => "Ellen",
                    "nota" => 4)
        );

        $input = $request->all();

        $A = $input['A'];
        $B = $input['B'];
        $C = $input['C'];


        $response = "<table>
                        <tr>
                            <th>Matricula</th>
                            <th>Aluno</th>
                            <th>Nota</th>
                        </tr>";

        foreach($alunos as $aluno) {
            $response .= "<tr>";

            if($aluno['nota'] >= $A) {
                $aluno['nota'] = 'A';
            } else if($aluno['nota'] >= $B) {
                $aluno['nota'] = 'B';
            } else if($aluno['nota'] >= $C) {
                $aluno['nota'] = 'C';
            } else {
                $aluno['nota'] = 'D';
            }

            foreach($aluno as $item) {
                $response .= "<td> $item </td>";
            }

            $response .= "</tr>";
        }

        $response .= "</table>";

        return $response;
    });
});