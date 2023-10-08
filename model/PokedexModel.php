<?php

class PokedexModel {
    private $database;

    public function __construct($database) {
        $this->database = $database;
    }


    public function list($filter = "") {
        $pokemones = $this->database->query("SELECT * FROM `pokemones` WHERE nombre LIKE '%$filter%'");
        $result = array();

        foreach ($pokemones as $pokemon) {
            $result[] = [
                'id' => $pokemon["idPokemon"],
                'image' => 'public/' . strtolower($pokemon['nombre']) . '.png',
                'type' => 'public/' . strtolower($pokemon["tipo"]) . '.png',
                'number' => $pokemon['numero'],
                'name' => $pokemon["nombre"]
            ];
        }

        Logger::info("Pokemons: " . json_encode($result));

        return $result;
    }


    public function get($id) {
        $result = $this->database->query("SELECT * FROM `pokemones` WHERE idPokemon = $id");
        return $result[0];
    }
    public function alta($numero, $nombre, $tipo) {
        $sql = "INSERT INTO `pokemones` ( `tipo`, `nombre`, `numero`) VALUES ( '$tipo', '$nombre', $numero);";
        Logger::info('Pokemon alta: ' . $sql);

        $this->database->query($sql);
    }

    public function borrar($id) {
        $sql = "DELETE FROM `pokemones` WHERE idPokemon = $id;";
        Logger::info('Pokemon borrar: ' . $sql);

        $this->database->query($sql);
    }
}