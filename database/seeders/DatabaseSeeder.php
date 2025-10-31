<?php

namespace Database\Seeders;

use App\Models\Esdeveniment;
use App\Models\Categoria;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run()
    {
        // Poblar usuarios
        self::seedUsers();
        $this->command->info('Taula usuaris inicialitzada amb dades!');

        // Poblar categorías
        self::seedCategorias();
        $this->command->info('Taula categories inicialitzada amb dades!');

        // Poblar eventos
        self::seedEsdeveniments();
        $this->command->info('Taula esdeveniments inicialitzada amb dades!');

        $this->call(AdminSeeder::class);
    }

    // creem unes categories basiques a la base de dades
        private function seedCategorias()
    {
        DB::table('categorias')->delete();

        Categoria::insert(array(
            array('nom' => 'Música'),
            array('nom' => 'Teatre'),
            array('nom' => 'Cinema'),
            array('nom' => 'Màgia'),
            array('nom' => 'Monòlegs'),
        ));
    }

    // funcio on es creen els events de la array de esdeveniments que trobarem al final del codi
    private function seedEsdeveniments()
    {
        DB::table('esdeveniments')->delete();

        foreach ($this->arrayEsdeveniments as $event) {
            $e = new Esdeveniment();
            $e->nom = $event['nom'];
            $e->data = $event['data'];
            $e->hora = $event['hora'];
            $e->descripcio = $event['descripcio'];
            $e->imatge = $event['imatge'];
            $e->num_max_assistents = $event['num_max_assistents'];
            $e->edat_minima = $event['edat_minima'];
            $e->categoria_id = $event['categoria_id'];
            $e->save();
        }
    }

    // funcio de usuaris que sempre es crearan tot i que formatem les dades de la base de dades
    private function seedUsers()
    {
        DB::table('users')->delete();

        $user = new User();
        $user->name = 'Calamardo';
        $user->email = 'calamardo@clarinete.com';
        $user->age = 40;
        $user->rol = 'Usuari';
        $user->password = bcrypt('12345');
        $user->save();

        $user = new User();
        $user->name = 'Bob Esponja';
        $user->email = 'bobEsponja@gary.com';
        $user->age = 23;
        $user->rol = 'Usuari';
        $user->password = bcrypt('54321');
        $user->save();
    }

    // array de esdeveniments per tenir uns esdeveniments predeterminats a la base de dades
    private $arrayEsdeveniments = array(
        array(
            'nom' => 'Concert de Rock',
            'data' => '2025-07-15',
            'hora' => '20:30',
            'descripcio' => 'Una nit plena d’energia amb les millors bandes de rock.',
            'imatge' => 'https://www.madnesslive.es/img/cms/posters/rockthesun_2025_web_1.jpg',
            'num_max_assistents' => 200,
            'edat_minima' => 16,
            'categoria_id' => 1,
        ),
        array(
            'nom' => 'Festival de Cinema Independent',
            'data' => '2025-08-22',
            'hora' => '19:00',
            'descripcio' => 'Descobreix les millors pel·lícules d’autor en un festival únic.',
            'imatge' => 'https://www.recursosculturales.com/wp-content/uploads/2022/08/Festival-de-Cine-Claypole-2023.jpeg',
            'num_max_assistents' => 125,
            'edat_minima' => 18,
            'categoria_id' => 3,
        ),
        array(
            'nom' => 'Espectacle de Màgia',
            'data' => '2025-06-10',
            'hora' => '17:00',
            'descripcio' => 'Un show de màgia per a tota la família amb trucs increïbles.',
            'imatge' => 'https://tamtampress.es/wp-content/uploads/2022/12/captura-de-pantalla-2022-12-01-a-las-18.06.39.png?w=640',
            'num_max_assistents' => 100,
            'edat_minima' => 5,
            'categoria_id' => 4,
        ),
        array(
            'nom' => 'Marató de Monòlegs',
            'data' => '2025-09-05',
            'hora' => '21:00',
            'descripcio' => 'Els millors humoristes del moment en una nit plena de rialles.',
            'imatge' => 'https://mundoescenico.gal/wp-content/uploads/2021/03/2020_festival-singular-naron.jpg',
            'num_max_assistents' => 250,
            'edat_minima' => 18,
            'categoria_id' => 5,
        ),
        array(
            'nom' => 'Teatre Clàssic: Hamlet',
            'data' => '2025-10-12',
            'hora' => '19:30',
            'descripcio' => 'Una representació espectacular del clàssic de Shakespeare.',
            'imatge' => 'https://www.laperla29.cat/img/image/fotos/cartellverd.jpg?w=600&h=600&zc=1&aoe=1&q=80',
            'num_max_assistents' => 180,
            'edat_minima' => 12,
            'categoria_id' => 2,
        ),
        array(
            'nom' => 'Nit d’Il·lusionisme',
            'data' => '2025-07-28',
            'hora' => '22:00',
            'descripcio' => 'Trucs de màgia sorprenents que et deixaran sense paraules.',
            'imatge' => 'https://www.aytoreinosa.es/wp-content/uploads/2025/02/Festival-de-Ilusionismo-25.jpg',
            'num_max_assistents' => 90,
            'edat_minima' => 10,
            'categoria_id' => 4,
        ),
        array(
            'nom' => 'Festival de Jazz',
            'data' => '2025-08-30',
            'hora' => '20:00',
            'descripcio' => 'Gaudeix del millor jazz en viu amb artistes internacionals.',
            'imatge' => 'https://www.toledo.es/wp-content/uploads/2024/08/cartel-festival-jazz-848x1200.jpg',
            'num_max_assistents' => 120,
            'edat_minima' => 14,
            'categoria_id' => 1,
        ),
        array(
            'nom' => 'Torneig de Poesia Slam',
            'data' => '2025-09-20',
            'hora' => '18:30',
            'descripcio' => 'Competició de poesia oral amb els millors artistes.',
            'imatge' => 'https://www.alhambra-patronato.es/wp-content/uploads/2025/04/Festival-de-poesia.jpg',
            'num_max_assistents' => 100,
            'edat_minima' => 18,
            'categoria_id' => 5,
        ),
        array(
            'nom' => 'Festival de Dansa Contemporània',
            'data' => '2025-10-05',
            'hora' => '20:00',
            'descripcio' => 'Espectacles increïbles amb les millors companyies de dansa.',
            'imatge' => 'https://www.ciudadreal.es/images/2023/abril/14_Programa_A3_CARTEL.jpg',
            'num_max_assistents' => 160,
            'edat_minima' => 10,
            'categoria_id' => 2,
        ),
        array(
            'nom' => 'Nit de Ciència i Astronomia',
            'data' => '2025-11-15',
            'hora' => '22:00',
            'descripcio' => 'Explora l’univers amb telescopis i xerrades científiques.',
            'imatge' => 'https://festivaldelasciencias.cl/wp-content/uploads/2024/03/b1060540-d7bb-4f69-a414-f198c3d6ebf7.jpeg',
            'num_max_assistents' => 200,
            'edat_minima' => 12,
            'categoria_id' => 5,
        ),
        array(
            'nom' => 'Festival de Metal',
            'data' => '2025-12-03',
            'hora' => '19:30',
            'descripcio' => 'Els millors grups de metal reunits en una nit de bogeria.',
            'imatge' => 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTshvvcsHqvzlDa_ieD6WMaGHUxTUPTRY6dmg&s',
            'num_max_assistents' => 300,
            'edat_minima' => 18,
            'categoria_id' => 1,
        ),
        array(
            'nom' => 'Setmana de Cinema Clàssic',
            'data' => '2025-11-21',
            'hora' => '18:00',
            'descripcio' => 'Marató de pel·lícules clàssiques de tots els temps.',
            'imatge' => 'https://mont-roig.cat/wp-content/uploads/MM_TURISME_COSTA_ES_imp.jpg',
            'num_max_assistents' => 130,
            'edat_minima' => 18,
            'categoria_id' => 3,
        ),
        array(
            'nom' => 'Show d’Improvisació Teatral',
            'data' => '2025-12-10',
            'hora' => '20:00',
            'descripcio' => 'Actors improvisen històries en directe amb la participació del públic.',
            'imatge' => 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRX57LP9lWpQhezjY0yvlnMnCPZFXPLht3mBb_1euVOE32JXGJfhUrbr3kTVT0MTAD7-gE&usqp=CAU',
            'num_max_assistents' => 140,
            'edat_minima' => 12,
            'categoria_id' => 2,
        ),
        array(
            'nom' => 'Nit d’Stand-Up Comedy',
            'data' => '2025-12-15',
            'hora' => '21:00',
            'descripcio' => 'Els millors còmics de l’escena fan una nit de rialles sense fi.',
            'imatge' => 'https://www.ehu.eus/documents/1760370/41468481/stand_up_comedy_2022.jpg/861bb419-def1-89be-f00a-c73304bbcae8?t=1671110940632',
            'num_max_assistents' => 250,
            'edat_minima' => 18,
            'categoria_id' => 5,
        )
    );
}