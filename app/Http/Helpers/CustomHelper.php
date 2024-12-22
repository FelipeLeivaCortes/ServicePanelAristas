<?php

namespace App\Http\Helpers;

use App\Models\Activity;
use App\Models\Area;
use App\Models\Branch;
use App\Models\Frecuency;
use App\Models\Location;
use App\Models\Priority;
use Carbon\Carbon;
use Exception;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Storage;

class CustomHelper {

    /**
     * Verifica si el nombre es valido o no
     * @param string $name Nombre a validar
     * @param bool $withNumbers Se incluyen números?
     * @param int $length Longitud mínima de la cadena
     * @return array
     */
    public static function isValidName(string $name, bool $withNumbers = false, int $length = 5) {
        if ( $withNumbers ) {
            $regex  = '/^(?=(?:\S\s?){' . $length . ',}$)[a-zA-ZÀ-ÿ0-9\s]+$/u';
        } else {
            $regex  = '/^(?=(?:\S\s?){' . $length . ',}$)[a-zA-ZÀ-ÿ\s]+$/u';
        }
    
        if ( preg_match($regex, $name) ) {
            return ['state' => true, 'msg' => 'OK'];
        } else {
            return ['state' => false, 'msg' => 'El nombre no es válido'];
        }
    }

    /**
     * Verifica si el nombre de la actividad es válido y está disponible en la base de datos.
     * @param string $name Nombre de la actividad a validar
     * @param int $length Cantidad de caracteres minimos que debe tener el nombre.
     * @param int $branch_id ID de la sucursal
     * @param bool $newActividad Es una nueva actividad?
     * @return array
     */
    public static function isValidActivityName(string $name, int $length, int $branch_id, bool $withNumbers = false, bool $newActivity = false) {
        $isValid    = self::isValidName($name, true, $withNumbers, $length);

        if ( !$isValid['state'] ) {
            return ['state' => $isValid['state'], 'msg' => 'El nombre ingresado no es válido'];
        }

        $activities = Activity::where('name', $name)->where('branch_id', $branch_id)->count();

        if ($newActivity) {
            if ($activities == 0) {
                $state  = true;
                $msg    = "OK";
    
            } elseif ($activities == 1) {
                $state  = false;
                $msg    = "La actividad $name ya está registrada";
    
            } elseif ($activities > 1) {
                $state  = false;
                $msg    = "La actividad $name está repetida en la base de datos. Comuníquese con el administrador";
    
            }
        } else {
            if ($activities == 0) {
                $state  = false;
                $msg    = "La actividad ingresada no está registrado";
    
            } elseif ($activities == 1) {
                $state  = true;
                $msg    = "OK";
    
            } elseif ($activities > 1) {
                $state  = false;
                $msg    = "La actividad $name está repetida en la base de datos. Comuníquese con el administrador";
    
            }
        }

        return ['state' => $state, 'msg' => $msg];
    }

    /**
     * Verifica si el número es válido
     * @param string $number Número a validar
     * @param bool $withDecimals Se incluyen decimales?
     * @return boolean
     */
    public static function isValidNumber(string|null $number, bool $withDecimals = false) {
        if ( is_null($number) ) {
            return ['state' => false, 'msg' => 'El valor ingresado está vacio'];
        }

        if ( $withDecimals ) {
            $regex  = '/^-?\d+(\.\d+)?$/u';
        } else {
            $regex  = '/^\d{+}$/u';
        }

        if ( preg_match($regex, $number) ) {
            return ['state' => true, 'msg' => 'OK'];
        } else {
            return ['state' => false, 'msg' => 'El número no es válido'];
        }
    }

    /**
     * Verifica si la fecha cumple con formato
     * @param string $name Nombre a validar
     * @param int $numChars Longitud de la cadena
     * @return boolean
     */
    public static function isValidDate(string $date, string $format) {
        if ($format == 'dd/mm/YYYY' ) {
            $regex  = '/^(0[1-9]|[1-2][0-9]|3[0-1])\/(0[1-9]|1[0-2])\/(19|20)\d{2}$/';
        } else {
            return ['state' => false, 'msg' => "El sistema no soporta el formato $format"];
        }

        if ( preg_match($regex, $date) ) {
            return ['state' => true, 'msg' => 'OK'];
        } else {
            return ['state' => false, 'msg' => 'La fecha no cumple con el formato dd/mm/yyyy'];
        }
    }

    /**
     * Verifica si la frecuencia existe en BD y está disponible
     * @param string $name Nombre de la frecuencia a validar
     * @return boolean
     */
    public static function isValidFrecuency(string $name) {
        $isValid    = self::isValidName($name, true);

        if ( !$isValid['state'] ) {
            return ['state' => $isValid['state'], 'msg' => 'La frecuencia ingresada no es válida'];
        }

        $frecuencies    = Frecuency::where('name', $name)->count();

        if ( $frecuencies == 0 ) {
            $state  = false;
            $msg    = 'La frecuencia ingresada no está registrada';

        } elseif ( $frecuencies == 1 ) {
            $state  = true;
            $msg    = 'OK';

        } elseif ( $frecuencies > 1 ) {
            $state  = false;
            $msg    = "La frecuencia $name está repetida en la base de datos. Comuníquese con el administrador";

        }

        return ['state' => $state, 'msg' => $msg];
    }

