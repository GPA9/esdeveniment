<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use App\Models\Esdeveniment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EsdevenimentController extends Controller
{
    /**
     * Muestra una lista de eventos con sus categorías.
     */
    public function index()
    {   
        $esdeveniments = Esdeveniment::orderBy('nom', 'asc')->paginate(8);
        $categories = Categoria::all();

        return view('esdevenimen.index', compact('esdeveniments', 'categories'));
    }

    /**
     * Muestra el formulario para crear un nuevo evento.
     */
    public function create()
    {
        $categories = Categoria::all();
        return view('esdevenimen.create', compact('categories'));
    }

    /**
     * Guarda un nuevo evento en la base de datos.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nom' => 'required|max:255',
            'descripcio' => 'nullable|string',
            'data' => 'required|date',
            'hora' => 'required|date_format:H:i',
            'num_max_assistents' => 'nullable|integer|min:1',
            'edat_minima' => 'nullable|integer|min:0',
            'imatge' => 'nullable|url',
            'categoria_id' => 'required|exists:categorias,id'
        ]);

        Esdeveniment::create($request->all());

        return redirect()->route('esdevenimen.index')->with('success', 'Evento creado correctamente!');
    }

    /**
     * Muestra los detalles de un evento.
     */
    public function show(string $id)
    {
        $esdeveniment = Esdeveniment::findOrFail($id);

        $disponible = $esdeveniment->seientsDisponibles(); // Calculo les entrades disponibles amb el mètode correcte.
        return view('esdevenimen.show', compact('esdeveniment', 'disponible'));
    }

    

    /**
     * Muestra el formulario para editar un evento existente.
     */
    public function edit(string $id)
    {
        $esdeveniment = Esdeveniment::findOrFail($id);
        $categories = Categoria::all();

        return view('esdevenimen.edit', compact('esdeveniment', 'categories'));
    }

    /**
     * Actualiza un evento existente.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'nom' => 'required|max:255',
            'descripcio' => 'nullable|string',
            'data' => 'required|date',
            'hora' => 'required|date_format:H:i',
            'num_max_assistents' => 'nullable|integer|min:1',
            'edat_minima' => 'nullable|integer|min:0',
            'imatge' => 'nullable|url',
            'categoria_id' => 'required|exists:categorias,id'
        ]);

        $esdeveniment = Esdeveniment::findOrFail($id);
        $esdeveniment->update($request->all());

        return redirect()->route('esdevenimen.index')->with('success', 'Evento actualizado correctamente!');
    }

    /**
     * Filtra eventos por categoría.
     */
    public function byCategory($id)
    {
        $categoria = Categoria::findOrFail($id);
        $esdeveniments = $categoria->esdeveniments()->paginate(8);

        return view('esdevenimen.index', ['esdeveniments' => $esdeveniments, 'categoriaNom' => $categoria->nom]);
    }

    /**
     * Elimina un evento de la base de datos.
     */
    public function destroy(string $id)
    {
        Esdeveniment::findOrFail($id)->delete();
        return redirect()->route('esdevenimen.index')->with('success', 'Evento eliminado correctamente!');
    }

    // Mètode per reservar plaça per a un esdeveniment, amb diverses comprovacions, abans de reservar
    public function reserve(Request $request, $id)
    {
        // Recuperem l'esdeveniment i l'usuari autenticat
        $esdeveniment = Esdeveniment::findOrFail($id);
        $usuari = Auth::user();

        // Verifico que l'usuari tingui la seva edat definida
        if (!$usuari->age) {
            return redirect()->back()->with('error', 'Has de completar la teva edat.');
        }

        // Utilitzo directament l'edat ja registrada a la BD
        $age = $usuari->age;

        // Verifico que l'usuari compleixi l'edat mínima requerida per l'esdeveniment.
        if ($age < $esdeveniment->edat_minima) {
            return redirect()->back()->with('error', 'No compleixes el requisit de l\'edat mínima per aquest esdeveniment.');
        }

        // Verifico que encara hi hagi entrades disponibles.
        if ($esdeveniment->seientsDisponibles() <= 0) {
            return redirect()->back()->with('error', 'No queden entrades disponibles per aquest esdeveniment.');
        }

        // Evitem reserves duplicades comprovant si l'usuari ja ha reservat aquest esdeveniment.
        if ($esdeveniment->usuaris()->where('user_id', $usuari->id)->exists()) {
            return redirect()->back()->with('error', 'Ja has reservat aquest esdeveniment.');
        }

        // Registro la reserva afegint l'usuari a la relació many-to-many de l'esdeveniment.
        $esdeveniment->usuaris()->attach($usuari->id);

        return redirect()->back()->with('success', 'Reserva realitzada correctament!');
    }

    // funcio per cancelar reserva
    public function cancelarReserva($id)
    {
        // Recuperem l'esdeveniment i l'usuari autenticat
        $esdeveniment = Esdeveniment::findOrFail($id);
        $usuari = Auth::user();

        // tot i que a la vista show ja comprobo que el usuari no pugui cancelar reserva si no ha fet una previament,
        // aixo es una comprovacio per saber si el usuari ha fet una reserva
        if (!$esdeveniment->usuaris()->where('user_id', $usuari->id)->exists()) {
            return redirect()->back()->with('error', 'No tens cap reserva en aquest esdeveniment.');
        }
        
        // treiem el registre del usuari sobre el esdeveniment
        $esdeveniment->usuaris()->detach($usuari->id);

        return redirect()->back()->with('success', 'Reserva cancel·lada correctament.');
    }
}