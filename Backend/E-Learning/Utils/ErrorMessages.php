<?php 

abstract class ErrorMessages
{
    const PaginaNotFound = "La pagina ingresada no existe o no se encuentra disponible";

    const UsuarioNoRegistrado = "No hay ningun usuario registrado";

    const IdCursoNoDefinido = "El Id del curso no está definido";
    const IdCursoNoEsNumero = "El Id del curso no es un numero entero";
    const CursoNoExisteONoDisponible = "El curso ingresado no existe o no se encuentra disponible";
    const CursoDadoDeBaja = "El curso ingresado fue dado de baja";
    const CursoNoComprado = "No puedes acceder a los niveles del curso porque no lo has comprado";

    const CostoCursoNoDefinido = "El costo del curso no está definido";
    const CostoCursoNoEsNumeroPositivo = "El costo del curso no es un numero positivo";

    const IdNivelNoDefinido = "El Id del nivel no está definido";
    const IdNivelNoEsNumero = "El Id del nivel no es un numero entero";
    const NivelNoExisteONoDisponible = "El nivel ingresado no existe o no se encuentra disponible";
    
    const CursoONivelNoExisten = "El curso o el nivel ingresado no existen o no se encuentran disponibles";

    const SoloUsuariosEscuelaPueden = "Solo los usuarios con rol \"Escuela\" pueden: ";
    const SoloUsuariosEstudiantePueden = "Solo los usuarios con rol \"Estudiante\" pueden: ";
    const SoloUsuariosRegistradosPueden = "Solo los usuarios registrados pueden: ";

}
