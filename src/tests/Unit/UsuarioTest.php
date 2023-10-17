use PHPUnit\Framework\TestCase;

class UsuarioTest extends TestCase {

    public function testCrearUsuarioConDatosValidos() {
        // Suponemos que tienes una clase Usuario en controladores/api.php
        $usuario = new Usuario();
        $resultado = $usuario->crear('Juan', 'juan@ejemplo.com', 'contraseña', 1);

        // Aseguramos que la creación fue exitosa.
        $this->assertTrue($resultado);
    }
    
    // Añade más pruebas según lo necesario.
}