    /**
     * Verifica si el sector existe en BD y está disponible
     * @param string $name Nombre del sector a validar
     * @param int $branch_id ID de la sucursal
     * @param bool $newLocation Es un nuevo sector?
     * @return array
     */
    public static function isValidLocation(string $name, int $branch_id, bool $newLocation = false) {
        $isValid    = self::isValidName($name, true);

        if ( !$isValid['state'] ) {
            return ['state' => $isValid['state'], 'msg' => 'El sector ingresado no es válido'];
        }

        $locations  = Location::where('name', $name)->where('branch_id', $branch_id)->count();

        if ( $newLocation ) {
            if ( $locations == 0 ) {
                $state  = true;
                $msg    = "OK";
    
            } elseif ( $locations == 1 ) {
                $state  = false;
                $msg    = "El sector $name ya está registrado";
    
            } elseif ( $locations > 1 ) {
                $state  = false;
                $msg    = "El sector $name está repetido en la base de datos. Comuníquese con el administrador";
    
            }
        } else {
            if ( $locations == 0 ) {
                $state  = false;
                $msg    = "El sector ingresado no está registrado";
    
            } elseif ( $locations == 1 ) {
                $state  = true;
                $msg    = "OK";
    
            } elseif ( $locations > 1 ) {
                $state  = false;
                $msg    = "El sector $name está repetido en la base de datos. Comuníquese con el administrador";
    
            }
        }

        return ['state' => $state, 'msg' => $msg];
    }

    /**
     * Verifica si la prioridad es válida
     * @param string $name Nombre de la priodidad a validar
     * @return boolean
     */
    public static function isValidPriority(string $name) {
        $isValid    = self::isValidName($name, true);

        if ( !$isValid['state'] ) {
            return ['state' => $isValid['state'], 'msg' => 'La prioridad ingresada no es válida'];
        }

        $priorities = Priority::where('name', $name)->count();

        if ( $priorities == 0 ) {
            $state  = false;
            $msg    = "La prioridad ingresada no está registrada";

        } elseif ( $priorities == 1 ) {
            $state  = true;
            $msg    = "OK";

        } elseif ( $priorities > 1 ) {
            $state  = false;
            $msg    = "La prioridad $name está repetida en la base de datos. Comuníquese con el administrador";

        }

        return ['state' => $state, 'msg' => $msg];
    }

    /**
     * Verifica si el área es válida
     * @param string $name Nombre del área a validar
     * @return boolean
     */
    public static function isValidArea(string $name) {
        $isValid    = self::isValidName($name, true);

        if ( !$isValid['state'] ) {
            return ['state' => $isValid['state'], 'msg' => 'El área ingresada no es válida'];
        }

        $areas  = Area::where('name', $name)->count();

        if ( $areas == 0 ) {
            $state  = false;
            $msg    = "El área ingresada no está registrada";

        } elseif ( $areas == 1 ) {
            $state  = true;
            $msg    = "OK";

        } elseif ( $areas > 1 ) {
            $state  = false;
            $msg    = "El área $name está repetida en la base de datos. Comuníquese con el administrador";

        }

        return ['state' => $state, 'msg' => $msg];
    }

    /** Descarga un archivo de error
     * @param string $name Nombre del archivo
     * @param Branch $branch Obejecto Sucursal
     * @param array $errors Array de errores
     * @return boolean
     */
    public static function downloadErrorFile(string $name, Branch $branch, array $errors) {
        $company_id = $branch->company->id;
        $date       = Carbon::now()->format('_d-m-Y__h_i_s');
        $filename   = "error_" . $name. "_$date.txt";
        $url        = "company_$company_id/branch_$branch->id/logs/$filename";
        $content    = '';

        foreach ($errors as $error) {
            $content .= $error['msg']."\n";
        }

        Storage::disk('public')->put($url, $content);
        $encodedText    = Crypt::encryptString("company_$company_id/branch_$branch->id/logs|$filename|text/plain", env('KEY_ENCODE'));

        /**
         * UBICACIÓN EN: vendor/jeroennoten/laravel-adminlte/resources/views/master.blade.php linea 77 - 79
         */
        Session::flash('autodownload_file', urlencode($encodedText));
    }

    /**
     * Permite asignar el formato de guía a un número
     * @param int $number Número a formatear
     * @param int $length Cantidad de dígitos que debe tener
     * @return string
     */
    public static function serializeRecord(int $number, int $length=6) {
        return sprintf("%0{$length}d", $number);
    }

    /**
     * Permite convertir un Exception en array
     * @param Exception $e Excepción a convertir
     * @return array
     */
    public static function exceptionToArray(Exception $e) {
        $errors[]   = [
            'msg'       => $e->getMessage(),
            'code'      => $e->getCode(),
            'file'      => $e->getFile(),
            'line'      => $e->getLine(),
            'trace'     => $e->getTrace(),
            'previous'  => $e->getPrevious() ? $e->getPrevious()->getMessage() : null
        ];

        return $errors;
    }
}